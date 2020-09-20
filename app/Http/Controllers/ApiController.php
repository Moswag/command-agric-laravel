<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Distribution;
use App\Models\Farm;
use App\Models\Farmer;
use App\Models\GMBPrice;
use App\Models\SystemConstants;
use App\Models\User;
use App\Models\Weather;
use App\Models\Yields;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(array([
                'response' => 'success',
                'access' => auth()->user()->access,
                'name' => auth()->user()->name . ' ' . auth()->user()->surname,
                'message' => 'Login success'
            ]));
        } else {
            return response()->json(array(['response' => 'failed']));
        }
    }


    public function registerFarmer(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            $user = User::where('email', $request->email)->get()->first();
            if ($user->status == SystemConstants::STATUS_ACTIVE) {
                return response()->json(array([
                    'response' => 'failed',
                    'message' => 'User is already registered, please login']));
            } else {
                $updateUser = User::where('email', $request->email)->update([
                    'status' => SystemConstants::STATUS_ACTIVE,
                    'password' => bcrypt($request->password)
                ]);

                if ($updateUser) {
                    return response()->json(array([
                        'response' => 'success',
                        'status' => '200',
                        'message' => 'User successfully registered',
                        'name' => $user->name . ' ' . $user->surname]));
                } else {
                    return response()->json(array([
                        'response' => 'failed',
                        'message' => 'Failed to register farmer, please contact admin']));
                }
            }
        }
    }


    public function viewGMBPrices()
    {
        $prices = GMBPrice::all();
        return response()->json(array([
            'response' => 'ok',
            'data' => $prices]));
    }

    public function viewDistributions($email)
    {
        $user = User::where('email', $email)->get()->first();
        $farmer = Farmer::where('userId', $user->id)->get()->first();
        $farm = Farm::findOrFail($farmer->farmId);
        $distributions = Distribution::where('district', $farm->districtId)->get();
        return response()->json(array([
            'response' => 'ok',
            'data' => $distributions]));
    }


    public function saveYield(Request $request)
    {
        if(User::where('email',$request->farmerId)->exists()) {
            if (Crop::where('name', $request->crop)->exists()) {
                $user = User::where('email', $request->farmerId)->get()->first();
                $farmer = Farmer::where('userId', $user->id)->get()->first();
                $farm = Farm::findOrFail($farmer->farmId);
                //now have hectors
                $crop = Crop::where('name', $request->crop)->get()->first();
                $expectedYield = $crop->yield * $farm->hectares;
                //get the farm hectors and calculate the yield expectance
                $yield = new Yields();
                $yield->farmerId = $request->farmerId;
                $yield->crop = $request->crop;
                $yield->quantity = $request->quantity;
                $yield->expected = $expectedYield;
                if($expectedYield>$request->quantity){
                    $yield->status=SystemConstants::YIELD_SHORT;
                }
               else  if($expectedYield<$request->quantity){
                    $yield->status=SystemConstants::YIELD_EXCEED;
                }
                else{
                    $yield->status=SystemConstants::YIELD_EQUALISED;
                }

                if ($yield->save()) {
                    return response()->json(array([
                        'response' => 'success',
                        'status' => '200',
                        'message' => 'Yield successfully saved']));
                } else {
                    return response()->json(array([
                        'response' => 'failed',
                        'message' => 'Failed to save yield, please contact admin']));
                }


            } else {
                return response()->json(array([
                    'response' => 'failed',
                    'message' => 'You entered a none existing crop']));

            }
        }
        else{
            return response()->json(array([
                'response' => 'failed',
                'message' => 'User do not exist']));
        }
    }


    public function getFarmerYields($email){
        $yields=Yields::where('farmerId',$email)->get();
        return response()->json(array([
            'response' => 'ok',
            'data' => $yields]));
    }


    public function viewWeatherNotifications($email)
    {
        $user = User::where('email', $email)->get()->first();
        $farmer = Farmer::where('userId', $user->id)->get()->first();
        $farm = Farm::findOrFail($farmer->farmId);
        $weathers = Weather::where('district', $farm->districtId)->get();
        return response()->json(array([
            'response' => 'ok',
            'data' => $weathers]));
    }

}
