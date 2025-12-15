@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Gestión de Modelos</span>
                    <a href="{{ route('modelos.create') }}" class="btn btn-light btn-sm fw-bold text-primary">
                        + Nuevo Modelo
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($modelos->isEmpty())
                        <div class="alert alert-info text-center mb-0">
                            No hay modelos registrados.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($modelos as $modelo)
                                    <tr>
                                        <td>{{ $modelo->id }}</td>
                                        <td><span class="badge bg-secondary">{{ $modelo->marca->nombre }}</span></td>
                                        <td class="fw-bold">{{ $modelo->nombre }}</td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('modelos.edit', $modelo) }}" class="btn btn-outline-warning btn-sm" title="Editar">
                                                    ✏️
                                                </a>
                                                <form action="{{ route('modelos.destroy', $modelo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este modelo?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar">
                                                        🗑️
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection