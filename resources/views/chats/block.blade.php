@php($padding=10)
@foreach ($reply_data as $reply)
    @if($reply->parent_replyid>0)
        @php($padding=$padding+10)
    @else
        @php($padding=10)
    @endif
    <div class="panel-body" style="padding-left:{{$padding}}rem">
        <div class="ml-2">
            <span class="p-2 col-md-1"><small></small></span>
            <span class="p-2 p-2 col-md-2"><small>{{$reply->name}} </small></span>
            <span class="p-2"><small>{{\ChatsController::pastTime($reply->created_at)}}</small></span>
        </div>
        <div class="list-group-item list-group-item-warning" role="alert">
            {{ $reply->reply_text }}
        </div>
        <div class="ml-2">
            <span class="p-2 col-md-2"><a href="/Create/reply/{{$chat_id}}/{{$reply->reply_id}}"><small>Ответить</small></a></span>
        </div>
    </div>
@endforeach
