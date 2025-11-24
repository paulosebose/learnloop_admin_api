<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $table = 'subjects';
    
    
     protected $fillable = [
        'subject_name',
        'image',
        'duration',
        'amount',
        'admin_id',
    ];
    
    
      protected $dates = ['deleted_at'];
      
       public function levels()
    {
        return $this->hasMany(Level::class);
    }
    
    public function user()
{
    return $this->belongsTo(User::class);
}


}
