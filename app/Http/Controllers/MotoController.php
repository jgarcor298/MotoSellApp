<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use App\Models\Modelo;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class MotoController extends Controller
{
    function index() : View {
        $motos = Moto::with(['modelo.marca', 'tipo'])->get();
        return view('motos.index', compact('motos'));
    }

    function create() : View {
        $modelos = Modelo::with('marca')->get();
        $tipos = Tipo::all();
        return view('motos.create', compact('modelos', 'tipos'));
    }

    function store(Request $request) : RedirectResponse {
        $rules = [
            'idmodelo'     => 'required|exists:modelos,id',
            'year'         => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'cilindrada'   => 'required|string|max:30',
            'idtipo'       => 'required|exists:tipos,id',
            'descripcion'  => 'required|string|max:100',
            'precio'       => 'required|numeric|min:0',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        $messages = [
            'idmodelo.required'   => 'Debes seleccionar un modelo.',
            'idmodelo.exists'     => 'El modelo seleccionado no existe.',
            'year.required'       => 'El año es obligatorio.',
            'year.integer'        => 'El año debe ser un número entero.',
            'year.min'            => 'El año no puede ser menor a 1900.',
            'year.max'            => 'El año no puede ser mayor al siguiente año.',
            'cilindrada.required' => 'La cilindrada es obligatoria.',
            'cilindrada.string'   => 'La cilindrada debe ser una cadena.',
            'cilindrada.max'      => 'La cilindrada no puede superar 30 caracteres.',
            'idtipo.required'     => 'Debes seleccionar un tipo.',
            'idtipo.exists'       => 'El tipo seleccionado no existe.',
            'descripcion.required'=> 'La descripción es obligatoria.',
            'descripcion.string'  => 'La descripción debe ser una cadena.',
            'descripcion.max'     => 'La descripción no puede superar 100 caracteres.',
            'precio.required'     => 'El precio es obligatorio.',
            'precio.numeric'      => 'El precio debe ser un número.',
            'precio.min'          => 'El precio no puede ser negativo.',
            'image.image'         => 'El archivo debe ser una imagen.',
            'image.mimes'         => 'La imagen debe ser JPG, JPEG, PNG o WEBP.',
            'image.max'           => 'La imagen no puede pesar más de 2 MB.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $moto = new Moto($request->except(['image']));
        $moto->user_id = Auth::id();
        $result = false;

        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $nombre = 'moto_' . time() . '.' . $file->getClientOriginalExtension();
                // Guardamos en storage/app/public/motos
                $ruta = $file->storeAs('motos', $nombre, 'public');
                $moto->imagen = 'storage/' . $ruta;
            }
            
            $result = $moto->save();

            $txtmessage = 'La moto ha sido creada exitosamente.';

        } catch(\Illuminate\Database\UniqueConstraintViolationException $e) {
            $txtmessage = 'Violación de clave única.';
        } catch(\Illuminate\Database\QueryException $e) {
            $txtmessage = 'Error de base de datos o campo null.';
        } catch(\Exception $e) {
            $txtmessage = 'Ocurrió un error inesperado.';
        }

        $message = ['mensajeTexto' => $txtmessage];

        if($result) {
            return redirect()->route('motos.index')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }

    function show(Moto $moto) : View {
        return view('motos.show', compact('moto'));
    }

    function edit(Moto $moto) : View
    {
        if (Auth::user()->role !== 'admin' && $moto->user_id !== Auth::id()) {
            abort(403);
        }

        $modelos = Modelo::with('marca')->get();
        $tipos = Tipo::all();
        return view('motos.edit', compact('moto', 'modelos', 'tipos'));
    }

    function update(Request $request, Moto $moto) : RedirectResponse {
        if (Auth::user()->role !== 'admin' && $moto->user_id !== Auth::id()) {
            abort(403);
        }

        $rules = [
            'idmodelo'     => 'required|exists:modelos,id',
            'year'         => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'cilindrada'   => 'required|string|max:30',
            'idtipo'       => 'required|exists:tipos,id',
            'descripcion'  => 'required|string|max:100',
            'precio'       => 'required|numeric|min:0',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        $messages = [
            'idmodelo.required'   => 'Debes seleccionar un modelo.',
            'idmodelo.exists'     => 'El modelo seleccionado no existe.',
            'year.required'       => 'El año es obligatorio.',
            'year.integer'        => 'El año debe ser un número entero.',
            'year.min'            => 'El año no puede ser menor a 1900.',
            'year.max'            => 'El año no puede ser mayor al siguiente año.',
            'cilindrada.required' => 'La cilindrada es obligatoria.',
            'cilindrada.string'   => 'La cilindrada debe ser una cadena.',
            'cilindrada.max'      => 'La cilindrada no puede superar 30 caracteres.',
            'idtipo.required'     => 'Debes seleccionar un tipo.',
            'idtipo.exists'       => 'El tipo seleccionado no existe.',
            'descripcion.required'=> 'La descripción es obligatoria.',
            'descripcion.string'  => 'La descripción debe ser una cadena.',
            'descripcion.max'     => 'La descripción no puede superar 100 caracteres.',
            'precio.required'     => 'El precio es obligatorio.',
            'precio.numeric'      => 'El precio debe ser un número.',
            'precio.min'          => 'El precio no puede ser negativo.',
            'image.image'         => 'El archivo debe ser una imagen.',
            'image.mimes'         => 'La imagen debe ser JPG, JPEG, PNG o WEBP.',
            'image.max'           => 'La imagen no puede pesar más de 2 MB.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $result = false;

        if ($request->deleteImage == 'true') {
            if ($moto->imagen && file_exists(public_path($moto->imagen))) {
                unlink(public_path($moto->imagen));
            }
            $moto->imagen = null;
        }

        $moto->fill($request->except(['image']));

        try {
            if ($request->hasFile('image')) {
                if ($moto->imagen && file_exists(public_path($moto->imagen))) {
                    unlink(public_path($moto->imagen));
                }

                $file = $request->file('image');
                $nombre = 'moto_' . $moto->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                // Guardamos en storage/app/public/motos
                $ruta = $file->storeAs('motos', $nombre, 'public');
                $moto->imagen = 'storage/' . $ruta;
            }

            $result = $moto->save();
            $txtmessage = 'La moto ha sido actualizada exitosamente.';

        } catch(\Illuminate\Database\UniqueConstraintViolationException $e) {
            $txtmessage = 'Violación de clave única.';
        } catch(\Illuminate\Database\QueryException $e) {
            $txtmessage = 'Error de base de datos o campo null.';
        } catch(\Exception $e) {
            $txtmessage = 'Ocurrió un error inesperado.';
        }

        $message = ['mensajeTexto' => $txtmessage];

        if($result) {
            return redirect()->route('motos.index')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }

    function destroy(Moto $moto) : RedirectResponse {
        if (Auth::user()->role !== 'admin' && $moto->user_id !== Auth::id()) {
             abort(403);
        }

        $moto->delete();

        return redirect()->route('motos.index')
            ->with('success', 'Moto eliminada exitosamente.');
    }
}