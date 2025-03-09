<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        .profile-header {
            background-color: #f8f9fa;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid #dee2e6;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .profile-stats {
            padding: 1rem;
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .nav-pills .nav-link.active {
            background-color: #0d6efd;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Header/Navbar igual que en el ejemplo anterior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <div class="d-flex">
                <a class="nav-link text-white" href="#"><i class="fas fa-user"></i> Perfil</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar igual que en el ejemplo anterior -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-user"></i>
                                Perfil
                            </a>
                        </li>
                        <!-- Otros items del menú... -->
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Profile Header -->
                <div class="profile-header text-center text-md-start">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-auto text-center mb-3 mb-md-0">
                                <img src="/api/placeholder/150/150" alt="Profile" class="profile-image">
                            </div>
                            <div class="col-md">
                                <h2 class="mb-1">Juan Pérez</h2>
                                <p class="text-muted mb-2">@juanperez</p>
                                <button class="btn btn-primary me-2">
                                    <i class="fas fa-edit"></i> Editar Perfil
                                </button>
                                <button class="btn btn-outline-secondary">
                                    <i class="fas fa-cog"></i> Configuración
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Content -->
                <div class="container">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-lg-4 mb-4">
                            <!-- Personal Information -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Información Personal</h5>
                                </div>
                                <div class="card-body">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-4">Nombre:</dt>
                                        <dd class="col-sm-8">Juan Pérez</dd>

                                        <dt class="col-sm-4">Email:</dt>
                                        <dd class="col-sm-8">juan.perez@ejemplo.com</dd>

                                        <dt class="col-sm-4">Teléfono:</dt>
                                        <dd class="col-sm-8">+1 234 567 890</dd>

                                        <dt class="col-sm-4">Ubicación:</dt>
                                        <dd class="col-sm-8">Ciudad de México</dd>

                                        <dt class="col-sm-4">Miembro desde:</dt>
                                        <dd class="col-sm-8">Enero 2023</dd>
                                    </dl>
                                </div>
                            </div>

                            <!-- Skills -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Habilidades</h5>
                                </div>
                                <div class="card-body">
                                    <span class="badge bg-primary me-1 mb-1">HTML</span>
                                    <span class="badge bg-primary me-1 mb-1">CSS</span>
                                    <span class="badge bg-primary me-1 mb-1">JavaScript</span>
                                    <span class="badge bg-primary me-1 mb-1">React</span>
                                    <span class="badge bg-primary me-1 mb-1">Node.js</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-8">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#overview">General</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#projects">Proyectos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#activity">Actividad</a>
                                </li>
                            </ul>

                            <!-- Tab content -->
                            <div class="tab-content">
                                <!-- Overview Tab -->
                                <div class="tab-pane fade show active" id="overview">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="card h-100">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Estadísticas</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="flex-shrink-0">
                                                            <i class="fas fa-project-diagram fa-2x text-primary"></i>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-0">Proyectos Completados</h6>
                                                            <h4 class="mb-0">15</h4>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class="fas fa-tasks fa-2x text-success"></i>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-0">Tareas Completadas</h6>
                                                            <h4 class="mb-0">248</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="card h-100">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Biografía</h5>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        Desarrollador Full Stack con más de 5 años de experiencia en desarrollo web.
                                                        Apasionado por crear soluciones innovadoras y mantenerme actualizado con las
                                                        últimas tecnologías.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Projects Tab -->
                                <div class="tab-pane fade" id="projects">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Proyectos Recientes</h5>
                                        </div>
                                        <div class="list-group list-group-flush">
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1">E-commerce Platform</h6>
                                                    <small class="text-muted">3 días atrás</small>
                                                </div>
                                                <p class="mb-1">Plataforma de comercio electrónico con React y Node.js</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1">CRM System</h6>
                                                    <small class="text-muted">1 semana atrás</small>
                                                </div>
                                                <p class="mb-1">Sistema de gestión de relaciones con clientes</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Activity Tab -->
                                <div class="tab-pane fade" id="activity">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Actividad Reciente</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="timeline">
                                                <div class="mb-3">
                                                    <small class="text-muted">Hoy</small>
                                                    <div class="card mt-2">
                                                        <div class="card-body">
                                                            <p class="mb-0">Completó el proyecto "E-commerce Platform"</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <small class="text-muted">Ayer</small>
                                                    <div class="card mt-2">
                                                        <div class="card-body">
                                                            <p class="mb-0">Actualizó su foto de perfil</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>