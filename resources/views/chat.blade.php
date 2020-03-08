<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Document</title>
    <style>
        .list-group{
            overflow-y: scroll;
            height: 200px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row" id="app">
            <div class=" offset-4 col-4">
                <li class="list-group-item active">Chat Room</li>
                <ul class="list-group" v-chat-scroll>
                    <message-component
                        v-for="value in chat.message"
                        :key=value.index
                        color="success"
                    >
                        @{{ value }}
                    </message-component>
                </ul>
                <input type="text" placeholder="Ingresa tu mensage" class="form-control" v-model="message" @keyup.enter="send">
            </div>
        </div>
    </div>
<script src="{{asset('js/app.js')}}" ></script>
</body>
</html>
