<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'exam_id',  
        'question',  
        'image_position',
        'image',
        'admin_id',
        'remaining_repeats',
        'reason',
    ];
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class); 
    }
    // In Question.php model
public function admin()
{
    return $this->belongsTo(User::class, 'admin_id');
}

}
