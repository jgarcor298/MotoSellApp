@extends('app.bootstrap.template')

@section('title', 'Ver Tipo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h3 class="mb-0"><i class="fas fa-tags"></i> Detalles del Tipo</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">ID:</th>
                        <td>{{ $tipo->id }}</td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td><strong>{{ $tipo->nombre }}</strong></td>
                    </tr>
                    <tr>
                        <th>Fecha de Creación:</th>
                        <td>{{ $tipo->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th>Última Actualización:</th>
                        <td>{{ $tipo->updated_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('tipos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <div>
                        <a href="{{ route('tipos.edit', $tipo) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('tipos.destroy', $tipo) }}" method="POST" class="d-inline">
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
</div>
@endsection