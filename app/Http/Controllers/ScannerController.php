<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\EvenementScanner;
use App\Models\Role;
use App\Models\ScannerTickets;
use App\Models\Ticket;
use App\Models\Token;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScannerController extends Controller
{

    // json fait
    public function createAnScanner(Request $request)
    {
        $requestJson = $request->json()->all();

        $user = User::create([
            'nom' => $requestJson["nom"],
            'prenoms' => $requestJson["prenoms"],
            'email' => $requestJson["email"],
            'telephone' => $requestJson["telephone"],
            'password' => $requestJson["password"]
        ]);

        $role = Role::where('nom', "Scanner")->first();
        $user->roles()->attach($role);

        $reponse = [
            'scanner' => $user,
            'message' => "Scanner créé avec succès"
        ];

        return response()->json($reponse);
    }


    // json fait
    public function assign_scanner_to_event(Request $request)
    {
        $requestJson = $request->json()->all();

        $event_id = $requestJson["event_id"];
        $scanner_id = $requestJson["scanner_id"];

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

    // json fait
    public function modifyProfilScanner(Request $request)
    {
        $requestJson = $request->json()->all();

        $scanner_id = $requestJson["scanner_id"];

        $scanner = User::findOrFail($scanner_id);

        if ($requestJson["nouveau_nom"] !== null && $scanner->nom !== $requestJson["nouveau_nom"]) {
            $new_nom = $requestJson["nouveau_nom"];

            $scanner->update([
                'nom' => $new_nom
            ]);
        }

        if ($requestJson["nouveau_prenoms"] !== null && $scanner->prenoms !== $requestJson["nouveau_prenoms"]) {
            $new_prenoms = $requestJson["nouveau_prenoms"];

            $scanner->update([
                'prenoms' => $new_prenoms
            ]);
        }

        if ($requestJson["nouveau_tel"] !== null && $scanner->telephone !==  $requestJson["nouveau_tel"]) {
            $new_tel = $requestJson["nouveau_tel"];

            $scanner->update([
                'telephone' => $new_tel
            ]);
        }


        return response()->json($scanner);
    }

    // json fait
    public function modifyScannerPassword(Request $request)
    {
        $requestJson = $request->json()->all();
        $scanner_id = $requestJson["scanner_id"];
        $new_password = $requestJson["new_password"];

        $scanner = User::findOrFail($scanner_id);

        if ($new_password !== null && $new_password !== $scanner->password) {

            $scanner->update([
                'password' => $new_password
            ]);

            $response = [
                "modified" => true,
                "new_password" => $new_password
            ];

            return response()->json($response);
        } else {

            $response = [
                "modified" => false,
                "error" => "Champ non rempli"
            ];

            return response()->json($response);
        }
    }

    // json fait
    public function toConnectScanner(Request $request)
    {

        $requestJson = $request->json()->all();

        $email = $requestJson["email"];
        $password = $requestJson["password"];

        $nsc = User::where('email', $email)->where('password', $password)->count();

        if ($nsc === 1) {

            $scanner = User::where('email', $email)->where('password', $password)->first();

            $roles = $scanner->roles;

            if ($roles->contains('nom', 'Scanner')) {
                $token = Token::create([
                    'user_id' => $scanner->id,
                    'string' => \Illuminate\Support\Str::random(60)
                ]);

                return response()->json([
                    'authentified' => true,
                    'scanner' => $scanner,
                    'token' => $token->string
                ]);
            } else {
                return response()->json([
                    'authentified' => false,
                    'message' => "Vous n'avez le rôle de scanner",
                ]);
            }
        } else {
            return response()->json([
                'authentified' => false,
                'message' => "Vous n'êtes pas dans la base de donnée"
            ]);
        }
    }


    public function toDeconnectScanner(Request $request)
    {
        $requestJson = $request->json()->all();
        $scanner_id = $requestJson["scanner_id"];
        $token = Token::where('user_id', $scanner_id)->first();
        $token->delete();

        $response = [
            'deconnected' => true,
            'message' => "Déconnexion effectué"
        ];

        return response()->json($response);
    }


    //json fait
    public function listEventofScanner(Request $request)
    {
        $requestJson = $request->json()->all();
        $scanner_id = $requestJson["scanner_id"];
        $scanner = User::findOrFail($scanner_id);
        $roles = $scanner->roles;

        if ($roles->contains('nom', 'Scanner')) {

            $events_scanner = EvenementScanner::where('user_id', $scanner_id)->get();
            $scanned_events = [];

            foreach ($events_scanner as $es) {
                $event = Evenement::findOrFail($es->evenement_id);
                array_push($scanned_events, $event);
            }

            return response()->json($scanned_events);
        }
    }


    // json fait
    public function statisticScannerPresent(Request $request)
    {
        $requestJson = $request->json()->all();
        $scanner_id = $requestJson["scanner_id"];
        $scanner = User::findOrFail($scanner_id);
        $roles = $scanner->roles;

        if ($roles->contains('nom', 'Scanner')) {

            $scanner_evenements = EvenementScanner::where('user_id', $scanner_id)->get();

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


    // json fait
    public function statisticScannerPastEvent(Request $request)
    {
        $requestJson = $request->json()->all();
        $scanner_id = $requestJson["scanner_id"];
        $event_id = $requestJson["event_id"];
        $scanner = User::findOrFail($scanner_id);
        $roles = $scanner->roles;

        if ($roles->contains('nom', 'Scanner')) {

            $pse = EvenementScanner::where('user_id', $scanner_id)
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
