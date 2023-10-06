<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'created_at', 'updated_at', 'nom', 'adresse', 'logo_url', 'date_heure', 'contacts', 'nombre_participants', 'genre_id'];

    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }

    public function scanners()
    {
        return $this->belongsToMany('App\Models\User', 'evenement_scanners', 'evenement_id', 'user_id');
    }

    public function types()
    {
        return $this->hasMany('App\Models\Type', 'evenement_id');
    }
}
