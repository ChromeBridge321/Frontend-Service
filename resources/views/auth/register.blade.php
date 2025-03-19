<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Register</title>
</head>
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>
</head>

<body class="bg-light">
    @if ($error == 3)
        <div class="alert bg-success-subtle col-12 d-flex justify-content-center">
            <p>Usuario creado correctamente!</p>
        </div>
    @endif

    @if ($error == 1)
        <div class="alert bg-danger-subtle col-12 d-flex justify-content-center">
            <p>Las contraseñas no coinciden</p>
        </div>
    @endif

    @if ($error == 2)
        <div class="alert bg-danger-subtle col-12 d-flex justify-content-center">
            <p>La contraseña debe tener como mínimo 8 caracteres</p>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Crear una cuenta</h2>
                        <form class="row g-3" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="col-md-12">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" required name="name">
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email"
                                    placeholder="nombre@ejemplo.com" required name="email">
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password"
                                        placeholder="Mínimo 8 caracteres" required name="password">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>
                                <div class="form-text">
                                    La contraseña debe tener al menos 8 caracteres, incluir mayúsculas, minúsculas y
                                    números
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="confirmarPassword" class="form-label">Confirmar Contraseña</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirmarPassword" required
                                        name="confirmPassword">
                                    <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Registrarse</button>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <p>¿Ya tienes una cuenta? <a href="{{ url('/login') }}"
                                        class="text-decoration-none">Inicia sesión</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para alternar la visibilidad de la contraseña
        function togglePasswordVisibility(inputId, buttonId) {
            const toggleButton = document.getElementById(buttonId);
            toggleButton.addEventListener('click', function() {
                const input = document.getElementById(inputId);
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        }

        // Inicializar los botones de mostrar/ocultar contraseña
        togglePasswordVisibility('password', 'togglePassword');
        togglePasswordVisibility('confirmarPassword', 'toggleConfirmPassword');
    </script>
</body>

</html>

</html>
