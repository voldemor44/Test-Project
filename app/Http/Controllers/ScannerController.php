<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\EvenementScanner;
use App\Models\Role;
use App\Models\ScannerTickets;
use App\Models\Ticket;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScannerController extends Controller
{

    public function createAnScanner(Request $request)
    {
        $user = User::create([
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $role = Role::where('nom', "Scanner")->first();
        $user->roles()->attach($role);

        $reponse = [
            'scanner' => $user,
            'message' => "Scanner créé avec succès"
        ];

        return response()->json($reponse);
    }


    public function assign_scanner_to_event($event_id, $scanner_id)
    {
        EvenementScanner::create([
            'evenement_id' => $event_id,
            'user_id' => $scanner_id
        ]);

        $event = Evenement::findOrFail($event_id);
        $scanner = User::findOrFail($scanner_id);

        $response = [
            'event' => $event,
            'scanner' => $scanner
        ];

        return response()->json($response);
    }



    public function modifyPassword($scanner_id, Request $request)
    {
        $scanner = User::findOrFail($scanner_id);
        $request->validate([
            "password" => 'required'
        ]);

        $password = $request->input("password");

        $scanner->update([
            'password' => $password
        ]);

        $response = [
            "modified" => true,
            "new_password" => $password
        ];

        return response()->json($response);
    }

    public function toConnectScanner(Request $request)
    {

        $email = $request->input("email");
        $password = $request->input("password");

        $nsc = User::where('email', $email)->where('password', $password)->count();

        if ($nsc === 1) {
            $scanner = User::where('email', $email)->where('password', $password)->first();

            return response()->json([
                'authentified' => true,
                'scanner' => $scanner
            ]);
        } else {
            return response()->json([
                'authentified' => false
            ]);
        }
    }

    public function listEventofScanner(Request $request)
    {
        $scanner_id = $request->query("scanner_id");
        $scanner = User::findOrFail($scanner_id);

        if ($scanner->roles->contains('nom', 'Scanner')) {

            $events_scanner = EvenementScanner::where('user_id', Auth::user()->id)->get();
            $scanned_events = [];

            foreach ($events_scanner as $es) {
                $event = Evenement::findOrFail($es->evenement_id);
                array_push($scanned_events, $event);
            }

            return response()->json($scanned_events);
        }
    }

    public function statisticScannerPresent(Request $request)
    {
        $scanner_id = $request->query("scanner_id");
        $scanner = User::findOrFail($scanner_id);

        if ($scanner->roles->contains('nom', 'Scanner')) {

            $scanner_evenements = EvenementScanner::where('user_id', Auth::user()->id)->get();

            foreach ($scanner_evenements as $scanner_evenement) {

                $event = Evenement::where('id', $scanner_evenement->evenement_id)->first();

                if ($event->statut == 'en cours') {

                    $event_name = $event->nom;
                    $nbrTicketforEvent = $event->nbr_places_prevu;
                    $cse = $scanner_evenement;

                    $nbr_ts = $cse->nbr_total_scan;
                    $nbr_ss = $cse->nbr_success_scan;
                    $nbr_fs = $cse->nbr_failed_scan;
                }
            }

            $statistic_info = [
                'event_name' => $event_name,
                'event_nbr_ticket' => $nbrTicketforEvent,
                'nbr_total_scan' => $nbr_ts,
                'nbr_success_scan' => $nbr_ss,
                'nbr_failed_scan' => $nbr_fs
            ];

            return response()->json($statistic_info);
        }
    }


    public function statisticScannerPastEvent(Request $request)
    {
        $event_id = $request->query('event_id');
        $scanner_id = $request->query('scanner_id');
        $scanner = User::findOrFail($scanner_id);

        if ($scanner->roles->contains('nom', 'Scanner')) {

            $pse = EvenementScanner::where('user_id', Auth::user()->id)
                ->where('evenement_id', $event_id)
                ->first();

            $nbr_ts = $pse->nbr_total_scan;
            $nbr_ss = $pse->nbr_success_scan;
            $nbr_fs = $pse->nbr_failed_scan;

            $statistic = [
                'nbr_total_scan' => $nbr_ts,
                'nbr_success_scan' => $nbr_ss,
                'nbr_failed_scan' => $nbr_fs
            ];

            return response()->json($statistic);
        }
    }
}
