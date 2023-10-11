<?php

namespace App\Http\Controllers;

use App\Mail\MailToInscription;
use App\Models\Role;
use App\Models\User;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BasicActionController extends Controller
{
    // json fait
    public function inscription(Request $request)
    {
        $requestJson = $request->json()->all();

        $nom = $requestJson["nom"];
        $prenoms = $requestJson["prenoms"];
        $email = $requestJson["email"];
        $tel = $requestJson["telephone"];
        $genre_id = $requestJson["genre"];
        $password = $requestJson["password"];

        $user = User::create([
            'nom' => $nom,
            'prenoms' => $prenoms,
            'email' => $email,
            'telephone' => $tel,
            'genre_id' => $genre_id,
            'password' => $password,
        ]);

        $role = Role::where('nom', "Participant")->first();
        $user->roles()->attach($role);

        $token = Token::create([
            'user_id' => $user->id,
            'string' => \Illuminate\Support\Str::random(60)
        ]);

        $response = [
            "subscribed" => true,
            "user" => $user,
            "token" => $token->string
        ];

        $data = [
            "username" => $user->nom . $user->prenoms,
            "link" => "www.site.com",
            "token" => $token->string
        ];

        Mail::to($user->email)->send(new MailToInscription($data));

        return response()->json($response);
    }

    // supposé jscon fait
    public function connectUserOrAdmin(Request $request)
    {
        $requestJson = $request->json()->all();

        $email = $requestJson["email"];
        $password = $requestJson["password"];

        $nsc = User::where('email', $email)->where('password', $password)->count();

        if ($nsc === 1) {

            $person = User::where('email', $email)->where('password', $password)->first();

            $roles = $person->roles;


            $token = Token::create([
                'user_id' => $person->id,
                'string' => \Illuminate\Support\Str::random(60)
            ]);

            if ($roles->contains('nom', 'Participant')) {

                return response()->json([
                    'authentified' => true,
                    'user' => $person,
                    'token' => $token->string,
                    'role' => "Participant"
                ]);
            } elseif ($roles->contains('nom', 'Administrateur')) {
                return response()->json([
                    'authentified' => true,
                    'user' => $person,
                    'token' => $token->string,
                    'role' => "Administrateur"
                ]);
            } else {
                return response()->json([
                    'authentified' => false,
                    'message' => "Vous n'êtes ni l'admin ni un participant"
                ]);
            }
        } else {
            return response()->json([
                'authentified' => false,
                'message' => "Vous n'êtes pas dans la base de donnée"
            ]);
        }
    }
}
