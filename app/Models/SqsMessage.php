<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SqsMessage extends Model
{
    use HasFactory;

    protected $table = 'sqs_messages';
    protected $fillable = ['message'];
}
