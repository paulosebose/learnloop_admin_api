<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelAccess extends Model
{
    use HasFactory;
      protected $fillable = [
        'user_id',
        'level_id',
        'accessibility',
    ];
    
     public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with the Level model.
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
