<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Farm;
use App\Models\Farmer;
use App\Models\SystemConstants;
use App\Models\User;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $farmers = Farmer::all();
        return view('farmer.view_farmers', compact('farmers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $farms = Farm::all();
        return view('farmer.add_farmer', compact('farms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return back()->with('error', 'User already exists');
        } else {
            $user = new  User();
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->access=SystemConstants::ACCESS_FARMER;
            $user->password = bcrypt($request->password);
            $user->status=SystemConstants::STATUS_PENDING;
            if ($user->save()) {
                $farmer = new Farmer();
                $farmer->userId = $user->id;
                $farmer->farmId = $request->farmId;
                $farmer->phoneNumber = $request->phoneNumber;
                $farmer->address = $request->address;
                if ($farmer->save()) {
                    $farmUpdated=Farm::where('id',$request->farmId)->update([
                        'status'=>SystemConstants::FARM_OCCUPIED_OCCUPIED
                    ]);

                    if($farmUpdated){
                        return redirect()->route('farmer.index')->with('message', 'Farmer successfully added');
                    }
                    else{
                        return back()->with('error','Failed to update farm');
                    }

                } else {
                    return back()->with('error', 'Failed to add farmer, please contact admin');
                }
            } else {
                return back()->with('error', 'Failed to add user');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Farmer::find($id)->exists()){
            $farmer =Farmer::find($id);
            $user=User::find($farmer->userId);
            if($farmer->delete() && $user->delete()){
                $farmUpdated=Farm::where('id',$farmer->farmId)->update([
                    'status'=>SystemConstants::FARM_STATUS_VACANT
                ]);
                if($farmUpdated){
                    return redirect('farmer.index')->with('message','Farmer successfully deleted');
                }
                else{
                    return back()->with('error','Failed to update farm');
                }

            }
            else{
                return back()->with('error','Failed to delete user');
            }
        }
        else{
            return back()->with('error','Admin id do not exist');
        }
    }
}
