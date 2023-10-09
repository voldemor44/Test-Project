<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScannerTickets extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'ticket_id', 'user_id', 'scan_success'];

    public function scanner()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket');
    }
}
