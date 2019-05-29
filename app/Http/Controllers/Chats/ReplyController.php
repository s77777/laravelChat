<?php

namespace App\Http\Controllers\Chats;

use App\ChatsReplies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create($id,$reply_id='')
    {
        $chat_text = DB::table('chats')->where('id','=',$id)->select('chats_text')->get()->toArray();
        $array=['chat_id'=>$id,'chat_text'=>$chat_text];
        return view('chats/newReply',['chat_id'=>$id,'parent_replyid'=>$reply_id,'chat_text'=>$chat_text]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request)
    {
        $replyText = $request->input('replyText');
        $chat_id = $request->input('chat_id');
        $parent_replyid= $request->input('parent_replyid');
        $idUser = \Auth::user()->id;
        $reply_id=DB::table('chats_replies')
                    ->where('chat_chatid','=',$chat_id)
                    ->max('reply_id');
        $insert=['chat_chatid' => $chat_id,
                'user_id'=>$idUser,
                'parent_replyid'=>($parent_replyid!=''?$parent_replyid:0),
                'reply_id'=>($reply_id!=null?$reply_id:0)+1,
                'reply_text'=>$replyText,
                'created_at'=>date('Y-m-d H:i:s')];
        DB::table('chats_replies')->insert($insert);
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChatsReplies  $chatsReplies
     * @return \Illuminate\Http\Response
     */
    public function show(ChatsReplies $chatsReplies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChatsReplies  $chatsReplies
     * @return \Illuminate\Http\Response
     */
    public function edit(ChatsReplies $chatsReplies)
    {
        return view('chats/newReply');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChatsReplies  $chatsReplies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChatsReplies $chatsReplies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChatsReplies  $chatsReplies
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatsReplies $chatsReplies)
    {
        //
    }

    /**
     * @param  int $chat_id
     * @return \Illuminate\Http\Response
     */
    public static function getReply($chat_id)
    {
        $replies = DB::table('chats_replies')
            ->leftjoin('chats_blocked_user', function($q)
                    {
                        $q->on('chats_replies.user_id', '=', 'chats_blocked_user.user_id')
                          ->on('chats_replies.chat_chatid', '=', 'chats_blocked_user.chat_id');
                    })
            ->join('users','users.id','=', 'chats_replies.user_id')
            ->where('chats_replies.chat_chatid','=',$chat_id)
            ->where(function ($q) {
                $q->where('chats_blocked_user.blocked','=','0')->orwhereNull('chats_blocked_user.blocked');
            })
            ->select('chats_replies.*','users.name',DB::raw('IFNULL(chats_blocked_user.blocked, "0") as blocked'))
            ->orderBy('chats_replies.reply_id','asc')
            ->get()->toArray();
        return view('chats/block',['chat_id'=>$chat_id,'reply_data' => $replies]);
    }
}
