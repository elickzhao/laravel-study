<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>reset.blade</title>
  <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
  <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        @include('common.errors')
        <!-- /password/reset From-->
        {!! Form::open(['url'=>'/password/reset']) !!}
        <input type="hidden" name="token" value="{{ $token }}">
            <!-- Email Field -->
            <div class="form-group">
                {!! Form::label('email','Email address',['for'=>'email']) !!}
                {!! Form::email('email',null,['class'=>'form-control','placeholder'=>"Email"]) !!}
            </div>
            
            <!-- '新密码' Field -->
            <div class="form-group">
                {!! Form::label('password','新密码',['for'=>'password']) !!}
                {!! Form::text('password',null,['class'=>'form-control','placeholder'=>"新密码"]) !!}
            </div>

            <!-- password_confirmation Field -->
            <div class="form-group">
                {!! Form::label('password_confirmation','确认密码',['for'=>'password_confirmation']) !!}
                {!! Form::password('password',['class'=>'form-control','placeholder'=>"确认密码",'id'=>'password_confirmation','name'=>'password_confirmation']) !!}
            </div>

            {!! Form::submit('提交',['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</body>
</html>