<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResponse extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'exam_id',
        'question_id',
        'selected_option_id',
        'is_correct',
        'incorrect_count',
       'correct_count',
    'completion_time',
    ];
    protected $casts = [
    'completion_time' => 'datetime',
];


    // Optional: Define relationships
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

    public function selectedOption()
    {
        return $this->belongsTo(Option::class, 'selected_option_id');
    }
}
