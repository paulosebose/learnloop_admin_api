<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'level_name',
        'image',
        'paid',
    ];
     public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function exams()
{
    return $this->hasMany(Exam::class, 'level_id');
}

}
