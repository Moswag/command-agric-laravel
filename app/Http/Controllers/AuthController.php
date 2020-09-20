<?php

namespace App\Http\Controllers;


use App\Models\SystemConstants;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('session.login');
    }

    function login(Request $request){
        if(User::where('email',$request->email)->exists()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $loggedUser=auth()->user();
                if($loggedUser->access==SystemConstants::ACCESS_ADMIN){
                    return redirect()->route('admin.index')->with('message', 'Welcome ' . $loggedUser->name.' to Command agric system');
                }
                else{
                    return redirect()->route('no_access');
                }


            } else {
                return redirect()->back()->with('error', 'Wrong email or password, please verify and try again');
            }

        }
        else{
            return redirect()->back()->with('error','email do not exists, please contact admin');
        }
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('index')->with('message','You successfully logged out');

    }
}
