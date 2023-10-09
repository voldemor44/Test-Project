<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Token extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'string',
        'created_at',
        'updated_at'
    ];

    public function scanner()
    {
        return $this->hasOne(User::class);
    }
}
