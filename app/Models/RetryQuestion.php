<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetryQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'exam_id',
        'question_id',
        'retry_count',
        'max_retries',
    ];

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
