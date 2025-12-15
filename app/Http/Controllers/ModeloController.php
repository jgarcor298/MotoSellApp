<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ModeloController extends Controller
{
    function index() : View {
        $modelos = Modelo::with('marca')->get();
        return view('modelos.index', compact('modelos'));
    }

    function create() : View {
        $marcas = Marca::all();
        return view('modelos.create', compact('marcas'));
    }

    function store(Request $request) : RedirectResponse {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'idmarca' => 'required|exists:marcas,id',
        ]);

        Modelo::create($request->all());

        return redirect()->route('modelos.index')
            ->with('success', 'Modelo creado exitosamente.');
    }

    function show(Modelo $modelo) : View {
        $modelo->load('marca');
        return view('modelos.show', compact('modelo'));
    }

    function edit(Modelo $modelo) : View {
        $marcas = Marca::all();
        return view('modelos.edit', compact('modelo', 'marcas'));
    }

    function update(Request $request, Modelo $modelo) : RedirectResponse {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'idmarca' => 'required|exists:marcas,id',
        ]);

        $modelo->update($request->all());

        return redirect()->route('modelos.index')
            ->with('success', 'Modelo actualizado exitosamente.');
    }

    function destroy(Modelo $modelo) : RedirectResponse {
        $modelo->delete();

        return redirect()->route('modelos.index')
            ->with('success', 'Modelo eliminado exitosamente.');
    }
}