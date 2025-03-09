<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard index</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
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
                <div class="pt-3">
                    <h3>Ordenes Vacias</h2>
                </div>
                @if ($error == 1)
                    <div class="alert bg-success-subtle col-12 d-flex justify-content-center">
                        <p>Orden eliminado con éxito</p>
                    </div>
                @endif

                @if ($error == 2)
                    <div class="alert bg-danger-subtle col-12 d-flex justify-content-center">
                        <p>A ocurrido un error al procesar la solicitud</p>
                    </div>
                @endif

                @if ($error == 3)
                    <div class="alert bg-success-subtle col-12 d-flex justify-content-center">
                        <p>Orden guardada con éxito</p>
                    </div>
                @endif
                <div class="row d-flex justify-content-center ">

                    <div class=" col-10 d-flex justify-content-end align-items-center mb-3">
                        <button class=" btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ModalAgregar">
                            Agregar producto
                        </button>

                        
                        <form action="{{ route('storeO') }}" method="POST">
                            @csrf
                            <div class="modal fade" id="ModalAgregar" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Crear
                                                nueva orden</h1>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class=" row d-flex justify-content-center">
                                                <div class=" col-9" class=" form-label">
                                                    <label for="" class=" form-label">Nombre
                                                        del cliente</label>
                                                    <input type="text" name="customer_name"
                                                        id=""class=" form-control">
                                                </div>

                                                <div class=" col-9" class=" form-label">
                                                    <label for=""
                                                        class=" form-label">Producto</label>
                                                    <select name="product_id" id=""
                                                        class=" form-select">
                                                        @foreach ($products as $pro)
                                                            <option value="{{ $pro['id'] }}">
                                                                {{ $pro['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class=" col-9" class=" form-label">
                                                    <label for=""
                                                        class=" form-label">Cantidad</label>
                                                    <input type="number" name="quantity"
                                                        id=""class=" form-control">
                                                </div>

                                                <div class=" col-9" class=" form-label">
                                                    <label for="number" class=" form-label">Total
                                                        $</label>
                                                    <input type="text" name="total_price"
                                                        id=""class=" form-control">
                                                </div>

                                                <div class=" col-9" class=" form-label">
                                                    <label for="" class=" form-label">Estado de la orden</label>
                                                    <select name="status" id="" class=" form-select">
                                                        <option value="pending">Pendiente</option>
                                                        <option value="completed">Completado</option>
                                                        <option value="canceled">Cancelado</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit"
                                                class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class=" col-10">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class=" table-dark">
                                <tr>
                                    <th scope="col">Num</th>
                                    <th scope="col">Clientes</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Fecha de pedido aa/dd/mm hh:mm</th>
                                    <th scope="col">Estado del pedido</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Accion</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>

</html>
