@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <a href="/Create/chat">Создать тему Чата</a>
                </div>
                @foreach ($data as $chat)
                <div class="panel-body">
                    <div class="ml-2">
                        <span class="p-2 col-md-1"><small>{{$chat->count_chat}}</small></span>
                        <span class="p-2 p-2 col-md-2"><small>{{$chat->name}} </small></span>
                        <span class="p-2"><small>{{\ChatsController::pastTime($chat->created_at)}}</small></span>
                    </div>
                    <div class="list-group-item list-group-item-warning" role="alert">
                        {{ $chat->chats_text }}
                    </div>
                    <div class="ml-2">
                        @if ($chat->blocked==0)
                            <span class="p-2 col-md-2"><a href="/Create/reply/{{$chat->id}}"><small>Ответить</small></a></span>
                        @endif
                    </div>
                </div>
                @if ($chat->count_chat>0)
                    @php($blocked=$chat->blocked)
                    {!! \ReplyController::getReply($chat->id) !!}
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
