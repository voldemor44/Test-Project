<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use Nette\Utils\Random;
use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Models\ScannerTickets;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\EvenementScanner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{

    // json fait
    public function buyTicket(Request $request)
    {

        $requestJson = $request->json()->all();
        $nbr_type = count($requestJson);
        $nbr_tt = 0;
        $somme_totat_achat = 0;

        $all_tickets_infos = [];

        for ($i = 0; $i < $nbr_type; $i++) {

            if ($requestJson[$i]["nbr_ticket"] > 0) {

                $nbr_tt = $nbr_tt + $requestJson[$i]["nbr_ticket"];

                $nbr_tickets = $requestJson[$i]["nbr_ticket"];
                for ($j = 0; $j < $nbr_tickets; $j++) {

                    $ticket = Ticket::create([
                        'user_id' => $requestJson[$i]["user_id"],
                        'type_id' => $requestJson[$i]["type_id"],
                        'code' => Random::generate(),
                        'isUsed' => false
                    ]);
                    $user = User::findOrFail($requestJson[$i]["user_id"]);
                    $nta = $user->achat_tickets_nbr;

                    $user->update([
                        'achat_tickets_nbr' => $nta + 1
                    ]);

                    $type = $ticket->type;

                    $somme_totat_achat = $somme_totat_achat + $type->prix;

                    $event = $type->evenement;
                    $nta2 = $event->nbr_tickets_achat;

                    $event->update([
                        'nbr_tickets_achat' => $nta2 + 1
                    ]);

                    // génération du code QR
                    $code = $ticket->code;
                    $qrCode = QrCode::size(300)->generate($code);

                    $infos_ticket = [
                        "nom_evenement" => $event->nom,
                        "type_tiket" => $type->nom,
                        "prix_ticket" => $type->prix,
                        "codeQR" => $qrCode,
                        "userID" => $requestJson[$i]["user_id"]
                    ];

                    array_push($all_tickets_infos, $infos_ticket);
                }
            }
        }

        // génération du pdf quitance contenant les infos et les codes QR du ou des ticket(s)

        $user_id = $requestJson[0]["user_id"];
        $user = User::findOrFail($user_id);

        $pdf = Pdf::loadView('quitance', $all_tickets_infos);

        Mail::send('quitance', $all_tickets_infos, function ($message) use ($all_tickets_infos, $pdf) {

            $user_id = $all_tickets_infos[0]["userID"];
            $user = User::findOrFail($user_id);

            $message->to($user->email)
                ->subject("Achat de ticket sur EventShop")
                ->attachData($pdf->output(), "quitance-tickets.pdf");
        }); 

        // envoie du pdf à l'email

        $response = [
            'nbr_total_ticket_achat' =>  $nbr_tt,
            'somme_total_achat' => $somme_totat_achat,
            'infos_quitance' => $all_tickets_infos,
            'message' => "Achat(s) éfectué(s)"
        ];

        return response()->json($response);
    }

    public function scanTicket(Request $request)
    {
        $requestJson = $request->json()->all();
        $code = $requestJson["code"];
        $scanner_id = $requestJson["scanner_id"];

        $scanner_evenements = EvenementScanner::where('user_id', $scanner_id)->get();

        foreach ($scanner_evenements as $scanner_evenement) {
            $event = Evenement::where('id', $scanner_evenement->evenement_id)->first();
            if ($event->statut == 'en cours') {
                $scanCurrentEvent = $event;
                $cse = $scanner_evenement;

                $nbr_ts = $cse->nbr_total_scan;
                $nbr_ss = $cse->nbr_success_scan;
                $nbr_fs = $cse->nbr_failed_scan;
            }
        }

        // Vérifier si le ticket existe bel et bien

        if (Ticket::where('code', $code)->count() == 1) {

            $ticket = Ticket::where('code', $code)->first();
            $type = $ticket->type;
            $evenement = $type->evenement;

            // verifier si ce ticket est bel et bien lié à l'évènement en cours
            if ($evenement->id === $scanCurrentEvent->id) {

                // verifier si le ticket n'a pas déjà été utilisé
                if (!$ticket->isUsed) {

                    $response = [
                        'validated' => true,
                        'message' => "Ce ticket est valide"
                    ];

                    $ticket->update([
                        'isUsed' => true,
                    ]);

                    $cse->update([
                        'nbr_total_scan' => $nbr_ts + 1,
                        'nbr_success_scan' => $nbr_ss + 1
                    ]);

                    // code peut pertinent
                    ScannerTickets::create([
                        'user_id' => $scanner_id,
                        'ticket_id' => $ticket->id,
                        'scan_success' => true,
                    ]);
                    // fin code

                    return response()->json($response);
                } else {
                    $response = [
                        'validated' => false,
                        'message' => "Ce ticket a déjà été utilisé"
                    ];

                    $cse->update([
                        'nbr_total_scan' => $nbr_ts + 1,
                        'nbr_failed_scan' => $nbr_fs + 1
                    ]);

                    // code peut pertinent                                          
                    ScannerTickets::create([
                        'user_id' => $scanner_id,
                        'ticket_id' => $ticket->id,
                        'scan_success' => false,
                    ]);
                    // fin code

                    return response()->json($response);
                }
            } else {

                $cse->update([
                    'nbr_total_scan' => $nbr_ts + 1,
                    'nbr_failed_scan' => $nbr_fs + 1
                ]);

                $response = [
                    'validated' => false,
                    'message' => "Ce ticket n'est pas lié à votre évènement"
                ];

                return response()->json($response);
            }
        } else {

            $cse->update([
                'nbr_total_scan' => $nbr_ts + 1,
                'nbr_failed_scan' => $nbr_fs + 1
            ]);

            $response = [
                'validated' => false,
                'message' => "Ce ticket n'existe pas"
            ];

            return response()->json($response);
        }
    }
}
