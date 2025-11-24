<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'amount',
        'payment_id',
        'user_id',
        'status',
    ];
    
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    
    
    public function user()
{
    return $this->belongsTo(User::class);
}
}
