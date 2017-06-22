@extends('layouts.base')
@section('css')

@stop
@section('lIn')
active
@stop

<?php
    $queries =App\Text::all();
?>

@section('body')
    <section class="container">
    <h1>Edit</h1>
    @if(Session::has('error'))
        <p>{{ Session::get('error') }}</p>
    @endif
    <div class="col-xs-6">
        <a href="{{ route('new') }}" class="btn btn-default">New Text</a>
    </div>
    <div class="col-xs-6">
        <a href="{{ route('updateJSON') }}" class="btn btn-default">Generate JSON</a>
    </div>
    <div class="col-xs-12">
        <ul class="list-group" >
            @foreach($queries as $query)
            <li class="list-group-item">
                <div class="row">
                <div class="col col-xs-8">{{ $query->subject }} </div>
                <div class="col col-xs-2"><a href="{{route('edittext', ['id' => $query->id ])}}" class="btn btn-default">Edit</a>  </div>
                <div class="col col-xs-2"><a href="{{route('delete', ['id' => $query->id ])}}" class="btn btn-default">Delete</a>  </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    </section>
    <style type="text/css">
        h1{
            font-family: 'Jura', sans-serif;
            color:#26D928;
        }
    </style>
@stop