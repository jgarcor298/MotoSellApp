<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(User $user): View
    {
        $motos = $user->motos()->with(['modelo.marca', 'tipo'])->get();
        return view('users.show', compact('user', 'motos'));
    }
}
