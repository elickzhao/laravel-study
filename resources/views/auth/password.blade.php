<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>password.blade</title>
  <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
  <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        @include('common.errors')
    <!-- /password/email From-->
    {!! Form::open(['url'=>'/password/email','method'=>'POST']) !!}
        <!-- Email Field -->
        <div class="form-group">
            {!! Form::label('email','Email address',['for'=>'email']) !!}
            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>"Email"]) !!}
        </div>
        {!! Form::submit('提交',['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
    </div>
</body>
</html>