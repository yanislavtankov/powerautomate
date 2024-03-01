<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    protected $fillable = [
        'case',
        'from',
        'subject',
        'message',
        'status',
        'user_id',
        'created_at',
    ];
  
    public function user()
    {
        return $this->belongsTo(User::class);
    }
  
}
