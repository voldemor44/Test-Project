<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\EvenementScanner;
use App\Models\ScannerTickets;
use App\Models\Ticket;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScannerController extends Controller
{

    public function createAnScanner()
    {
    }


    public function assign_scanner_to_event()
    {
    }

    public function listEventofScanner()
    {
        if (Auth::user()->roles->contains('nom', 'Scanner')) {

            $events_scanner = EvenementScanner::where('user_id', Auth::user()->id)->get();
            $scanned_events = [];

            foreach ($events_scanner as $es) {
                $event = Evenement::findOrFail($es->evenement_id);
                array_push($scanned_events, $event);
            }

            $json_scanned_events = json_encode($scanned_events);

            return $json_scanned_events;
        }
    }

    public function statisticScannerPresent()
    {
        if (Auth::user()->roles->contains('nom', 'Scanner')) {

            $nbr_scan_very_success = 0;
            $nbr_scan_older = 0;

            $scannerTickets = ScannerTickets::where('user_id', Auth::user()->id)->get();

            foreach ($scannerTickets as $st) {
                $ticket = Ticket::where('id', $st->ticket_id)->first();
                $type_ticket = $ticket->type_id;
                $event = $type_ticket->evenement_id;
                if ($event->statut = "en cours") {
                    if ($st->scan_success == true) {
                        $nbr_scan_very_success++;
                    } else {
                        $nbr_scan_older++;
                    }
                }
            }

            $response = [
                'nbr_success' => $nbr_scan_very_success,
                'nbr_echec' => $nbr_scan_older
            ];

            return response()->json($response);
        }
    }


    public function statisticScannerOfPastEvent($event_id)
    {
        if (Auth::user()->roles->contains('nom', 'Scanner')) {

            $nbr_scan_very_success = 0;
            $nbr_scan_older = 0;

            $past_typeTicket = Type::where('evenement_id', $event_id)->get();

            foreach ($past_typeTicket as $ptt) {

                // tous les tickets de cet événements passés ayant ce type
                $past_event_tickets = Ticket::where('type_id', $ptt->id)->get();

                foreach ($past_event_tickets as $pet) {
                    $scannerTicket = ScannerTickets::where('user_id', Auth::user()->id)->where('ticket_id', $pet->id)->get();

                    if ($scannerTicket->scan_success == true) {
                        $nbr_scan_very_success++;
                    } else {
                        $nbr_scan_older++;
                    }
                }
            }

            $response = [
                'nbr_success' => $nbr_scan_very_success,
                'nbr_echec' => $nbr_scan_older
            ];

            return response()->json($response);
        }
    }
}
