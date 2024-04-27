<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessSqsMessage;
use Illuminate\Http\Request;

class MessageProcessingController extends Controller
{
    public function start(Request $request)
    {
        ProcessSqsMessage::dispatch();
        return response()->json(['message' => 'Processing started.']);
    }
}