<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Ordenes</title>
    <!-- Bootstrap 5.3 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    :root {
        --primary-color: #6a11cb;
        --secondary-color: #2575fc;
    }

    body {
        background-color: #f4f6f9;
    }

    .sidebar {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        min-height: 100vh;
        color: white;
    }

    .sidebar .nav-link {
        color: rgba(255,255,255,0.8);
        transition: all 0.3s ease;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        color: white;
        background-color: rgba(255,255,255,0.1);
    }

    .sidebar .nav-link i {
        margin-right: 10px;
    }

    .card-header {
        background-color: #f1f3f5;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.05);
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        padding: 0;
    }

    .modal-header {
        background-color: #f1f3f5;
        border-bottom: 1px solid #e9ecef;
    }

    @media (max-width: 768px) {
        .sidebar {
            min-height: auto;
        }
    }
</style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                <i class="bi bi-grid-3x3-gap-fill me-2"></i> Dashboard
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-person-circle me-1"></i> Perfil</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">
                                <i class="bi bi-box-arrow-right me-1"></i> Salir
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="pt-4 pb-2">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('index') }}">
                                <i class="bi bi-house-fill"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products') }}">
                                <i class="bi bi-box-seam-fill"></i> Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('orders') }}">
                                <i class="bi bi-receipt-cutoff"></i> Ordenes
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
    
            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0"><i class="bi bi-receipt-cutoff me-2"></i>Gestión de Ordenes</h4>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAgregar">
                                    <i class="bi bi-plus-lg me-1"></i> Agregar Orden
                                </button>
                            </div>
                            <div class="card-body">
                                @if ($error == 1)
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="bi bi-check-circle-fill me-2"></i> Orden eliminada con éxito
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif
    
                                @if ($error == 2)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Ha ocurrido un error al procesar la solicitud
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif
    
                                @if ($error == 3)
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="bi bi-check-circle-fill me-2"></i> Orden guardada con éxito
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif
    
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Num</th>
                                                <th>Clientes</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Fecha de pedido</th>
                                                <th>Estado del pedido</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1; @endphp
                                            @foreach ($orders as $item)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $item['Customer_name'] }}</td>
                                                    <td>{{ $item['Product_name'] }}</td>
                                                    <td>{{ $item['quantity'] }}</td>
                                                    <td>{{ $item['Fecha de creacion'] }}</td>
                                                    <td>
                                                        @if ($item['Estado'] == 'pending')
                                                            <span class="badge bg-warning">Pendiente</span>
                                                        @elseif ($item['Estado'] == 'completed')
                                                            <span class="badge bg-success">Completado</span>
                                                        @elseif ($item['Estado'] == 'canceled')
                                                            <span class="badge bg-danger">Cancelado</span>
                                                        @endif
                                                    </td>
                                                    <td>${{ number_format($item['Total'], 2) }}</td>
                                                    <td>
                                                        <form id="deleteForm" action="{{ route('deleteO') }}" method="POST" class="d-flex gap-2">
                                                            @csrf
                                                            <button type="button" class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#ModalEditar{{ $item['Order_id'] }}">
                                                                <i class="bi bi-pencil"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm btn-action" onclick="confirmDelete()">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                            <input name="id" type="text" value="{{ $item['Order_id'] }}" class="d-none">
                                                        </form>
                                                    </td>
                                                    
                                                    <!-- Modal Editar-->
                                                    <form action="{{ route('updateO') }}" method="POST">
                                                        @csrf
                                                        <div class="modal fade" id="ModalEditar{{ $item['Order_id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                            <i class="bi bi-pencil-square me-2"></i>{{ $item['Product_name'] }}
                                                                        </h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row d-flex justify-content-center">
                                                                            <div class="col-9 mb-3">
                                                                                <label for="id" class="form-label">ID</label>
                                                                                <input type="text" name="id" value="{{ $item['Order_id'] }}" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="col-9 mb-3">
                                                                                <label for="Customer_name" class="form-label">Cliente</label>
                                                                                <input type="text" name="Customer_name" value="{{ $item['Customer_name'] }}" class="form-control">
                                                                            </div>
                                                                            <div class="col-9 mb-3">
                                                                                <label for="Product_name" class="form-label">Producto</label>
                                                                                <select name="newProductId" class="form-select">
                                                                                    <option value="{{ $item['product_id'] }}">{{ $item['Product_name'] }}</option>
                                                                                    @foreach ($products as $pro)
                                                                                        <option value="{{ $pro['id'] }}">{{ $pro['name'] }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-9 mb-3">
                                                                                <label for="quantity" class="form-label">Cantidad</label>
                                                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" class="form-control">
                                                                            </div>
                                                                            <div class="col-9 mb-3">
                                                                                <label for="date" class="form-label">Fecha de creación</label>
                                                                                <input type="text" name="date" value="{{ $item['Fecha de creacion'] }}" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="col-9 mb-3">
                                                                                <label for="newDate" class="form-label">Nueva fecha</label>
                                                                                <input type="datetime-local" name="newDate" class="form-control">
                                                                            </div>
                                                                            <div class="col-9 mb-3">
                                                                                <label for="Estado" class="form-label">Estado</label>
                                                                                <select name="nuevoEstado" class="form-select">
                                                                                    <option value="{{ $item['Estado'] }}">
                                                                                        @if ($item['Estado'] == 'pending') Pendiente
                                                                                        @elseif ($item['Estado'] == 'completed') Completado
                                                                                        @elseif ($item['Estado'] == 'canceled') Cancelado
                                                                                        @endif
                                                                                    </option>
                                                                                    <option value="pending">Pendiente</option>
                                                                                    <option value="completed">Completado</option>
                                                                                    <option value="canceled">Cancelado</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-9 mb-3">
                                                                                <label for="Total" class="form-label">Total</label>
                                                                                <input type="number" name="Total" value="{{ $item['Total'] }}" class="form-control">
                                                                            </div>
                                                                            <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </tr>
                                                @php $i++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Modal crear un nuevo producto-->
                <form action="{{ route('storeO') }}" method="POST">
                    @csrf
                    <div class="modal fade" id="ModalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        <i class="bi bi-plus-circle me-2"></i>Crear nueva orden
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-9 mb-3">
                                            <label for="customer_name" class="form-label">Nombre del cliente</label>
                                            <input type="text" name="customer_name" class="form-control">
                                        </div>
                                        <div class="col-9 mb-3">
                                            <label for="product_id" class="form-label">Producto</label>
                                            <select name="product_id" class="form-select">
                                                @foreach ($products as $pro)
                                                    <option value="{{ $pro['id'] }}">{{ $pro['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-9 mb-3">
                                            <label for="quantity" class="form-label">Cantidad</label>
                                            <input type="number" name="quantity" class="form-control">
                                        </div>
                                        <div class="col-9 mb-3">
                                            <label for="total_price" class="form-label">Total $</label>
                                            <input type="number" name="total_price" class="form-control">
                                        </div>
                                        <div class="col-9 mb-3">
                                            <label for="status" class="form-label">Estado de la orden</label>
                                            <select name="status" class="form-select">
                                                <option value="pending">Pendiente</option>
                                                <option value="completed">Completado</option>
                                                <option value="canceled">Cancelado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function confirmDelete() {
            const confirmation = confirm("¿Seguro que desea eliminar el registro?");
            if (confirmation) {
                document.getElementById("deleteForm").submit();
            }
        }
    </script>
    </body>
    </html>