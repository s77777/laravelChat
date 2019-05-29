@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                   <form action="/Chats/store" method="get">
                    <div class="form-group">
                        <label for="chat_text">Тема чата</label>
                            <textarea class="form-control" id="chat_text" rows="3" name="chatText"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Создать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection