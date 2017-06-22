@extends('layouts.base')
@section('css')

@stop
@section('lEdit')
active
@stop

@section('body')
    <section class="container">
    <h1>Edit</h1>
    <form role="form" method="POST" action="{{ route('add') }}">
        {{ csrf_field() }}
        <div class="col-xs-12 col-sm-6 input-group">
            <input id="subject" type="text" class="form-control" name="subject" placeholder="Subject"  @if(Session::has('error')) value="{{ Session::get('email') }}" @endif>
        </div>
        <div class="col-xs-12 col-sm-8 input-group">
            <textarea class="form-control" rows="10" name="body" id="body" placeholder="Body of the Speech"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
    </form>
    </section>
    
    <style type="text/css">
        h1{
            font-family: 'Jura', sans-serif;
            color:#26D928;
        }
        
        #subject,#body{
            margin-bottom:20px;
        }
    </style>
    
@stop