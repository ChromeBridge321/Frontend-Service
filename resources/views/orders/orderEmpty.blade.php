<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard index</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .sidebar {
            min-height: 100vh;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background-color: #f8f9fa;
        }

        .sidebar .nav-link {
            color: #333;
            padding: 0.75rem 1.25rem;
        }

        .sidebar .nav-link:hover {
            color: #0d6efd;
            background-color: #e9ecef;
        }

        .sidebar .nav-link.active {
            color: #0d6efd;
            background-color: #e9ecef;
        }

        .sidebar .nav-link i {
            margin-right: 0.5rem;
            width: 1.25rem;
        }

        .main-content {
            min-height: calc(100vh - 56px);
        }

        @media (max-width: 767.98px) {
            .sidebar {
                min-height: auto;
            }
        }
    </style>

    <script>
        function confirmDelete() {
            const confirmation = confirm("¿Seguro que desea eliminar el registro?");
            if (confirmation) {
                document.getElementById("deleteForm").submit();
            }
        }
    </script>
</head>

<body>
    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <div class="container-fluid">
            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand fw-bold" href="#">Menu DashBoard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"><i class="fas fa-user"></i> Perfil</a>
                        </li>
                        <li class="nav-item">
                            <button class=" btn btn-outline-dark text-white">
                                <i class="fas fa-sign-out-alt"></i>
                                Salir
                            </button>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block collapse sidebar">
                <div class="pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('index') }}">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#000000"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M240,208H224V136l2.34,2.34A8,8,0,0,0,237.66,127L139.31,28.68a16,16,0,0,0-22.62,0L18.34,127a8,8,0,0,0,11.32,11.31L32,136v72H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16Zm-88,0H104V160a4,4,0,0,1,4-4h40a4,4,0,0,1,4,4Z">
                                        </path>
                                    </svg>
                                </i>
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products') }}">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#000000"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M223.68,66.15,135.68,18a15.88,15.88,0,0,0-15.36,0l-88,48.17a16,16,0,0,0-8.32,14v95.64a16,16,0,0,0,8.32,14l88,48.17a15.88,15.88,0,0,0,15.36,0l88-48.17a16,16,0,0,0,8.32-14V80.18A16,16,0,0,0,223.68,66.15ZM128,32l80.35,44L178.57,92.29l-80.35-44Zm0,88L47.65,76,81.56,57.43l80.35,44Zm88,55.85h0l-80,43.79V133.83l32-17.51V152a8,8,0,0,0,16,0V107.56l32-17.51v85.76Z">
                                        </path>
                                    </svg>
                                </i>
                                Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#000000"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M200,32H163.74a47.92,47.92,0,0,0-71.48,0H56A16,16,0,0,0,40,48V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V48A16,16,0,0,0,200,32Zm-72,0a32,32,0,0,1,32,32H96A32,32,0,0,1,128,32Zm32,128H96a8,8,0,0,1,0-16h64a8,8,0,0,1,0,16Zm0-32H96a8,8,0,0,1,0-16h64a8,8,0,0,1,0,16Z">
                                        </path>
                                    </svg>
                                </i>
                                Ordenes
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="pt-3 row text-center">
                    <h3>Ordenes Vacias</h2>
                </div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class=" col-6 d-flex justify-content-center align-items-center">
                        <h6 class=" fst-italic text-secondary text-center"> No tienes ningun producto guardado. Empieza agregando uno -> <a href="{{ route('products') }}">agregar producto</a></h6>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>

</html>
