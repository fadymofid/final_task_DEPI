<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_id', 'message', 'status','admin_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'admin_id'); // Adjust 'admin_id' as per your database column
    }
}

