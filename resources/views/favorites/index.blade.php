@extends('layouts.app')

@section('content')

@if(session('mensajeTexto'))
<div class="container">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('mensajeTexto') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Mis Favoritos</h2>
        <a href="{{ route('motos.index') }}" class="btn btn-outline-primary">
            Volver al Catálogo
        </a>
    </div>

    @if($motos->isEmpty())
        <div class="alert alert-info text-center">
            No tienes motos en tus favoritos. <a href="{{ route('motos.index') }}">¡Explora el catálogo!</a>
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
                        
                        <form action="{{ route('favorites.toggle', $moto) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
