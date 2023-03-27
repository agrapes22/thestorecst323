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
        <div>
            <h4>Your Account</h4>
            <form name="updateAccount" method="post" action="/updateAccount" enctype="multipart/form-data">
            {{ csrf_field() }}
                <p>
                    <label for="nameid">Name:</label>
                    <input type="text" id="nameid" name="name" value="{{$user->name}}">
                </p>
                <p>
                    <label for="nicknameid">Nickname:</label>
                    <input type="text" id="nicknameid" name="nickname" value="{{$user->nickname}}">
                </p>
                <p>
                    <label for="usernameid">Username:</label>
                    <input type="text" id="usernameid" name="username" value="{{$user->username}}">
                </p>
                <p>
                    <label for="oldpasswordid">Old Password</label>
                    <input type="password" id="oldpasswordid" name="oldpassword" placeholder="Old Password">
                </p>
                <p>
                    <label for="newpasswordid">New Password</label>
                    <input type="password" id="newpasswordid" name="newpassword" placeholder="New Password">
                </p>
                <p>
                    <button type="submit">Update</button> 
                </p>
            </form>
            <h5 style="margin-top: 10px">Delete Account</h5>
            <form action="{{ url('/deleteAccount', ['id' => $user->id]) }}" method="POST" style="border: 0px">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure You Want To Delete Your Account?')">Delete</button>
            </form>
        </div>
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