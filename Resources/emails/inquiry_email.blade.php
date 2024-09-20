<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $subject }}</title>
</head>
<body>
<h1>{{ $subject }}</h1>
<p></p>
<p>{{ __('messages.name') }}: {{ $data['from_name'] }}</p>
<p>{{ __('messages.tel') }}: {{ $data['from_phone'] }}</p>
<p>{{ __('messages.email') }}: {{ $data['from_email'] }}</p>
<p>{{ $data['description'] }}</p>
</body>
</html>
