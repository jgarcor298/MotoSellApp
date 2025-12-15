@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white fw-bold">Nuevo Modelo</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('modelos.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="idmarca" class="form-label">Marca</label>
                            <select class="form-select @error('idmarca') is-invalid @enderror" id="idmarca" name="idmarca" required autofocus>
                                <option value="" selected disabled>Selecciona una marca...</option>
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca->id }}" {{ old('idmarca') == $marca->id ? 'selected' : '' }}>
                                        {{ $marca->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idmarca')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Modelo</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required maxlength="50">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                Guardar Modelo
                            </button>
                            <a href="{{ route('modelos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection