<?php

namespace App\Http\Controllers\Chats;

use App\Chats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chats = DB::table('chats')
            ->leftjoin('chats_blocked_user', function($q)
                    {
                        $q->on('chats.user_id', '=', 'chats_blocked_user.user_id')
                            ->on('chats.id', '=', 'chats_blocked_user.chat_id');

                    })
            ->join('users','users.id','=', 'chats.user_id')
            ->leftjoin('chats_replies','chats_replies.chat_chatid','=', 'chats.id')
            ->where('chats_blocked_user.blocked','=','0')
            ->orwhereNull('chats_blocked_user.blocked')
            ->select('chats.*','users.name',DB::raw('IFNULL(chats_blocked_user.blocked, "0") as blocked'),DB::raw('count(chats_replies.chat_chatid) as count_chat'))
            ->groupBy('chats.id','chats_blocked_user.blocked')
            ->orderBy('chats.id','asc')
            ->get()->toArray();
        return view('chats/home',['data' => $chats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create()
    {
        return view('chats/new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chatText = $request->input('chatText');
        $idUser = \Auth::user()->id;
        DB::table('chats')->insert(
            ['chats_text' => $chatText,'user_id'=>$idUser,'created_at'=>date('Y-m-d H:i:s')]
        );
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function show(Chats $chats)
    {
        return view('chats/new');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function edit(Chats $chats)
    {
        return view('chats/new');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chats $chats)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chats $chats)
    {
        //
    }

     /**
     * past time.
     *
     * @param  date  $dateString
     * @return past time
     */
    static function pastTime($dateString)
    {
        $now=new \DateTime();
        $st=new \DateTime($dateString);
        $diff=$now->diff($st);
        $d=$diff->format('%a');
        $h=$diff->format('%h');
        $m=$diff->format('%i');
        return ($d!=0?$d.' дн. ':'').($h==0?'':$h.' час.').($m==0?'':$m.' мин.');

    }
}
