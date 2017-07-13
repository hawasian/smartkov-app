@extends('layouts.base')
@section('css')
<link href="{{ secure_asset('/css/edit.css') }}" rel="stylesheet"/>
@stop
@section('lIn')
active
@stop

<?php
    $queries =App\Text::orderBy('subject')->get();
?>

@section('body')
    <section class="container">
    <h1>Edit</h1>
    @if(Session::has('error'))
        <p>{{ Session::get('error') }}</p>
    @endif
    <div class="col-xs-6 btn-col">
        <a href="{{ route('new') }}" class="btn btn-blk">New Text</a>
    </div>
    <div class="col-xs-6 btn-col">
        <a href="{{ route('updateJSON') }}" class="btn btn-blk">Generate JSON</a>
    </div>
    <div class="col-xs-12">
        <ul class="list-group" >
            @foreach($queries as $query)
            <li class="list-group-item">
                <div class="row">
                <div class="col col-xs-9">{{ $query->subject }} </div>
                <div class="col col-xs-1"><a href="{{route('edittext', ['id' => $query->id ])}}" class="btn btn-blk">Edit</a>  </div>
                <div class="col col-xs-2"><a href="{{route('delete', ['id' => $query->id ])}}" class="btn btn-blk">Delete</a>  </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    </section>
@stop