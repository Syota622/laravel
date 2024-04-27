<?php

namespace App\Jobs;

use App\Models\SqsMessage;
use Aws\Sqs\SqsClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log; 

class ProcessSqsMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    // コンストラクタでデータを受け取る
    public function __construct($data = null)
    {
        $this->data = $data ?? []; // デフォルト値として空の配列を設定
    }

    public function handle()
    {
        try {
            // データを使用する前にチェック
            if (empty($this->data)) {
                Log::error('Job data is missing or empty.');
                return;
            }

            Log::info('Processing job with data:', ['data' => $this->data]);

            $client = new SqsClient([
                'region' => env('SQS_REGION'),
                'version' => 'latest',
                'credentials' => [
                    'key'    => env('SQS_KEY'),
                    'secret' => env('SQS_SECRET'),
                ]
            ]);

            $result = $client->receiveMessage([
                'QueueUrl' => env('SQS_QUEUE'),
                'AttributeNames' => ['SentTimestamp'],
                'MaxNumberOfMessages' => 1,
                'MessageAttributeNames' => ['All'],
                'WaitTimeSeconds' => 20,
            ]);

            if (empty($result->get('Messages'))) {
                Log::info('No messages received from SQS.');
                return;
            }

            foreach ($result->get('Messages') as $message) {
                $body = $message['Body'];
                Log::info('Received message from SQS:', ['body' => $body]);

                SqsMessage::create(['message' => $body]);
                Log::info('Message stored in database successfully');

                $client->deleteMessage([
                    'QueueUrl' => env('SQS_QUEUE'),
                    'ReceiptHandle' => $message['ReceiptHandle']
                ]);
                Log::info('Message deleted from SQS queue successfully');
            }
        } catch (\Exception $e) {
            Log::error('Error processing the job', [
                'error' => $e->getMessage(),
                'data' => $this->data // エラーログでデータも表示
            ]);
            $this->fail($e);
        }
    }
}
