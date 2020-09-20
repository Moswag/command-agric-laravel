<?php

namespace App\Http\Controllers;

use App\Models\GMBPrice;
use App\Models\SystemConstants;
use App\Models\User;
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
                'name' => auth()->user()->name.' '.auth()->user()->surname,
                'message'=>'Login success'
                ]));
        } else {
            return response()->json(array(['response' => 'failed']));
        }
    }

    public function registerFarmer(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            $user=User::where('email',$request->email)->get()->first();
            if($user->status==SystemConstants::STATUS_ACTIVE){
                return response()->json(array([
                    'response' => 'failed',
                    'message' => 'User is already registered, please login']));
            } else {
            $updateUser = User::where('email',$request->email)->update([
                'status'=>SystemConstants::STATUS_ACTIVE,
                'password'=>bcrypt($request->password)
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


    public function viewGMBPrices(){
        $prices=GMBPrice::all();
        return response()->json($prices);
    }

}
