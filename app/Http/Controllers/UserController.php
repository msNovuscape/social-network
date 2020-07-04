<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function postSignup(Request $request){
        $user = new User();
        $user->name = $request['name'];
        $user->address = $request['address'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->save();
        Auth::login($user);
         return redirect()->route('dashboard');
    }

    public function postSignin(Request $request){
        if (Auth::attempt(['email' => $request['email'],'password' => $request['password']])){
            return redirect()->route('dashboard');
        }
        else{
            return redirect()->back();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
