<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{

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

        $contacts = explode(' ', $request->contacts);

        $evenement = Evenement::create([
            'genre_id' => $request->genre,
            'nom' => $request->nom,
            'description' => $request->description,
            'date_heure' => $request->date_heure,
            'adresse' => $request->adresse,
            'contacts' => $contacts,
            'logo_url' => $request->logo_url,
            'nombre_participants' => $request->nbr_p
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $evenement = Evenement::findOrFail($id);

        // Récupération des données envoyées depuis le formulaire
        $genre_id = $request->genre;
        $nom = $request->nom;
        $description = $request->description;
        $date_heure = $request->date_heure;
        $adresse = $request->adresse;
        $contacts = $request->contacts;
        $logo_url = $request->logo_url;
        $nombre_participants = $request->nbr_p;

        if ($genre_id != $evenement->genre_id) {
            $evenement->update([
                'genre_id' => $genre_id
            ]);
        }

        if ($nom != $evenement->nom) {
            $evenement->update([
                'nom' => $nom
            ]);
        }

        if ($description != $evenement->description) {
            $evenement->update([
                'description' => $description
            ]);
        }

        if ($date_heure != $evenement->date_heure) {
            $evenement->update([
                'date_heure' => $date_heure
            ]);
        }

        if ($adresse != $evenement->adresse) {
            $evenement->update([
                'adresse' => $adresse
            ]);
        }

        if ($contacts != $evenement->contacts) {
            $evenement->update([
                'contacts' => $contacts
            ]);
        }

        if ($logo_url != $evenement->logo_url) {
            $evenement->update([
                'logo_url' => $logo_url
            ]);
        }

        if ($nombre_participants != $evenement->nombre_participants) {
            $evenement->update([
                'nombre_participants' => $nombre_participants
            ]);
        }

        return redirect()->back();
    }


    public function destroy($id)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->delete();

        return redirect()->back();
    }
    
}
