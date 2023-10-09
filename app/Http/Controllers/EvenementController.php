<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Type;
use Illuminate\Http\Request;

class EvenementController extends Controller
{

    public function allEeventlist()
    {

        $all_events = Evenement::all();

        return response()->json($all_events);
    }

    public function store(Request $request)
    {

        $request->validate([
            'nom' => 'required|min:3',
            'genre' => 'required',
            'description'   => 'required',
            'adresse'   => 'required',
            'date_heure' => 'required',
            'nbr_p' => 'required',
            'contacts' => 'required',
            'logo_url' => 'required',
        ]);


        $evenement = Evenement::create([
            'genre_id' => $request->genre,
            'nom' => $request->nom,
            'description' => $request->description,
            'date_heure' => $request->date_heure,
            'adresse' => $request->adresse,
            'contacts' => $request->contacts,
            'logo_url' => $request->logo_url,
            'nbr_places_prevu' => $request->nbr_p
        ]);

        $response = [
            'created' => true,
            'message' => "Evenement créé avec succès",
            'event' => $evenement
        ];

        return response()->json($response);
    }


    public function showEvent($eventId)
    {
        $event = Evenement::findOrFail($eventId);
        $typeTicket_event = Type::where('evenement_id', $event->id)->get();

        $response = [
            'event' => $event,
            'typeTicket' => $typeTicket_event
        ];
        return response()->json($response);
    }


    public function update($eventId, Request $request)
    {
        $evenement = Evenement::findOrFail($eventId);

        // Récupération des données envoyées depuis le formulaire
        $genre_id = $request->genre;
        $nom = $request->nom;
        $description = $request->description;
        $date_heure = $request->date_heure;
        $adresse = $request->adresse;
        $contacts = $request->contacts;
        $logo_url = $request->logo_url;
        $nbr_places_prevu = $request->nbr_p;

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
