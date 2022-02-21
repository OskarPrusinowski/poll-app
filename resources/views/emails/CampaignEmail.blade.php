<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Mail</title>
</head>
<body>
    <h1>{{$campaign['name']}}</h1>
    <p>{{$campaign['file_name']}}</p>
    <p>Thank you</p>
    <h1>{{$contact}}</h1>

    <form action="{{route('contact.read',['id'=>$contact['id']])}}" method="POST" target="_blank">
    @csrf
        <button type="submit">Przeczytałem</button>

</form>
</body>

</html>
