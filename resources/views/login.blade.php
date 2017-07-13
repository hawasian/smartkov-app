@extends('layouts.base')
@section('css')

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
    
    <style type="text/css">
        #sub{
            width:100%;
        }
        #changepass{
            color:#26D928;
        }
        h1{
            font-family: 'Jura', sans-serif;
            color:#26D928;
            text-align:center;
        }
        input[type=text],
        input[type=password],
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
        input[type=text]:focus, input[type=password]:focus{
            border-color: rgba(126, 239, 104, 0.8);
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(126, 239, 104, 0.6);
            outline: 0 none;
        }
        input[type=text]::-webkit-input-placeholder, input[type=password]::-webkit-input-placeholder { /* Chrome/Opera/Safari */
            color: #748b75;
        }
        input[type=text]::-moz-placeholder, input[type=password]::-moz-placeholder { /* Firefox 19+ */
            color: #748b75;
        }
        input[type=text]:-ms-input-placeholder, input[type=password]:-ms-input-placeholder { /* IE 10+ */
            color: #748b75;
        }
        input[type=text]:-moz-placeholder, input[type=password]:-moz-placeholder { /* Firefox 18- */
            color: #748b75;
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
        .input-group{
            margin-bottom: 10px;
        }
        .input-group-addon{
            color:#26D928;
            background-color:#171717;
            border-color:#26D928;
        }
    </style>
@stop