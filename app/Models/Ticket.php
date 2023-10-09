<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'type_id',
        'code',
        'isUsed',
        'created_at',
        'updated_at'
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function scanner()
    {
        return $this->belongsTo('App\Models\User', 'scanner_id');
    }
}
