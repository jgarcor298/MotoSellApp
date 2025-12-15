@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark text-center fw-bold">Editar Moto</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('motos.update', $moto) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="idmodelo" class="form-label">Modelo</label>
                            <select class="form-select @error('idmodelo') is-invalid @enderror" id="idmodelo" name="idmodelo" required>
                                <option value="" disabled>Selecciona un modelo...</option>
                                @foreach($modelos as $modelo)
                                    <option value="{{ $modelo->id }}" {{ (old('idmodelo') ?? $moto->idmodelo) == $modelo->id ? 'selected' : '' }}>
                                        {{ $modelo->marca->nombre }} - {{ $modelo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idmodelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="year" class="form-label">Año</label>
                                <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year') ?? $moto->year }}" required min="1900" max="{{ date('Y') + 1 }}">
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="cilindrada" class="form-label">Cilindrada</label>
                                <input type="text" class="form-control @error('cilindrada') is-invalid @enderror" id="cilindrada" name="cilindrada" value="{{ old('cilindrada') ?? $moto->cilindrada }}" required maxlength="30">
                                @error('cilindrada')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="idtipo" class="form-label">Tipo</label>
                                <select class="form-select @error('idtipo') is-invalid @enderror" id="idtipo" name="idtipo" required>
                                    <option value="" disabled>Selecciona un tipo...</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ (old('idtipo') ?? $moto->idtipo) == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idtipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="precio" class="form-label">Precio (€)</label>
                                <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio') ?? $moto->precio }}" required min="0">
                                @error('precio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3" required maxlength="100">{{ old('descripcion') ?? $moto->descripcion }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen</label>
                            
                            @if($moto->imagen)
                                <div class="mb-2">
                                    <img src="{{ asset($moto->imagen) }}" alt="Imagen actual" class="img-thumbnail" width="150">
                                    <div class="form-check mt-1">
                                        <input class="form-check-input" type="checkbox" id="deleteImage" name="deleteImage" value="true">
                                        <label class="form-check-label text-danger" for="deleteImage">
                                            Eliminar imagen actual
                                        </label>
                                    </div>
                                </div>
                            @endif

                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning">
                                Actualizar Moto
                            </button>
                            <a href="{{ route('motos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection