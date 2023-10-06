<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'evenement_id', 'privileges ', 'prix', 'created_at', 'updated_at', 'nom'];

    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function evenement()
    {
        return $this->belongsTo('App\Models\Evenement', 'evenement_id');
    }
}
