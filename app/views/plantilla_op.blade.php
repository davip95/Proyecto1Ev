<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bunglebuild S.L.</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASE_URL . "Assets/css/plantilla.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "Assets/css/inicioVista.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "Assets/css/nuevaTarea.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "Assets/css/verTareas.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "Assets/css/eliminarTarea.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "Assets/css/verTareasBuscadas.css" ?>">
</head>

<body>
    <header class="bg-dark text-center text-white">
        <nav class="navbar navbar-inverse navbar-expand-lg navbar-dark bg-dark">
            <div class="navbar-header">
                <h6 class="navbar-brand">Bunglebuild S.L.</h6>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto botonesCabecera">
                    <li class="nav-item">
                        <a class="btn btn-dark" id="linkhead" href="index.php?controller=tareas&action=opListar" role="button"><i class="bi bi-list-task"></i> Ver Tareas</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark" id="linkhead" href="index.php?controller=tareas&action=opVerPendientes" role="button"><i class="bi bi-clock-history"></i> Tareas Pendientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark" id="linkhead" href="index.php?controller=tareas&action=opBuscar" role="button"><i class="bi bi-search"></i> Buscar Tareas</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <p class="navbar-text">Bienvenido: </p>
                    <li class="botonesCabecera"><a href="" id="logout"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                </ul>
            </div>
        </nav>
    </header>

    @yield('cuerpo')

    <footer class="bg-dark text-center text-white">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: Social media -->
            <section class="mb-4">
                Proyecto PHP
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2022 David Pérez Borrero
        </div>
        <!-- Copyright -->
    </footer>

</body>

</html>