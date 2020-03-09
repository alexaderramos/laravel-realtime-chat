<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <div class=" offset-4 col-4 offset-sm-1 col-sm-10">
                <li class="list-group-item active">Chat Room
                    <span class="badge badge-danger">@{{ numberOfUsers }}</span>

                </li>
                <div class="badge badge-pill badge-primary">@{{ typing }}</div>
                <ul class="list-group" v-chat-scroll>
                    <message-component
                        v-for="(value,index) in chat.message"
                        :key=value.index
                        :user = chat.user[index]
                        :color=chat.color[index]
                        :time = chat.time[index]
                    >
                        @{{ value }}
                    </message-component>
                </ul>
                <input type="text" placeholder="Ingresa tu mensage" class="form-control" v-model="message" @keyup.enter="send">
                <a href="" class="btn btn-sm btn-danger mt-3" @click.prevent="deleteSession">Delete Chats</a>
            </div>
        </div>
    </div>
<script src="{{asset('js/app.js')}}" ></script>
</body>
</html>
