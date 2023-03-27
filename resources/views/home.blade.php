@extends('app')
<!DOCTYPE html>
<style>
    div {
        width: auto;
        margin: 20px;
        text-align: center;
    }
    form {
        display: table;
        margin-top: auto;
        margin-left: auto;
        margin-right: auto;
        border-spacing: 0.7em;
        border: 1px solid black;
    }
    p {
        display: table-row;
    }
    label {
        display: table-cell;
        vertical-align: top;
        padding-right: 20px;
    }
    input {
        float: right;
        padding-right: 20px;
        width: auto;
    }
</style>
<html>
<body>
    @section('content')
    @if(!Session::has('registerForm') && !Session::has('loginForm') && !Auth::check())
    <div>
        <h4>Welcome!</h4>
        <button onclick="window.location.href='{{ url('/login') }}';">Login</button> <button onclick="window.location.href='{{ url('/register') }}';">Register</button>
    </div>
    @endif
    @if(Auth::check())
    <div>
        <h4>Welcome {{ Auth::user()->name }}!</h4>
    </div>
    @endif
    @if(Session::has('registerForm'))
        <div>
            <h2>Register For Account</h2>
            <form name="registerForm" method="post" action="/register" enctype="multipart/form-data" >
            {{ csrf_field() }}
                <p>
                    <label for="nameid">Name</label>
                    <input type="text" id="nameid" name="name" placeholder="Name" required>
                </p>
                <p>
                    <label for="nicknameid">Nickname</label>
                    <input type="text" id="nicknameid" name="nickname" placeholder="Nickname">
                </p>
                <p>
                    <label for="usernameid">Username</label>
                    <input type="text" id="usernameid" name="username" placeholder="Username" required>
                </p>
                <p>
                    <label for="passwordid">Password</label>
                    <input type="password" id="passwordid" name="password" placeholder="Password" required>
                </p>
                <p>
                    <button type="submit">Register</button>
                </p>
            </form>
            </br></br><p style="display: block">Already have an account?</br><button onclick="window.location.href='{{ url('/login') }}';">Login</button> <p>
        </div>
      @endif
      @if(Session::has('loginForm'))
      <div>
        <h2>Login To Your Account</h2>
        <form name="loginform" method="post" action="/login" enctype="multipart/form-data" >
        {{ csrf_field() }}    
            <p>
                <label for="usernameid">Username</label>
                <input type="text" id="usernameid" name="username" placeholder="Username">
            </p>
            <p>
                <label for="passwordid">Password</label>
                <input type="password" id="passwordid" name="password" placeholder="Password">
            </p>
            <p>
            <button type="submit">Login</button>
            </p>
        </form>
        </br></br><p style="display: block">Don't have an account yet?</br><button onclick="window.location.href='{{ url('/register') }}';">Register</button> <p>
    </div>
    @endif
    @if(session()->has('error'))
        <div style="color:red">
        {{ session()->get('error')}}
        </div>
    @endif
    @if(session()->has('errors'))
        <div style="color:red">
        {{ implode('', $errors->all(':message')) }}
        </div>
    @endif
    @if(session()->has('message'))
        <div style="color:black">
        {{ session()->get('message')}}
        </div>
    @endif
    @endsection
</body>
</html>
 