<?php

namespace App\Http\Controllers;

use App\Mail\MyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth')->except('sndview', 'mailEdit', 'mailSend');
    }

    public function firstview()
    {
        return view('test.vue1');
    }

    public function sndview()
    {
        if (!Gate::allows('access-admin')) {
            abort('403');
        }
        return view('test.vue2');
    }


    public function mailEdit()
    {
        return view('sendMail');
    }

    public function mailSend(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'smail' => 'required|email',
            'message' => 'required',
            'dmail' => 'required|email'
        ]);

        $data = [
            'name' => $request->name,
            'mail' => $request->smail,
            'message' => $request->message,
        ];

        // Envoie de l'email et redirection
        Mail::to($request->dmail)->send(new MyMail($data));
        return redirect()->route('dashboard');
    }
}
