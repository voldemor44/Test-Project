<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Random;

class TicketController extends Controller
{

    public function buy_ticket($event_id, $typeTicket_id)
    {
        $ticket = Ticket::create([
            'evenement_id' => $event_id,
            'user_id' => Auth::user()->id,
            'type_id' => $typeTicket_id,
            'code' => Random::generate(),
            'isUsed' => false
        ]);

        return redirect()->back();
    }

    public function validateTicket($code)
    {
        // Vérifier si le ticket existe bel et bien

        if (Ticket::where('code', $code)->count() == 1) {

            // verifier si le ticket n'a pas déjà été utilisé

            $ticket = Ticket::where('code', $code)->first();

            if (!$ticket->isUsed) {

                $response = [
                    'existed' => true,
                    'used' => false,
                ];

                $ticket->update([
                    'isUsed' => true,
                ]);

                return response()->json($response);
            } else {
                $response = [
                    'existed' => true,
                    'used' => true,
                ];

                return response()->json($response);
            }
        } else {
            $response = [
                'existed' => false
            ];

            return response()->json($response);
        }
    }
}
