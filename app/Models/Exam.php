<?php

namespace App\Models;
use App\Models\Level; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=[
        'exam_name',
        'image',
        'level_id',
        'status'
    ];
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class); 
    }
}
