@extends('layouts.base')
@section('css')

@stop
@section('lHome')
active
@stop

@section('body')
    <section class="container">
    
    <h1>Login Page</h1>
    <form role="form" method="POST" action="{{ route('generate') }}">
        {{ csrf_field() }}
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user-secret" aria-hidden="true"></i></span>
            <input id="number" type="text" class="form-control" name="number" placeholder="Number of Words"f>
        </div>
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
    </form>
    
    <div>
        @if(Session::has('text'))
        <p>{{ Session::get('text') }}</p>
        @endif
    </div>
    </section>
@stop