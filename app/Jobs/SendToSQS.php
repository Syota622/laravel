<?php

// app/Jobs/SendToSQS.php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Aws\Sqs\SqsClient;

class SendToSQS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function handle()
    {
        $client = new SqsClient([
            'region'  => env('SQS_REGION'),
            'version' => 'latest',
            'credentials' => [
                'key'    => env('SQS_KEY'),
                'secret' => env('SQS_SECRET'),
            ]
        ]);

        // SQS にメッセージを送信
        // 「docker-compose -f docker/compose.yml exec app php artisan queue:work」を実行してキューを処理する
        $result = $client->sendMessage([
            'QueueUrl'    => env('SQS_QUEUE'),
            'MessageBody' => $this->message,
            'MessageGroupId' => 'default_group',  // 例として 'default_group' を使用
            'MessageDeduplicationId' => uniqid('', true)  // メッセージ重複を避けるための一意の ID
        ]);

        \Log::info("Message sent to SQS: {$this->message}", ['result' => $result]);
    }
}
