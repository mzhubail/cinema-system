<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> This is `test_view' </title>
</head>

<body>
    <h1> Hi </h1>
    <br>
    {{ print_r($r->all(), true); }}
    <br>
    @if (isset($_ENV['E']))
        <p> {{ print_r($_ENV['E'], true) }} </p>
    @endif
    <br>
    @foreach ($r->collect() as $k => $v)
        {{ $k }} -> {{ $v }} <br>
    @endforeach
    {{-- <p> {{ print_r($r->collect(), true) }} </p> --}}
    @if (isset($r->email))
        email is {{ $r->email }}
    @else
        no email was sent
    @endif
    <br>
    @if ($r->input('id') !== null)
        id = {{ $r->input('id') }}
    @else
        id is not set
    @endif
    <br>
    <form method="post">
        @csrf
        <input type="text" name="t">
        <input type="submit" value="Submit">
    </form>
    <br>
    @if (isset($is_session_set))
        Session(name): {{ $is_session_set }}
    @endif
    <br>
</body>

</html>
