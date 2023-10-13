<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{


    // json fait
    public function create_TypeticketEvent(Request $request)
    {
        $requestJson = $request->json()->all();
        // $id contient l'id de l'événement auquel on compte créer un type de ticket
        $nbr_dispo = $requestJson["nbr_dispo"];

        $type = Type::create([
            'evenement_id' => $requestJson["event_id"],
            'nom' => $requestJson["nom"],
            'privileges' => $requestJson["privileges"],
            'prix' => $requestJson["prix"],
            'nbr_dispo' => $nbr_dispo
        ]);

        $response = [
            'type' => $type,
            'created' => true,
            'message' => "type créé avec succès "
        ];

        return response()->json($response);
    }

    // supposé json fait
    public function update_type(Request $request)
    {
        $requestJson = $request->json()->all();
        $type_id = $requestJson["type_id"];

        $typeEvent = Type::findOrFail($type_id);

        $nom = $typeEvent->nom;
        $privileges = $typeEvent->privileges;
        $prix = $typeEvent->prix;

        $new_type_nom = $requestJson["new_type_nom"];
        $new_type_pvlg = $requestJson["new_type_pvlg"];
        $new_type_prix = $requestJson["new_type_prix"];

        if ($new_type_nom !== null && $new_type_nom !== $nom) {
            $typeEvent->update([
                'nom' => $new_type_nom
            ]);
        }

        if ($new_type_pvlg !== null && $new_type_nom !== $privileges) {
            $typeEvent->update([
                'privileges' => $new_type_pvlg
            ]);
        }

        if ($new_type_prix !== null && $new_type_nom !== $prix) {
            $typeEvent->update([
                'prix' => $new_type_prix
            ]);
        }

        $response = [
            'updated' => true,
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
