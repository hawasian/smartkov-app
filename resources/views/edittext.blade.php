@extends('layouts.base')
@section('css')
<link href="{{ secure_asset('/css/edittext.css') }}" rel="stylesheet"/>
@stop
@section('lEdit')
active
@stop

@section('body')
    <section class="container">
    <h1>Edit...</h1>
    <form role="form" method="POST" action="{{ route('posttext',['id' => Session::get('id')]) }}">
        {{ csrf_field() }}
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 input-group">
            <input id="subject" type="text" class="form-control" name="subject" placeholder="Subject"  value="{{ Session::get('subject') }}">
        </div>
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 input-group">
            <textarea class="form-control" rows="10" name="body" id="body" placeholder="Body of the Speech">{{ Session::get('body') }}</textarea>
        </div>
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 input-group">
            <button type="submit" id="sub" class="btn btn-blk">
                Submit
            </button>
        </div>
    </form>
    </section>
    
@stop