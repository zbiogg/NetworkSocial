<html>
    <head>
        <title>Chat</title>
    </head>
    <body>
        <div>
        @foreach($messages as $m)
            <p>{{$m->fromID}} {{$m->message}}</p>
        @endforeach
        </div>
    </body>
</html>