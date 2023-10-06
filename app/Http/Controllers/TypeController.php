<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{

    public function create_one_type_ticket($event_id, $nom, $privileges, $prix)
    {

        Type::create([
            'nom' => $nom,
            'privileges' => $privileges,
            'prix' => $prix,
            'evenement_id' => $event_id,
        ]);
    }


    public function store_tickets_event($id, Request $request)
    {
        // $id contient l'id de l'événement auquel on compte créer un type de ticket
        for ($i = 0; $i < $request->nbr_typesTicket; $i++) {
        }
    }

    public function update_type($id, Request $request)
    {
    }


    public function delete_type($id)
    {
    }

    
}
