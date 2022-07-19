<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Massage extends Model
{
    use HasFactory;
    public function userFrom()
    {
        return $this->belongsTo(User::class, 'user_id_from');
    }
    public function scopeNotDeleted($query)
    {
        return $query->where('deleted', false);
    }
}
