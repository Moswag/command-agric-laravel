<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Expert;
use App\Models\SystemConstants;
use App\Models\User;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experts=Expert::all();
        return view('expert.view_experts',compact('experts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expert.add_expert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(User::where('email',$request->email)->exists()){
            return back()->with('error','User already registered');
        }
        else{
            $user=new User();
            $user->name=$request->name;
            $user->surname=$request->surname;
            $user->email=$request->email;
            $user->access=SystemConstants::ACCESS_EXPERT;
            $user->password=bcrypt($request->password);

            if($user->save()){
                $expert=new Expert();
                $expert->userId=$user->id;
                $expert->phoneNumber=$request->phoneNumber;
                $expert->address=$request->address;
                $expert->status=SystemConstants::STATUS_PENDING;

                if($expert->save()){
                    return redirect()->route('expert.index')->with('message','Expert successfully added');
                }

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Expert::find($id)->exists()){
            $expert =Expert::find($id);
            $user=User::find($expert->userId);
            if($expert->delete() && $user->delete()){
                return redirect('expert.index')->with('message','Expert successfully deleted');
            }
            else{
                return back()->with('error','Failed to delete user');
            }
        }
        else{
            return back()->with('error','Expert id do not exist');
        }
    }
}
