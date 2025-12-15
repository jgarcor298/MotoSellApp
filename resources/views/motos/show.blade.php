@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <div class="row g-0">
                    <div class="col-md-6 bg-light d-flex align-items-center justify-content-center p-3">
                        @if($moto->imagen)
                            <img src="{{ asset($moto->imagen) }}" class="img-fluid rounded" alt="{{ $moto->descripcion }}">
                        @else
                            <img src="https://via.placeholder.com/600x400?text=No+Image" class="img-fluid rounded" alt="Sin imagen">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="card-body p-4">
                            <h2 class="card-title fw-bold text-primary mb-3">{{ $moto->modelo->marca->nombre }} {{ $moto->modelo->nombre }}</h2>
                            
                            <h4 class="text-success mb-4">
                                @if($moto->precio)
                                    €{{ number_format($moto->precio, 0, ',', '.') }}
                                @else
                                    Consultar Precio
                                @endif
                            </h4>

                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">Año:</span>
                                    <span>{{ $moto->year }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">Cilindrada:</span>
                                    <span>{{ $moto->cilindrada }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">Tipo:</span>
                                    <span class="badge bg-secondary">{{ $moto->tipo->nombre }}</span>
                                </li>
                            </ul>

                            <div class="mb-4">
                                <h5 class="fw-bold">Descripción</h5>
                                <p class="card-text text-muted">{{ $moto->descripcion }}</p>
                            </div>

                            <div class="d-grid gap-2">
                                @if($moto->user)
                                    <a href="{{ route('users.show', $moto->user) }}" class="btn btn-primary btn-lg">Contactar Vendedor</a>
                                @else
                                    <button class="btn btn-secondary btn-lg" disabled>Vendido por Motos Garre</button>
                                @endif
                                
                                @auth
                                    <form action="{{ route('favorites.toggle', $moto) }}" method="POST" class="d-grid mb-2">
                                        @csrf
                                        <button type="submit" class="btn {{ Auth::user()->favorites->contains($moto->id) ? 'btn-danger' : 'btn-outline-danger' }} btn-lg">
                                            @if(Auth::user()->favorites->contains($moto->id))
                                                <i class="bi bi-heart-fill"></i> Quitar de Favoritos
                                            @else
                                                <i class="bi bi-heart"></i> Añadir a Favoritos
                                            @endif
                                        </button>
                                    </form>
                                @endauth

                                <a href="{{ route('motos.index') }}" class="btn btn-outline-secondary">Volver al Catálogo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection