<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motos Enduro & Trail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            text-align: center;
            max-width: 800px;
        }
        .hero-icon {
            font-size: 80px;
            color: #667eea;
            margin-bottom: 20px;
        }
        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-10px);
        }
        .feature-icon {
            font-size: 50px;
            color: #667eea;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero-card">
            <div class="hero-icon">
                <i class="fas fa-motorcycle"></i>
            </div>
            <h1 class="display-3 fw-bold mb-3">Motos Enduro & Trail</h1>
            <p class="lead mb-4">Sistema de gestión de motos de enduro y trial</p>
            
            <div class="row mt-5">
                <div class="col-md-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-motorcycle"></i>
                        </div>
                        <h5>Motos</h5>
                        <p class="text-muted">Gestiona tu catálogo</p>
                        <a href="{{ route('motos.index') }}" class="btn btn-primary">
                            Ver Motos
                        </a>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-trademark"></i>
                        </div>
                        <h5>Marcas</h5>
                        <p class="text-muted">Administra marcas</p>
                        <a href="{{ route('marcas.index') }}" class="btn btn-primary">
                            Ver Marcas
                        </a>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-list"></i>
                        </div>
                        <h5>Modelos</h5>
                        <p class="text-muted">Gestiona modelos</p>
                        <a href="{{ route('modelos.index') }}" class="btn btn-primary">
                            Ver Modelos
                        </a>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <h5>Tipos</h5>
                        <p class="text-muted">Categorías</p>
                        <a href="{{ route('tipos.index') }}" class="btn btn-primary">
                            Ver Tipos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>