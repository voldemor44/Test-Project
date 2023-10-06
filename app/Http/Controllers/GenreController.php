<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function create_genre(Request $request)
    {
        $genre = Genre::create([
            'nom' => $request->genre
        ]);
    }
}
