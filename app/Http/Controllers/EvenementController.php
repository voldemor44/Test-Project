<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Type;
use Illuminate\Http\Request;

class EvenementController extends Controller
{

    // json fait
    public function allEeventlist()
    {

        $all_events = Evenement::all();

        return response()->json($all_events);
    }

    // json fait
    public function store(Request $request)
    {

        /*  $request->validate([
            'nom' => 'required|min:3',
            'genre' => 'required',
            'description'   => 'required',
            'adresse'   => 'required',
            'date_heure' => 'required',
            'nbr_p' => 'required',
            'contacts' => 'required',
            'logo_url' => 'required',
        ]);*/

        // à revoir
        $requestJson = $request->json()->all();
       
       // $logo = $requestJson["logo"];
       // $filename = time() . '.' . $logo->extension();
       // $path = $logo->storeAs('images', $filename, 'public');

        $evenement = Evenement::create([
            'genre_id' => $requestJson["genre"],
            'nom' => $requestJson["nom"],
            'description' => $requestJson["description"],
            'date_heure' => $requestJson["date_heure"],
            'adresse' => $requestJson["adresse"],
            'contacts' => $requestJson["contacts"],
            'logo_url' => $requestJson["logo_url"],
            'nbr_places_prevu' => $requestJson["nbr_places"],
            'nbr_tickets_restant' => $requestJson["nbr_places"]
        ]);

        $response = [
            'created' => true,
            'message' => "Evenement créé avec succès",
            'event' => $evenement
        ];

        return response()->json($response);
    }


    // json fait
    public function showEvent(Request $request)
    {
        $requestJson = $request->json()->all();
        $event_id = $requestJson["event_id"];

        $event = Evenement::findOrFail($event_id);
        $typeTicket_event = Type::where('evenement_id', $event->id)->get();

        $response = [
            'event' => $event,
            'typeTicket' => $typeTicket_event
        ];
        return response()->json($response);
    }


    // json fait
    public function update(Request $request)
    {

        $requestJson = $request->json()->all();
        $event_id = $requestJson["event_id"];
        $evenement = Evenement::findOrFail($event_id);

        // Récupération des données envoyées depuis le formulaire
        $genre_id = $requestJson["genre"];
        $nom = $requestJson["nom"];
        $description = $requestJson["description"];
        $date_heure = $requestJson["date_heure"];
        $adresse = $requestJson["adresse"];
        $contacts = $requestJson["contacts"];
        $logo_url = $requestJson["logo_url"];
        $nbr_places_prevu = $requestJson["nbr_places"];

        if ($genre_id !== null && $genre_id !== $evenement->genre_id) {
            $evenement->update([
                'genre_id' => $genre_id
            ]);
        }

        if ($nom !== null && $nom !== $evenement->nom) {
            $evenement->update([
                'nom' => $nom
            ]);
        }

        if ($description !== null && $description !== $evenement->description) {
            $evenement->update([
                'description' => $description
            ]);
        }

        if ($date_heure !== null && $date_heure !== $evenement->date_heure) {
            $evenement->update([
                'date_heure' => $date_heure
            ]);
        }

        if ($adresse !== null && $adresse !== $evenement->adresse) {
            $evenement->update([
                'adresse' => $adresse
            ]);
        }

        if ($contacts !== null && $contacts !== $evenement->contacts) {
            $evenement->update([
                'contacts' => $contacts
            ]);
        }

        if ($logo_url !== null && $logo_url !== $evenement->logo_url) {
            $evenement->update([
                'logo_url' => $logo_url
            ]);
        }

        if ($nbr_places_prevu !== null && $nbr_places_prevu !== $evenement->nbr_places_prevu) {
            $evenement->update([
                'nbr_places_prevu' => $nbr_places_prevu
            ]);
        }

        $response = [
            'updated' => true,
            'message' => "Evenement modifié avec succès",
            'eventUpdated' => $evenement,
        ];

        return response()->json($response);
    }


    public function destroy($eventId)
    {
        $evenement = Evenement::findOrFail($eventId);
        $evenement->delete();

        $response = [
            'destroyed' => true,
            'message' => "L'événement à été suprimé avec succès"
        ];

        return response()->json($response);
    }
}
