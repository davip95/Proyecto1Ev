<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/css/inicioVista.css">
</head>

<body>
    <header>
        <h1>Bunglebuild S.L.</h1>
        <h3>Gestor de Incidencias/Tareas</h3>
    </header>
    <section>
        <div>
            <a href="../index.php?controller=tareas&action=listar" class="btn btn-primary" role="button">Ver Incidencias/Tareas</a>
            <br><br>
            <a href="../index.php?controller=tareas&action=crear" class="btn btn-primary" role="button">Añadir Incidencia/Tarea</a>
            <br><br>
            <a href="../index.php?controller=tareas&action=modificar" class="btn btn-primary" role="button">Modificar Incidencia/Tarea</a>
            <br><br>
            <a href="../index.php?controller=tareas&action=eliminar" class="btn btn-primary" role="button">Eliminar Incidencia/Tarea</a>
            <br><br>
            <a href="../index.php?controller=tareas&action=cambiar" class="btn btn-primary" role="button">Cambiar Estado Incidencia/Tarea</a>
            <br><br>
            <a href="../index.php?controller=tareas&action=completar" class="btn btn-primary" role="button">Completar Incidencia/Tarea</a>
            <br><br>
            <a href="../index.php?controller=tareas&action=buscar" class="btn btn-primary" role="button">Buscar Incidencia/Tarea</a>
        </div>
        <aside>
            <!-- aqui enlaces a inicio, etc -->
        </aside>
    </section>
    <footer>
        <span>Pie de página</span>
    </footer>
</body>

</html>