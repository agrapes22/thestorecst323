@extends('app')
<!DOCTYPE html>
<style>
</style>
<html>
<body>
    @section('content')
    
    <section class="py-4 py-xl-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>Products</h2>
                    @if(Auth::check())
                    <p>Products available to buy!</p>
                    @else
                    <p>Please log in to see products!</p>
                    @endif
                </div>
            </div>
            @if(Auth::check())
            <div class="row gx-2 gy-2 row-cols-1 row-cols-md-2 row-cols-xl-3" data-bss-baguettebox="">
                <div class="col"><a href="https://cdn.bootstrapstudio.io/placeholders/1400x800.png"><img class="img-fluid" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png"></a></div>
                <div class="col"><a href="https://cdn.bootstrapstudio.io/placeholders/1400x800.png"><img class="img-fluid" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png"></a></div>
                <div class="col"><a href="https://cdn.bootstrapstudio.io/placeholders/1400x800.png"><img class="img-fluid" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png"></a></div>
                <div class="col"><a href="https://cdn.bootstrapstudio.io/placeholders/1400x800.png"><img class="img-fluid" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png"></a></div>
                <div class="col"><a href="https://cdn.bootstrapstudio.io/placeholders/1400x800.png"><img class="img-fluid" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png"></a></div>
                <div class="col"><a href="https://cdn.bootstrapstudio.io/placeholders/1400x800.png"><img class="img-fluid" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png"></a></div>
            </div>
            @endif
        </div>
    </section>

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
 