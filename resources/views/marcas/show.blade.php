@extends('app.bootstrap.template')

@section('title', 'Ver Marca')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h3 class="mb-0"><i class="fas fa-trademark"></i> Detalles de la Marca</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">ID:</th>
                        <td>{{ $marca->id }}</td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td><strong>{{ $marca->nombre }}</strong></td>
                    </tr>
                    <tr>
                        <th>Fecha de Creación:</th>
                        <td>{{ $marca->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th>Última Actualización:</th>
                        <td>{{ $marca->updated_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('marcas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <div>
                        <a href="{{ route('marcas.edit', $marca) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('marcas.destroy', $marca) }}" method="POST" class="d-inline">
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