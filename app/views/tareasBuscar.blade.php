@extends('plantilla_admin')
@section('cuerpo')
<h1>Buscador de tareas</h1>
<div class="formulario">
    <form enctype="multipart/form-data" method="POST">
        <div class="padrecolumnas">
            <div class="columnacampos">
                <h3>Campo</h3>
                <select class="form-select form-select-lg" name="campo1">
                    <option disabled selected>Selecciona campo</option>
                    <option value="idtarea">ID de Tarea</option>
                    <option value="idusuario">ID de Usuario</option>
                    <option value="codpostal">Código Postal</option>
                </select>
                <br>
                <select class="form-select form-select-lg" name="campo2">
                    <option disabled selected>Selecciona campo</option>
                    <option value="idtarea">ID de Tarea</option>
                    <option value="idusuario">ID de Usuario</option>
                    <option value="codpostal">Código Postal</option>
                </select>
                <br>
                <select class="form-select form-select-lg" name="campo3">
                    <option disabled selected>Selecciona campo</option>
                    <option value="idtarea">ID de Tarea</option>
                    <option value="idusuario">ID de Usuario</option>
                    <option value="codpostal">Código Postal</option>
                </select>
                <br>
                {!!$error->ErrorFormateado('campo')!!}
            </div>
            <div class="columnacampos">
                <h3>Criterio</h3>
                <select class="form-select form-select-lg" name="criterio1">
                    <option disabled selected>Selecciona criterio</option>
                    <option value="=" <?= isset($_POST['criterio1']) && $_POST['criterio1'] == "=" ? 'selected' : '' ?>>=</option>
                    <option value=">" <?= isset($_POST['criterio1']) && $_POST['criterio1'] == ">" ? 'selected' : '' ?>>&gt;</option>
                    <option value="<" <?= isset($_POST['criterio1']) && $_POST['criterio1'] == "<" ? 'selected' : '' ?>>&lt;</option>
                </select>
                <br>
                <select class="form-select form-select-lg" name="criterio2">
                    <option disabled selected>Selecciona criterio</option>
                    <option value="=" <?= isset($_POST['criterio2']) && $_POST['criterio2'] == "=" ? 'selected' : '' ?>>=</option>
                    <option value=">" <?= isset($_POST['criterio2']) && $_POST['criterio2'] == ">" ? 'selected' : '' ?>>&gt;</option>
                    <option value="<" <?= isset($_POST['criterio2']) && $_POST['criterio2'] == "<" ? 'selected' : '' ?>>&lt;</option>
                </select>
                <br>
                <select class="form-select form-select-lg" name="criterio3">
                    <option disabled selected>Selecciona criterio</option>
                    <option value="=" <?= isset($_POST['criterio3']) && $_POST['criterio3'] == "=" ? 'selected' : '' ?>>=</option>
                    <option value=">" <?= isset($_POST['criterio3']) && $_POST['criterio3'] == ">" ? 'selected' : '' ?>>&gt;</option>
                    <option value="<" <?= isset($_POST['criterio3']) && $_POST['criterio3'] == "<" ? 'selected' : '' ?>>&lt;</option>
                </select>
                <br>
            </div>
            <div class="columnacampos">
                <h3>Valor</h3>
                <input type="text" name="valor1" class="form-control form-control-sm" value="<?= isset($_POST['valor1']) ? $_POST['valor1'] : '' ?>">
                <br>
                <input type="text" name="valor2" class="form-control form-control-sm" value="<?= isset($_POST['valor2']) ? $_POST['valor2'] : '' ?>">
                <br>
                <input type="text" name="valor3" class="form-control form-control-sm" value="<?= isset($_POST['valor3']) ? $_POST['valor3'] : '' ?>">
                <br>
                {!!$error->ErrorFormateado('valor')!!}
            </div>
            <div class="columnacampos">
                <h3>Cumplimiento de condiciones</h3>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="oplogico" value="AND" <?= isset($_POST['oplogico']) && $_POST['oplogico'] == 'AND' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="espera">Todas (Y)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="oplogico" value="OR" <?= isset($_POST['oplogico']) && $_POST['oplogico'] == 'OR' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="espera">Alguna (O)</label>
                </div>
                <br>
                {!!$error->ErrorFormateado('oplogico')!!}
                <br>
                <input class="btn btn-primary" type="submit" value="Buscar" id="añadir">
            </div>
        </div>
    </form>
</div>
<h4>{!!$error->ErrorFormateado('criteriovalor')!!}</h4>
<h5><a href="index.php?controller=tareas&action=listar" class="btn btn-danger" role="button">Volver a listado</a></h5>
@endsection