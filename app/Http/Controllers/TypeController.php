<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{


    public function create_TypeticketEvent(Request $request)
    {
        // $id contient l'id de l'événement auquel on compte créer un type de ticket
        $type = Type::create([
            'evenement_id' => $request->eventId,
            'nom' => $request->nom,
            'privileges' => $request->plg,
            'prix' => $request->prix
        ]);

        $response = [
            'type' => $type,
            'created' => true,
            'message' => "type créé avec succès "
        ];

        return response()->json($response);
    }

    public function update_type($id, Request $request)
    {
        $typeEvent = Type::findOrFail($id);

        $nom = $typeEvent->nom;
        $privileges = $typeEvent->privileges;
        $prix = $typeEvent->prix;

        $response = [
            'created' => true,
            'type' => $typeEvent,
            'message' => "Type de ticket créé avec succès"
        ];

        return response()->json($response);
    }


    public function delete_type($id)
    {
        $typeEvent = Type::findOrFail($id);
        $typeEvent->delete();

        $response = [
            'destroyed' => true,
            'message' => "Ce type à été suprimé avec succès"
        ];
    }
}
