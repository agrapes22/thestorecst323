<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use App\Models\User;


class UserController extends Controller
{
    function home() {
        return view('/home');
    }

    function loginPage() {
        if(Session::has('error')) {
            return redirect("home")->with(['loginForm'=>'login', 'error'=>Session::get('error')]);
        }
        return redirect("home")->with('loginForm','login');
    }

    function registerPage() {
        if(Session::has('error')) {
            return redirect("home")->with(['registerForm'=>'register', 'error'=>Session::get('error')]);
        }
        return redirect("home")->with('registerForm', 'register');
    }

    function account() {
        if(!Auth::check()){
            return redirect("home")->with('message', 'Please login first');
        }
        return view('account')->with(['user'=>Auth::user()]);
    }

    function settingsPage() {
        if(!Auth::check()){
            return redirect("home")->with('message', 'Please login first');
        }
        Session::put('error', Session::get('error'));
        Session::put('message', Session::get('message'));

        return view('settings')->with(['user'=>Auth::user(), 'error'=>Session::get('error'), 'message'=>Session::get('message')]);
    }

    function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $userlogin = $request->only('username', 'password');
        if (Auth::attempt($userlogin)) {
            return redirect()->intended('account')->withSuccess('Logged in');
        }
        return redirect("login")->with('error','Login unsuccessful');
    }

    function logout(Request $request) {
        Session::flush();
        Auth::logout();

        return redirect("home")->with('message', 'Logged out');
    }

    function register(Request $request) {
        $validator = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required'
        ]);

        $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'nickname' => $request->nickname
            ]);

        Auth::login($user);

        if(Auth::check()) {
            return redirect("account")->withSuccess('Signed in');

        }
        return redirect("register")->with('error','Registration unsuccessful');
    }

    function updateAccount(Request $request) {
        $data = $request->only('name', 'username','nickname');

        $validator = $request->validate([
            'name'=>'required', 
            'username' => 'required']);

        if($request->oldpassword != null)
        {
            $validator = $request->validate(['oldpassword'=>'required', 'newpassword' => 'required']);
            if(!Hash::check($request->oldpassword, Auth::user()->getAuthPassword())) {
                return redirect("settings")->with(['user'=>Auth::user(), 'error'=>'Incorrect password']);
            }
            else if($request->newpassword === null) {
                return redirect("settings")->with(['user'=>Auth::user(), 'error'=>'New password cannot be blank']);
            }
            else if(Hash::check($request->newpassword, Auth::user()->getAuthPassword())) {
                return redirect("settings")->with(['user'=>Auth::user(), 'error'=>'New password cannot be the same as old password']);
            }
            else if($request->oldpassword === $request->newpassword) {
                return redirect("settings")->with(['user'=>Auth::user(), 'error'=>'New password cannot be the same as old password']);
            }
            else {
                $newpassword = Hash::make($request->newpassword);
                Auth::user()->update(['password'=>$newpassword]);
            }
        }

        $user = Auth::user()->update($data);
        return redirect("settings")->with('message','Account updated');
    }

    function delete($id)
    {
        $u = User::where('id', $id)->firstorfail()->delete();
        return redirect("home")->with('message','Account sucessfully deleted');
    }
}
