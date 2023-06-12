<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use App\Models\User;


class UserController extends Controller
{
    function store() {
        return view('/store');
    }

    function loginPage() {
        return view('/login');
    }

    function registerPage() {
        return view('/register');
    }

    function dashboard() {
        if(!Auth::check()){
            return redirect("store")->with('message', 'Please login first');
        }
        return view('dashboard')->with(['user'=>Auth::user()]);
    }

    function profile() {
        if(!Auth::check()){
            return redirect("store")->with('message', 'Please login first');
        }
        Session::put('error', Session::get('error'));
        Session::put('message', Session::get('message'));

        return view('profile')->with(['user'=>Auth::user(), 'error'=>Session::get('error'), 'message'=>Session::get('message')]);
    }

    function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $userlogin = $request->only('username', 'password');
        if (Auth::attempt($userlogin)) {
            return redirect()->intended('dashboard')->withSuccess('Logged in');
        }
        return redirect("login")->with('error','Login unsuccessful');
    }

    function signout(Request $request) {
        Session::flush();
        Auth::logout();

        return redirect("store")->with('message', 'Logged out');
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
            return redirect("dashboard")->withSuccess('Signed in');

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
                return redirect("profile")->with(['user'=>Auth::user(), 'error'=>'Incorrect password']);
            }
            else if($request->newpassword === null) {
                return redirect("profile")->with(['user'=>Auth::user(), 'error'=>'New password cannot be blank']);
            }
            else if(Hash::check($request->newpassword, Auth::user()->getAuthPassword())) {
                return redirect("profile")->with(['user'=>Auth::user(), 'error'=>'New password cannot be the same as old password']);
            }
            else if($request->oldpassword === $request->newpassword) {
                return redirect("profile")->with(['user'=>Auth::user(), 'error'=>'New password cannot be the same as old password']);
            }
            else {
                $newpassword = Hash::make($request->newpassword);
                Auth::user()->update(['password'=>$newpassword]);
            }
        }

        $user = Auth::user()->update($data);
        return redirect("profile")->with('message','Account updated');
    }

    function delete($id)
    {
        $u = User::where('id', $id)->firstorfail()->delete();
        return redirect("store")->with('message','Account sucessfully deleted');
    }
}
