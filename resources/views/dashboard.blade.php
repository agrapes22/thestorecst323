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
                            <h2 class="text-center mb-4">Dashboard</h2>
                            <div class="row" style="text-align: center;">
                                <div class="col"><strong>Name</strong></div>
                                <div class="col">
                                    <p>{{$user->name}}</p>
                                </div>
                            </div>
                            <div class="row" style="text-align: center;">
                                <div class="col"><strong>Username</strong></div>
                                <div class="col">
                                    <p>{{$user->username}}</p>
                                </div>
                            </div>
                            <div class="row" style="text-align: center;">
                                <div class="col"><strong>Account Created</strong></div>
                                <div class="col">
                                    <p>{{ date('M-d-y', strtotime($user->created_at)) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
    </body>
</html>