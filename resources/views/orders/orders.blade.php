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
                            <a class="nav-link active" href="{{ route('orders') }}">
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
                    <h3>Ordenes</h2>
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
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($orders as $item)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <th>{{ $item['Customer_name'] }}</th>
                                        <th>{{ $item['Product_name'] }}</th>
                                        <th>{{ $item['quantity'] }}</th>
                                        <td>{{ $item['Fecha de creacion'] }}</td>
                                        <td>{{ $item['Estado'] }}</td>
                                        <td>{{ $item['Total'] }}</td>
                                        <td>
                                            <form id="deleteForm" action="{{ route('deleteO') }}" method="POST"
                                                class=" col-12 d-flex justify-content-around align-items-center">
                                                @csrf
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#ModalEditar{{ $item['Order_id'] }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                        height="20" fill="#0d0d0d" viewBox="0 0 256 256">
                                                        <path
                                                            d="M221.66,90.34,192,120,136,64l29.66-29.66a8,8,0,0,1,11.31,0L221.66,79A8,8,0,0,1,221.66,90.34Z"
                                                            opacity="0.2"></path>
                                                        <path
                                                            d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM51.31,160,136,75.31,152.69,92,68,176.68ZM48,179.31,76.69,208H48Zm48,25.38L79.31,188,164,103.31,180.69,120Zm96-96L147.31,64l24-24L216,84.68Z">
                                                        </path>
                                                    </svg>
                                                </button>

                                                <button type="button" class=" btn btn-danger"
                                                    onclick="confirmDelete()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                        height="20" fill="#0d0d0d" viewBox="0 0 256 256">
                                                        <path d="M200,56V208a8,8,0,0,1-8,8H64a8,8,0,0,1-8-8V56Z"
                                                            opacity="0.2"></path>
                                                        <path
                                                            d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <input name="id" type="text" value="{{ $item['Order_id'] }}"
                                                    class=" d-none">
                                            </form>
                                        </td>
                                        <!-- Modal Editar-->
                                        <form action="{{ route('updateO') }}" method="POST">
                                            @csrf
                                            <div class="modal fade" id="ModalEditar{{ $item['Order_id'] }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                {{ $item['Product_name'] }}</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class=" row d-flex justify-content-center">
                                                                <div class=" col-9">
                                                                    <label for="id"
                                                                        class=" form-label">ID</label>
                                                                    <input type="text" name="id"
                                                                        id=""
                                                                        value="{{ $item['Order_id'] }}"
                                                                        class=" form-control" readonly>
                                                                </div>
                                                                <div class=" col-9">
                                                                    <label for="Customer_name"
                                                                        class=" form-label">Cliente</label>
                                                                    <input type="text" name="Customer_name"
                                                                        id=""
                                                                        value="{{ $item['Customer_name'] }}"
                                                                        class=" form-control">
                                                                </div>
                                                                <div class=" col-9">
                                                                    <label for="Product_name"
                                                                        class=" form-label">Producto</label>
                                                                    <input type="text" name="Product_name"
                                                                        id="" class=" form-control"
                                                                        value="{{ $item['Product_name'] }}" readonly>
                                                                </div>
                                                                <div class=" col-9">
                                                                    <label for="quantity"
                                                                        class=" form-label">Cantidad</label>
                                                                    <input type="text" name="quantity"
                                                                        id="" class=" form-control"
                                                                        value="{{ $item['quantity'] }}">
                                                                </div>
                                                                <div class=" col-9">
                                                                    <label for="Product_name"
                                                                        class=" form-label">Nuevo producto</label>
                                                                    <select name="newProductId" id=""
                                                                        class=" form-select">
                                                                        <option value="{{ $item['product_id'] }}">
                                                                            {{ $item['Product_name'] }}</option>

                                                                        @foreach ($products as $pro)
                                                                            <option value="{{ $pro['id'] }}">
                                                                                {{ $pro['name'] }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                                <div class=" col-9" class=" form-label">
                                                                    <label for="date">Fecha de creacion</label>
                                                                    <input type="text" name="date"
                                                                        id="" class=" form-control"
                                                                        value="{{ $item['Fecha de creacion'] }}"
                                                                        readonly>
                                                                </div>

                                                                <div class=" col-9" class=" form-label">
                                                                    <label for="newDate">Nueva fecha</label>
                                                                    <input type="datetime-local" name="newDate"
                                                                        id="" class=" form-control">
                                                                </div>

                                                                <div class=" col-9" class=" form-label">
                                                                    <label for="Estado">Estado</label>
                                                                    <input type="text" name="Estado"
                                                                        id="" class=" form-control"
                                                                        value="{{ $item['Estado'] }}" readonly>

                                                                </div>
                                                                <div class=" col-9" class=" form-label">
                                                                    <label for="Estado">Nuevo estado</label>
                                                                    <select name="nuevoEstado" id=""
                                                                        class=" form-select">
                                                                        <option value="{{ $item['Estado'] }}">
                                                                            @if ($item['Estado'] == 'pending')
                                                                                Pendiente
                                                                            @endif
                                                                            @if ($item['Estado'] == 'completed')
                                                                                Completado
                                                                            @endif
                                                                            @if ($item['Estado'] == 'canceled')
                                                                                Cancelado
                                                                            @endif
                                                                        </option>
                                                                        <option value="pending">Pendiente</option>
                                                                        <option value="completed">Completado</option>
                                                                        <option value="canceled">Cancelado</option>
                                                                    </select>
                                                                </div>
                                                                <div class=" col-9" class=" form-label">
                                                                    <label for="Total">Total</label>
                                                                    <input type="text" name=" Total"
                                                                        id="" class="form-control"
                                                                        value="{{ $item['Total'] }}">
                                                                </div>

                                                                <div class=" col-9" class=" form-label">
                                                                    <input type="text" name="product_id"
                                                                        id=""
                                                                        value="{{ $item['product_id'] }}"
                                                                        class="d-none">
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

                                        <!-- Modal crear un nuevo producto-->

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
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>

</html>
