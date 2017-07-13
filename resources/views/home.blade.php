@extends('layouts.base')
@section('css')
<link href="{{ secure_asset('/css/home.css') }}" rel="stylesheet"/>
@stop
@section('lHome')
active
@stop

@section('body')
    <section id="main" class="container">
    <div id="plate">
        <h1 id="title">SMARTKOV...</h1>
        <p id="subtitle">A Smarter Markov Chain Text Generator for creating Memos from the President</p>
        <form id="input" role="form" method="POST" action="{{ route('generate') }}">
            {{ csrf_field() }}
            <input id="number" type="text" class="form-control" name="number" placeholder="Number of Words"/>
            <button id="memomaker" type="submit" class="btn btn-blk">
                Get The Memo!
            </button>
    </form>
    </div>
    <?php
    
    $properNouns=["i","america","donald","trump","american","americans","american's","america's","january","february","march","april","may","june","july","august","september","october","november","december","hilary","clinton"];
    $imgURLs=["http://combatblog.net/wp-content/uploads/2016/07/donald-trump-grow-up.jpg","http://liberalplug.com/wp-content/uploads/2017/02/19-donald-trump-convention.w710.h473-665x443.jpg","http://static3.businessinsider.com/image/58efe0d68af578622c8b7f2d/trump-and-his-white-house-have-made-some-embarrassing-spelling-mistakes--here-are-the-worst-ones.jpg","http://i.dailymail.co.uk/i/pix/2016/01/22/00/3071834E00000578-3410687-image-a-19_1453423872067.jpg","https://pbs.twimg.com/profile_images/684089818247225344/6OozAYxr.jpg","http://i.telegraph.co.uk/multimedia/archive/00677/hair404a_677734n.jpg","http://i.dailymail.co.uk/i/pix/2016/10/10/02/39411EA400000578-3829999-_Your_hat_strategically_dipped_below_one_eye_Images_of_Trump_wea-m-14_1476061487296.jpg","http://i2.kym-cdn.com/entries/icons/mobile/000/023/327/trumptennisss.jpg"];
    $text = Session::get('text');
    $textArray = explode(" ",$text);
    $n = 0;
    $len = 137;
    $temp = [];
    $out = [];
    $capflag = true;
    $caplockflag = false;
    foreach ($textArray as $word) {
        if((rand (1 , 100)<=10 && $caplockflag) || (rand (1 , 100)<=10 && !$caplockflag)){
            $caplockflag = !$caplockflag;
        }
        if($capflag){
            $word = ucwords($word);
            $capflag = false;
        }
        if(in_array($word, $properNouns) || (strlen($word)==1 && $word != 'a')){
            $word = ucwords($word);
        }
        if($caplockflag){
            $word = strtoupper($word);
        }
        if($len - strlen($word) <= 0){
            $x = implode(" ",$temp);
            array_push($out,$x);
            $temp = [];
            $len = 137;
        }
        $len -= (strlen($word)+1);
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
    <div id="memo">
        <section class="tweet col col-xs-7">
            <div class="pic col-xs-1 col-md-1 col-lg-1">
                <img src="https://pbs.twimg.com/profile_images/874276197357596672/kUuht00m_bigger.jpg"></img>
            </div>
            <div class="col col-xs-10 col-md-10 col-lg-10">
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
                @if((rand (1 , 100)<=20))
                <img id="tweetpic" src="{{$imgURLs[rand (0 , sizeof($imgURLs)-1)]}}"></img>
                @endif
                
                <section class="col col-xs-8 tweet-tabs">
                    <div class="ttcom col col-xs-3"><i class="fa fa-comment-o" aria-hidden="true"></i><br /><span class="tweet-tab-text">{{ (rand (10 , 100) / 10)."k"}}</span></div>
                    <div class="ttref col col-xs-3"><i class="fa fa-refresh" aria-hidden="true"></i><br /><span class="tweet-tab-text">{{ (rand (10 , 100) / 10)."k"}}</span></div>
                    <div class="tthrt col col-xs-3"><i class="fa fa-heart-o" aria-hidden="true"></i><br /><span class="tweet-tab-text">{{ (rand (10 , 100) / 10)."k"}}</span></div>
                    <div class="ttenv col col-xs-3"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                </section>
            </div>
            <div class="col-sm-1 downchev">
                <i class="fa fa-chevron-down grey arrow" aria-hidden="true"></i>
            </div>
        </section>
    </div>
    @endforeach
    <!--@endif-->
    </section>
    
    <style type="text/css">
        
    </style>
@stop