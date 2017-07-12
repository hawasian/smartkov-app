@extends('layouts.base')
@section('css')

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
    $imgURLs=["http://combatblog.net/wp-content/uploads/2016/07/donald-trump-grow-up.jpg","http://liberalplug.com/wp-content/uploads/2017/02/19-donald-trump-convention.w710.h473-665x443.jpg","http://static3.businessinsider.com/image/58efe0d68af578622c8b7f2d/trump-and-his-white-house-have-made-some-embarrassing-spelling-mistakes--here-are-the-worst-ones.jpg","http://i.dailymail.co.uk/i/pix/2016/01/22/00/3071834E00000578-3410687-image-a-19_1453423872067.jpg","https://pbs.twimg.com/profile_images/684089818247225344/6OozAYxr.jpg","http://i.telegraph.co.uk/multimedia/archive/00677/hair404a_677734n.jpg","http://i.dailymail.co.uk/i/pix/2016/10/10/02/39411EA400000578-3829999-_Your_hat_strategically_dipped_below_one_eye_Images_of_Trump_wea-m-14_1476061487296.jpg"];
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
        #title{
            font-family: 'Jura', sans-serif;
            color: #26D928;
        }
        #subtitle{
            font-family: 'Ubuntu', sans-serif;
            color: #26D928;
        }
        #input{
            margin: 30px 0;
        }
        #input input, #input button{
            display: inline-block;
        }
        #number{
            width:20%;
            min-width:160px;
        }
        #memo{
            display:flex;
        }
        #memomaker{
            margin-top:-3px;
        }
        #main{
            min-width:700px;
        }
        #plate{
            text-align: center;
        }
        #tweetpic{
            margin-bottom:10px;
            border-radius:5px;
            max-width:100%;
        }
        .tweet{
            background:white;
            padding:7px 0px;
            z-index:15;
            margin: 1px auto;
            border-radius:3px;
            min-width: 646px;
        }
        .pic{
            margin-top:10px;
            text-align: right;
        }
        .pic img{
            border-radius:50%;
            height:48px;
            width:48px;
        }
        input[type=text],
        input[type=email],
        textarea {
            width: 100%;
            background-color: #1d291d;
            color: #26D928;
            font-size: 1.05em;
            padding: 7px;
            border: thin #1ead20 solid;
            outline-color: #26D928;
            font-family: 'Ubuntu', sans-serif;
        }
        input[type="text"]:focus{
            border-color: rgba(126, 239, 104, 0.8);
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(126, 239, 104, 0.6);
            outline: 0 none;
        }
        input[type=text]::-webkit-input-placeholder { /* Chrome/Opera/Safari */
            color: #748b75;
        }
        input[type=text]::-moz-placeholder { /* Firefox 19+ */
            color: #748b75;
        }
        input[type=text]:-ms-input-placeholder { /* IE 10+ */
            color: #748b75;
        }
        input[type=text]:-moz-placeholder { /* Firefox 18- */
            color: #748b75;
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
        .btn-blk { 
          color: #26D928; 
          background-color: #090D0E; 
          border: thin solid #26D928; 
        } 
         
        .btn-blk:hover, 
        .btn-blk:focus, 
        .btn-blk:active, 
        .btn-blk.active, 
        .open .dropdown-toggle.btn-blk { 
          color: #26D928; 
          background-color: #364036; 
          border-color: #26D928; 
        } 
         
        .btn-blk:active, 
        .btn-blk.active, 
        .open .dropdown-toggle.btn-blk { 
          background-image: none; 
        } 
         
        .btn-blk.disabled, 
        .btn-blk[disabled], 
        fieldset[disabled] .btn-blk, 
        .btn-blk.disabled:hover, 
        .btn-blk[disabled]:hover, 
        fieldset[disabled] .btn-blk:hover, 
        .btn-blk.disabled:focus, 
        .btn-blk[disabled]:focus, 
        fieldset[disabled] .btn-blk:focus, 
        .btn-blk.disabled:active, 
        .btn-blk[disabled]:active, 
        fieldset[disabled] .btn-blk:active, 
        .btn-blk.disabled.active, 
        .btn-blk[disabled].active, 
        fieldset[disabled] .btn-blk.active { 
          background-color: #090D0E; 
          border-color: #26D928; 
        } 
         
        .btn-blk .badge { 
          color: #090D0E; 
          background-color: #26D928; 
        }
    </style>
@stop