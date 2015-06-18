<?php require_once 'header.php' ?>
<?php
$hoyTime = time();
$hoy = date('Y-m-d', $hoyTime);

// process
if (is_array($_POST) && count($_POST) > 0 & !empty($_POST['descripcion'])) {
    
    require_once 'mysqli.php';
    
    $title = htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8');
    $created = date('Y-m-d h:i:s');
    
    $fecha = trim($_POST['fecha']) . ' ' . $_POST['hora'] . ':' . $_POST['minuto'] . ':00';
    //echo $fecha; exit;
    $query = "INSERT INTO citas (titulo, fecha, date_created) VALUES ('{$title}', '{$fecha}', '{$created}')";
    $mysqli->query($query);

    $_SESSION['flashMessage'] = 'Nuevo registro con el id ' . $mysqli->insert_id;

    /* close connection */
    $mysqli->close();
    
    header('Location: index.php');
    exit;
}

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
                Cita para el dia : <strong><?php echo date('d', $hoyTime) ?> de 
                <?php echo date('m', $hoyTime) ?> del <?php echo date('Y', $hoyTime) ?>
                </strong>
            </p>
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="POST">
                        <input type="hidden" class="form-control" name="fecha" value="<?php echo $hoy ?>"/>
                        
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Hora</th>
                                <th>Minuto</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <div class="">
                                        <select class="form-control required" name="hora" aria-required="true">
                                            <?php for($c = 0; $c < 24; $c++) : ?>
                                            <option value="<?php echo $c ?>"><?php echo str_pad($c, 2, '0', STR_PAD_LEFT) ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </th>
                                <td>
                                    <div class="">
                                        <select class="form-control required" name="minuto" aria-required="true">
                                            <?php for($c = 0; $c < 60; $c++) : ?>
                                            <option value="<?php echo $c ?>"><?php echo str_pad($c, 2, '0', STR_PAD_LEFT) ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                   <textarea class="form-control" name="descripcion" rows="3"></textarea>
                                </td>
                                
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <button class="btn btn-success">Grabar Cita</button>
                                    
                                    <a href="index.php" class="btn btn-danger">Cancelar</a>
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
