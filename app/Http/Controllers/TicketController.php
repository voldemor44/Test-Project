<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\EvenementScanner;
use App\Models\ScannerTickets;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Random;

class TicketController extends Controller
{

    public function buyTicket($typeTicket_id)
    {
        $ticket = Ticket::create([
            'user_id' => Auth::user()->id,
            'type_id' => $typeTicket_id,
            'code' => Random::generate(),
            'isUsed' => false
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $nta = $user->achat_tickets_nbr;

        $user->update([
            'achat_tickets_nbr' => $nta + 1
        ]);

        $event = $ticket->type()->evenement();
        $nta2 = $event->nbr_tickets_achat;

        $event->update([
            'nbr_tickets_achat' => $nta2 + 1
        ]);

        $type = $ticket->type();
        $response = [
            'event' => $event,
            'ticket' => $ticket,
            'type' => $type,
            'created' => true,
            'message' => "ticket créer avec succès"
        ];

        return response()->json($response);
    }

    public function scanTicket(Request $request)
    {
        $code = $request->query("code");
        $scanner_id = $request->query("scanner_id");

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

            // verifier si ce ticket est bel et bien lié à l'évènement en cours
            if ($ticket->type()->evenement()->id === $scanCurrentEvent->id) {

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
                        'user_id' => Auth::user()->id,
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
                        'user_id' => Auth::user()->id,
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
