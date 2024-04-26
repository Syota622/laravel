<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendToSQS;

class MessageController extends Controller
{
    // メッセージ送信フォームを表示するメソッド
    public function show()
    {
        return view('messages.form');
    }

    // メッセージをSQSに送信するメソッド
    public function send(Request $request)
    {
        $message = $request->input('message', 'Default message');
        SendToSQS::dispatch($message);

        return response()->json(['message' => 'Message has been sent to SQS!', 'data' => $message]);
    }
}
