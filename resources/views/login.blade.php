@extends('layouts.base')
@section('css')
<link href="{{ secure_asset('/css/login.css') }}" rel="stylesheet"/>
@stop
@section('lIn')
active
@stop

@section('body')
    <section class="container">
    @if(Session::has('error'))
        <p>{{ Session::get('error') }}</p>
    @endif
    <h1>Login Page</h1>
    <form role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="input-group col-sm-4 col-sm-offset-4">
            <span class="input-group-addon"><i class="fa fa-user-secret" aria-hidden="true"></i></span>
            <input id="email" type="text" class="form-control" name="email" placeholder="Email"  @if(Session::has('error')) value="{{ Session::get('email') }}" @endif>
        </div>
        <div class="input-group col-sm-4 col-sm-offset-4">
            <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
            <input id="password" type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="input-group col-sm-4 col-sm-offset-4">
            <button type="submit" id = "sub" class="btn btn-blk">
                Submit
            </button>
        </div>
    </form>
    <div class="col-sm-4 col-sm-offset-4">
    <a id="changepass" href="{{ route('change') }}">Change Password</a>
    </div>
    </section>
@stop