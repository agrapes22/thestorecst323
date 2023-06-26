@extends('app')
<!DOCTYPE html>
<html>
    <body>
        @section('content')
        <section class="py-4 py-xl-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card mb-5">
                        <div class="card-body p-sm-5">
                            <h2 class="text-center mb-4">Profile</h2>
                            <form method="post" action="/updateAccount">
                            {{ csrf_field() }}
                                <div class="mb-3"><input class="form-control" type="text" id="nameid" name="name" value="{{$user->name}}"></div>
                                <div class="mb-3"><input class="form-control" type="text" id="usernameid" name="username" value="{{$user->username}}"></div>
                                <div class="mb-3"><input class="form-control" type="password" id="oldpasswordid" name="oldpassword" placeholder="Old Password"></div>
                                <div class="mb-3"><input class="form-control" type="password" id="newpasswordid" name="newpassword" placeholder="New Password"></div>
                                <div><button class="btn btn-primary d-block w-100" type="submit">Update</button></div>
                            </form>
                            <h2 class="text-center mb-4">Delete Account</h2>
                            <form action="{{ url('/deleteAccount', ['id' => $user->id]) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-primary d-block w-100" type="submit" onclick="return confirm('Are You Sure You Want To Delete Your Account?')">Delete</button>
                            </form>
                        </div>
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
                </div>
            </div>
        </div>
        </section>   
        @endsection
    </body>
</html>