<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verification Email</title>
</head>
<body>
    Hello {{ $user->name }} <br> 
    {{ $encrypt }}
    {{ $decrypt }}
    New Verification Email!!
    Click this button to verify your email .
    <a href="{{ route('email.verify', $encrypt) }}">Verify Email</a>
</body>
</html>