<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChatsReplies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats_replies', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('chat_chatid')->unsigned();
            $table->integer('user_id');
            $table->integer('parent_replyid')->default(0);
            $table->integer('reply_id');
            $table->string('reply_text');
            $table->boolean('reply_deleted')->default(0);
            $table->foreign('chat_chatid')->references('id')->on('chats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chats_replies');
    }
}
