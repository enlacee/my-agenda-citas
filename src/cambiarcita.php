<?php require_once 'header.php' ?>
<?php require_once 'mysqli.php' ?>
<?php
// save POST
if (is_array($_POST) && count($_POST) > 0) {
    
    $id = (int) $_POST['id'];
    $anioPost = trim($_POST['anio']);
    $mesPost = trim($_POST['mes']);
    $diaPost = trim($_POST['dia']);
    $fecha =  "{$anioPost}-{$mesPost}-{$diaPost}";

    //format
    $d = new DateTime(trim($_POST['fecha']));
    $d->setDate($anioPost, $mesPost, $diaPost);
    $fechaUpdate = $d->format('Y-m-d H:i:s');
    
    $query = "UPDATE citas "
        . "SET fecha = '{$fechaUpdate}' "
        . "WHERE id = {$id};";
    $mysqli->query($query);

    $_SESSION['flashMessage'] = "Se Actualizado el registro id " . $id;
    
    header('Location: index.php');
    exit;
}

// process
if (!empty($_REQUEST['id']) && count($_POST) == 0) {
    $id = (int) $_REQUEST['id'];
    $query = "SELECT *FROM citas WHERE id = '{$id}'; ";
    $stm = $mysqli->query($query);
    $data = $stm->fetch_assoc();

    //param
    $d = new DateTime($data['fecha']);
    $hoyTime = $d->getTimestamp();
    $hoy = date('Y-m-d', $d->getTimestamp());
    $hoyDateTime = date('Y-m-d H:i:s', $d->getTimestamp());
    
} else {
    echo "registro no exite";
    exit;
}

/* close connection */
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Agregar Cita</title>
        <link rel='stylesheet' href='style.css' type='text/css' media='all' />
    </head>
    <body>

        <div class="container">
            <h1>Agregar Cita</h1>
            <p>
                LA FECHA ACTUAL ES : <strong><?php echo date('d', $hoyTime) ?> de 
                    <?php echo date('m', $hoyTime) ?> del <?php echo date('Y', $hoyTime) ?>
                </strong>
            </p>
            <P>Seleccione la nueva fecha</P>
            <div class="row">
                <div class="col-md-6">
                <form method="POST" action="">
                    <input type="hidden" class="form-control" name="id" value="<?php echo isset($data['id']) ? $data['id'] : '' ?>"/>
                    <input type="hidden" class="form-control" name="fecha" value="<?php echo isset($hoyDateTime) ? $hoyDateTime : '' ?>"/>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Día</th>
                                <th>Mes</th>
                                <th>Año</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="">
                                        <select class="form-control required" name="dia" aria-required="true">
                                            <?php for ($c = 1; $c < 32; $c++) : ?>
                                                <?php 
                                                    $dia = (int) date('d', $hoyTime);
                                                    $select = ($dia == $c) ? 'selected' : '';
                                                ?>
                                                    <option <?php echo $select ?> value="<?php echo $c ?>"><?php echo str_pad($c, 2, '0', STR_PAD_LEFT) ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        <select class="form-control required" name="mes" aria-required="true">
                                            <?php $mes = (int) date('m', $hoyTime); ?>
                                            <option value="1" <?php echo ($mes == '1') ? 'selected' : '' ?>>Enero</option>
                                            <option value="2" <?php echo ($mes == '2') ? 'selected' : '' ?>>Febrero</option>
                                            <option value="3" <?php echo ($mes == '3') ? 'selected' : '' ?>>Marzo</option>
                                            <option value="4" <?php echo ($mes == '4') ? 'selected' : '' ?>>Abril</option>
                                            <option value="5" <?php echo ($mes == '5') ? 'selected' : '' ?>>Mayo</option>
                                            <option value="6" <?php echo ($mes == '6') ? 'selected' : '' ?>>Junio</option>
                                            <option value="7" <?php echo ($mes == '7') ? 'selected' : '' ?>>Julio</option>
                                            <option value="8" <?php echo ($mes == '8') ? 'selected' : '' ?>>Agosto</option>
                                            <option value="9" <?php echo ($mes == '9') ? 'selected' : '' ?>>Septiembre</option>
                                            <option value="10" <?php echo ($mes == '10') ? 'selected' : '' ?>>Octubre</option>
                                            <option value="11" <?php echo ($mes == '11') ? 'selected' : '' ?>>Noviembre</option>
                                            <option value="12" <?php echo ($mes == '12') ? 'selected' : '' ?>>Diciembre</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <select class="form-control required" name="anio" aria-required="true">
                                        <?php for ($c = date('Y')-1; $c < (date('Y') + 5); $c++) : ?>
                                            <?php 
                                                $anio = (int) date('Y', $hoyTime);
                                                $select = ($anio == $c) ? 'selected' : '';
                                            ?>
                                            <option <?php echo $select ?> value="<?php echo $c ?>"><?php echo $c ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="3">
                                    <button class="btn btn-success">Aceptar Cambio</button>
                                    
                                    <a href="index.php" class="btn btn-danger">Descartar Cambio</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>

                </div>
            </div>

            <!-- buttons-->
        </div>
    </body>
</html>
