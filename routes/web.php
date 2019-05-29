<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'Chats\ChatsController@index')->middleware('auth');
Route::get('/home', 'Chats\ChatsController@index')->middleware('auth');
Route::get('/Create/{action}/{id?}/{reply_id?}', function($action,$id=null,$reply_id=''){
    switch ($action) {
        case 'chat':
            return ChatsController::create();
            break;
        case 'reply':
            return ReplyController::create($id,$reply_id);
            break;
        default:
            break;
    }
})->middleware('auth');
Route::get('/Store/chat', 'Chats\ChatsController@store')->middleware('auth');
Route::get('/Store/reply', 'Chats\ReplyController@store')->middleware('auth');
