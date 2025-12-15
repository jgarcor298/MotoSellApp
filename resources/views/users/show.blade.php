@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <h2 class="card-title fw-bold">Perfil del Vendedor</h2>
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=128" class="rounded-circle mb-3 mb-md-0" alt="{{ $user->name }}">
                </div>
                <div class="col-md-10">
                    <h3 class="mb-1">{{ $user->name }}</h3>
                    <p class="text-muted mb-0"><i class="bi bi-envelope"></i> {{ $user->email }}</p>
                    <p class="text-muted mt-2">Motos en venta: <strong>{{ $motos->count() }}</strong></p>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mb-4">Motos en Venta</h3>

    @if($motos->isEmpty())
        <div class="alert alert-info text-center">
            Este usuario no tiene motos en venta actualmente.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($motos as $moto)
            <div class="col">
                <div class="card h-100 card-moto shadow-sm border-0">
                    <div class="moto-image-container measure-image position-relative">
                        @if($moto->imagen)
                            <img src="{{ asset($moto->imagen) }}" class="card-img-top" alt="{{ $moto->descripcion }}">
                        @else
                            <img src="https://via.placeholder.com/400x300?text=No+Image" class="card-img-top" alt="Sin imagen">
                        @endif
                        <span class="position-absolute top-0 end-0 badge bg-warning text-dark m-2 fs-6">
                            {{ $moto->year }}
                        </span>
                    </div>
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                             <h5 class="card-title fw-bold text-primary">{{ $moto->modelo->marca->nombre }} {{ $moto->modelo->nombre }}</h5>
                             <span class="badge bg-secondary">{{ $moto->tipo->nombre }}</span>
                        </div>
                        
                        <p class="card-text text-muted small">{{ $moto->descripcion }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="h5 mb-0 text-success fw-bold">
                                @if($moto->precio)
                                    €{{ number_format($moto->precio, 0, ',', '.') }}
                                @else
                                    Consultar
                                @endif
                            </span>
                            <span class="text-muted small">{{ $moto->cilindrada }}</span>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white border-top-0 d-flex gap-2">
                        <a href="{{ route('motos.show', $moto) }}" class="btn btn-outline-primary flex-grow-1">Ver Detalles</a>
                        
                        @auth
                            @if(Auth::user()->isAdmin() || Auth::id() === $moto->user_id)
                                <a href="{{ route('motos.edit', $moto) }}" class="btn btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('motos.destroy', $moto) }}" method="POST" onsubmit="return confirm('¿Estás seguro de querer eliminar esta moto?');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('favorites.toggle', $moto) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn {{ Auth::user()->favorites->contains($moto->id) ? 'btn-danger' : 'btn-outline-danger' }}">
                                    @if(Auth::user()->favorites->contains($moto->id))
                                        <i class="bi bi-heart-fill"></i>
                                    @else
                                        <i class="bi bi-heart"></i>
                                    @endif
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
