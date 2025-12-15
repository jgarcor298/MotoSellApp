@extends('layouts.app')

@section('title', 'Ver Modelo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h3 class="mb-0"><i class="fas fa-list"></i> Detalles del Modelo</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">ID:</th>
                        <td>{{ $modelo->id }}</td>
                    </tr>
                    <tr>
                        <th>Marca:</th>
                        <td><span class="badge bg-secondary">{{ $modelo->marca->nombre }}</span></td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td><strong>{{ $modelo->nombre }}</strong></td>
                    </tr>
                    <tr>
                        <th>Fecha de Creación:</th>
                        <td>{{ $modelo->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th>Última Actualización:</th>
                        <td>{{ $modelo->updated_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('modelos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <div>
                        <a href="{{ route('modelos.edit', $modelo) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('modelos.destroy', $modelo) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection