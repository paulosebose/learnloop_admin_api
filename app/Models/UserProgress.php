<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    use HasFactory;
  

    protected $fillable = [
        'user_id',
        'level_id',
        'exam_id',
        'status',
        'correct_count',
        'incorrect_count',
        'total_questions',
        'is_completed',    
        'is_accessible', 
        'exam_accessible',
        'answered_questions', // Assuming this is a JSON field as well
        'incorrect_questions',
       
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

   
}
