@extends('app')
<!DOCTYPE html>
    <style>
        div {
            width: auto;
            margin: 20px;
            text-align: center;
        }
        .tables {
            display: table;
            margin-top: auto;
            margin-left: auto;
            margin-right: auto;
            border-spacing: 0.7em;
            border: 1px solid black;
        }
        .rows {
            display: table-row;
            text-align: left;
        }
        .cell {
            display: table-cell;
            text-align: left;
            padding: 5px;
        }
    </style>
<html>
    <body>
        @section('content')
        <div>
            <h4>Your Account</h4>
            <span class="tables">
                <span class="rows">
                    <span class="cell">Name:</span>
                    <span class="cell">{{$user->name}}</span>
                </span>
                <span class="rows">
                    <span class="cell">Nickname:</span>
                    <span class="cell">{{$user->nickname}}</span>
                </span>
                <span class="rows">
                    <span class="cell">Username:</span>
                    <span class="cell">{{$user->username}}</span>
                </span>
                <span class="rows">
                    <span class="cell">Account Created:</span>
                    <span class="cell">{{ date('M-d-y', strtotime($user->created_at)) }}</span>
                </span>
            </span>
        </div>
        @endsection
    </body>
</html>