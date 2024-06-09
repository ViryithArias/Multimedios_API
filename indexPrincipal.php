<?php
        include_once '../config/database.php';
            $database = new DatabasesConexion();
            $db = $database->obtenerConexion();
            
?>

<!doctype html>
<html lang="en">

<head>
    <title>API</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />


    </head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">MAV_API</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Insertar
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Cliente</a></li>
                                <li><a class="dropdown-item" href="#">Reserva</a></li>
                                <li><a class="dropdown-item" href="#">Habitación</a></li>
                                <li><a class="dropdown-item" href="#">Estado</a></li>
                                
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Actualizar
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Cliente</a></li>
                                <li><a class="dropdown-item" href="#">Reserva</a></li>
                                <li><a class="dropdown-item" href="#">Habitación</a></li>
                                <li><a class="dropdown-item" href="#">Estado</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Eliminar
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Cliente</a></li>
                                <li><a class="dropdown-item" href="#">Reserva</a></li>
                                <li><a class="dropdown-item" href="#">Habitación</a></li>
                                <li><a class="dropdown-item" href="#">Estado</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Consultar
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/Clientes/index.php">Cliente</a></li>
                                <li><a class="dropdown-item" href="/Reservas/index.php">Reserva</a></li>
                                <li><a class="dropdown-item" href="/Habitaciones/index.php">Habitación</a></li>
                                <li><a class="dropdown-item" href="/Estados/index.php">Estado</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main></main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>