@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Тема</div>
                <div class="list-group-item list-group-item-warning" role="alert">
                        {{ $chat_text[0]->chats_text }}
                </div>
                <div class="panel-body">
                   <form action="/Store/reply" method="get">
                        <div class="form-group">
                            <label for="chat_text">Ответ</label>
                                <textarea class="form-control" id="reply_text" rows="3" name="replyText"></textarea>
                        </div>
                       <input type="hidden" name="chat_id" value="{{$chat_id}}">
                       <input type="hidden" name="parent_replyid" value="{{$parent_replyid}}">
                        <button type="submit" class="btn btn-primary mb-2">Ответить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection