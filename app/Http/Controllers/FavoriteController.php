<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the user's favorite motos.
     */
    public function index()
    {
        // Load the relationship to avoid N+1 issues and get the motos
        $user = Auth::user();
        
        // We can get the relationship. 
        // If we want to reuse the same view 'motos.index' or 'favorites.index'
        $motos = $user->favorites()->with(['modelo.marca', 'tipo'])->get();

        return view('favorites.index', compact('motos'));
    }

    /**
     * Toggle the favorite status of a moto for the authenticated user.
     */
    public function toggle(Moto $moto)
    {
        Auth::user()->favorites()->toggle($moto);

        return back()->with('mensajeTexto', 'Favoritos actualizados.');
    }
}
