<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password Email</title>
</head>
<body>
    <h1>Hello {{ $mailData['user']->name }}</h1>
   
    <p>Click below to Change Your Password.</p>

    <a href="{{ route("Reset.Password",$mailData['token']) }}"> Click Here </a>

    <p>Thank You</p>
</body>
</html>