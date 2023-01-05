<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bunglebuild S.L.</title>
    <link rel="stylesheet" href="<?= BASE_URL . "Assets/css/login.css" ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body>
    <br><br><br>
    <form action="index.php?controller=login&action=login" method="POST">
        <div class="d-flex justify-content-center align-items-center mt-5">
            <div class="card">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item text-center">
                        <span class="nav-link active btl" id="pills-home-tab" data-toggle="pill" href="" role="tab" aria-controls="pills-home" aria-selected="true">Login</span>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="form px-4 pt-5">
                            <input type="text" name="usuario" class="form-control" id="usertext" placeholder="Usuario">
                            <input type="password" name="pass" class="form-control" id="passwordtext" placeholder="Contraseña">
                            <br>
                            <input type="submit" class="btn btn-dark btn-block" value="Entrar">
                            <?php echo $error->ErrorFormateado("login"); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html><?php /**PATH C:\Users\david\Desktop\FP\2º DAW (Curso 22-23)\Desarrollo Web en Entorno Servidor\Proyecto1Ev\app\views/login.blade.php ENDPATH**/ ?>