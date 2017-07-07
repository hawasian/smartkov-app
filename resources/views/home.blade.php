@extends('layouts.base')
@section('css')

@stop
@section('lHome')
active
@stop

@section('body')
    <section class="container">
    
    <h1>SMARTKOV...</h1>
    <p>A Smarter Markov Chain Text Generator for creating Memos from the President</p>
    <form id="input" role="form" method="POST" action="{{ route('generate') }}">
        {{ csrf_field() }}
        <input id="number" type="text" class="form-control" name="number" placeholder="Number of Words"/>
        <button id="memomaker" type="submit" class="btn btn-primary">
            Get The Memo!
        </button>
    </form>
    <?php
    
    $properNouns=["i","america","donald","trump","american","americans","american's","america's","january","february","march","april","may","june","july","august","september","october","november","december","hilary","clinton"];
    
    $text = Session::get('text');
    $textArray = explode(" ",$text);
    $n = 0;
    $len = 137;
    $temp = [];
    $out = [];
    $capflag = true;
    foreach ($textArray as $word) {
        if($capflag){
            $word = ucwords($word);
            $capflag = false;
        }
        if(in_array($word, $properNouns)){
            $word = ucwords($word);
        }
        if($len - strlen($word) <= 0){
            $x = implode(" ",$temp);
            array_push($out,$x);
            $temp = [];
            $len = 137;
        }
        $len -= strlen($word);
        if($word == '.' ||  $word == '!'|| $word == '?'){
            $capflag = true;
        }
        if($word == '.' || $word == ',' || $word == '!'|| $word == '?'){
            $word = array_pop($temp).$word;
        }
        array_push($temp,$word);
    }
    $count = count($out);
    $start = rand (3 , 24);
    ?>
    <!--@if(Session::has('text'))-->
    @foreach ($out as $key => $item)
    <?php
    $time = floor($start-($key*($start/$count)));
    if($time == 0){
        $timeout = rand (15 , 55)."s";
    }else{
        $timeout = $time."h";
    }
    ?>
    <div id="memo" class="row">
        <section class="tweet col col-xs-10">
            <div class="pic col-xs-3 col-md-2 col-lg-1">
                <img src="https://pbs.twimg.com/profile_images/874276197357596672/kUuht00m_bigger.jpg"></img>
            </div>
            <div class="col col-xs-8 col-md-9 col-lg-10">
                <h4><b class="DJT">Donald J. Trump</b> <i class="fa fa-check-circle" aria-hidden="true"></i><span class="grey"> @realSmartkov - {{ $timeout }}</span></h4>
                <p>
                @if($key != 0)
                ...
                @endif
                {{ $item }}
                @if($key != count($out)-1)
                ...
                @endif
                </p>
                <section class="col col-xs-12 tweet-tabs">
                    <div class="ttcom col col-xs-3"><i class="fa fa-comment-o" aria-hidden="true"></i><span class="tweet-tab-text">{{ (rand (10 , 100) / 10)."k"}}</span></div>
                    <div class="ttref col col-xs-3"><i class="fa fa-refresh" aria-hidden="true"></i><span class="tweet-tab-text">{{ (rand (10 , 100) / 10)."k"}}</span></div>
                    <div class="tthrt col col-xs-3"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="tweet-tab-text">{{ (rand (10 , 100) / 10)."k"}}</span></div>
                    <div class="ttenv col col-xs-3"><i class="fa fa-envelope-o" aria-hidden="true"></i><span class="tweet-tab-text">{{ (rand (10 , 100) / 10)."k"}}</span></div>
                </section>
            </div>
            <div class="col-sm-1 hidden-xs downchev">
                <i class="fa fa-chevron-down grey arrow" aria-hidden="true"></i>
            </div>
        </section>
    </div>
    @endforeach
    <!--@endif-->
    </section>
    
    <style type="text/css">
        #input{
            margin-bottom: 100px;
        }
        #input input, #input button{
            display: inline-block;
        }
        #number{
            width:20%;
            min-width:160px;
        }
        #memomaker{
            margin-top:-3px;
        }
        
        .tweet{
            background:white;
            padding:7px 0px;
            z-index:15;
            margin: 1px 0;
            border-radius:3px;
        }
        .pic{
            margin-top:10px;
            text-align: right;
        }
        .pic img{
            border-radius:50%;
        }
        input[type=text],
        input[type=email],
        textarea {
            width: 100%;
            background-color: #1d291d;
            color: #26D928;
            font-size: 1.25em;
            padding: 7px;
            border: thin #1ead20 solid;
            outline-color: #26D928;
        }
        .tweet-tabs{
            font-weight:bold;
            color:grey;
        }
        .tweet-tabs i{
            margin-right:15px;
            font-size:1.5em;
            font-weight:normal;
        }
        .ttcom:hover{
            color:#1DA1F2;
        }
        .ttref:hover{
            color:#17BF63;
        }
        .tthrt:hover{
            color:#E33A6E;
        }
        .ttenv:hover{
            color:#1DA1F2;
        }
        .fa-check-circle{
            color:#1DA1F2;
        }
        .grey{
            color:grey;
        }
        .DJT:hover{
            color:#1DA1F2;
            text-decoration:underline;
        }
        .arrow:hover{
            color:#1DA1F2
        }
        .blue{
            color:#1DA1F2
        }
        .downchev{
            text-align:right;
        }
    </style>
@stop