<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MarcaController extends Controller
{
    function index() : View {
        $marcas = Marca::all();
        return view('marcas.index', compact('marcas'));
    }

    function create() : View {
        return view('marcas.create');
    }

    function store(Request $request) : RedirectResponse {
        $request->validate([
            'nombre' => 'required|string|max:50',
        ]);

        Marca::create($request->all());

        return redirect()->route('marcas.index')
            ->with('success', 'Marca creada exitosamente.');
    }

    function show(Marca $marca) : View {
        return view('marcas.show', compact('marca'));
    }

    function edit(Marca $marca) : View {
        return view('marcas.edit', compact('marca'));
    }

    function update(Request $request, Marca $marca) : RedirectResponse {
        $request->validate([
            'nombre' => 'required|string|max:50',
        ]);

        $marca->update($request->all());

        return redirect()->route('marcas.index')
            ->with('success', 'Marca actualizada exitosamente.');
    }

    function destroy(Marca $marca) : RedirectResponse {
        $marca->delete();
        
        return redirect()->route('marcas.index')
            ->with('success', 'Marca eliminada exitosamente.');
    }
}