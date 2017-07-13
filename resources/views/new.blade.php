@extends('layouts.base')
@section('css')
<link href="{{ secure_asset('/css/edittext.css') }}" rel="stylesheet"/>
@stop
@section('lEdit')
active
@stop

@section('body')
    <section class="container">
    <h1>Add...</h1>
    <form role="form" method="POST" action="{{ route('add') }}">
        {{ csrf_field() }}
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 input-group">
            <input id="subject" type="text" class="form-control" name="subject" placeholder="Subject"  @if(Session::has('error')) value="{{ Session::get('email') }}" @endif>
        </div>
        <div class="col-xs-12 col-sm-8  col-sm-offset-2 input-group">
            <textarea class="form-control" rows="10" name="body" id="body" placeholder="Body of the Speech"></textarea>
        </div>
        <div class="col-xs-12 col-sm-8  col-sm-offset-2 input-group">
        <button type="submit" id="sub" class="btn btn-blk">
            Submit
        </button>
        </div>
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