<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenementScanner extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'evenement_id',
        'user_id',
        'nbr_total_scan',
        'nbr_success_scan',
        'nbr_failed_scan',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evenement()
    {
        return $this->belongsTo('App\Models\Evenement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scanner()
    {
        return $this->belongsTo('App\Models\User');
    }
}
