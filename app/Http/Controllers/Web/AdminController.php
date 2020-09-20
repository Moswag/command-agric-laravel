<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\SystemConstants;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins=Admin::where('userId','<>',auth()->user()->id)->get();
        return view('admin.view_admins', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_admin');
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
            $user->access=SystemConstants::ACCESS_ADMIN;
            $user->password=bcrypt($request->password);

            if($user->save()){
                $admin=new Admin();
                $admin->userId=$user->id;
                $admin->phoneNumber=$request->phoneNumber;
                $admin->address=$request->address;
                $admin->status=SystemConstants::STATUS_ACTIVE;

                if($admin->save()){
                    return redirect()->route('admin.index')->with('message','Admin successfully added');
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
        $admin=Admin::find($id);
        $user=User::find($admin->userId)->get()->first();
        return view('admin.edit_admin', compact('admin','user'));
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
        $admin=Admin::findOrFail($id);
        if($admin){
            $updateUser=User::where('id',$admin->userId)->update([
                'name'=>$request->name,
                'surname'=>$request->surname,
                'email'=>$request->email
            ]);

            if($updateUser){
                $updateAdmin=Admin::where('id',$id)->update([
                    'address'=>$request->address,
                    'phoneNumber'=>$request->phoneNumber
                ]);

                if($updateAdmin){
                    return redirect()->route('admin.index')->with('message','Admin successfully updated');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Admin::find($id)->exists()){
            $admin =Admin::find($id);
            $user=User::find($admin->userId);
            if($admin->delete() && $user->delete()){
                return redirect('admin.index')->with('message','Admin successfully deleted');
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
