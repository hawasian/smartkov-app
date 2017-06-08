<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    <style type="text/css">
        .input-group-addon:first-child {
            width: 20%;
        }
    </style>
    
    
    <section class="container">
    @if(Session::has('error'))
        <p>{{ Session::get('error') }}</p>
    @endif
    <h1>Login Page</h1>
    <form role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user-secret" aria-hidden="true"></i></span>
            <input id="email" type="text" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
            <input id="password" type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
    </form>
    
    <a href="{{ route('logout') }}">Log Out</a> <br />
    <a href="{{ route('change') }}">Change Password</a>
    </section>
    <!--    Scripts    -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
</body>
</html>