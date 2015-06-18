<?php require_once 'header.php' ?>
<?php require_once 'mysqli.php' ?>
<?php
$hoyTime = time();
$hoy = date('Y-m-d', $hoyTime);

// process
if ( !empty($_REQUEST['id'])) {
    $id = (int) $_REQUEST['id'];
    
    $query = "DELETE FROM citas WHERE id = {$id};";
    $stmt = $mysqli->prepare("DELETE FROM citas WHERE id=?") or die($mysqli->error);
    $stmt->bind_param("i", $id);

    // Ejecutamos la sentencia preparada.
   $status = $stmt->execute() or die($mysqli->error);
}
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Agenda de citas | Eliminar</title>
        <link>
        <link rel='stylesheet' href='style.css' type='text/css' media='all' />
    </head>
    <body>
        <div class="container">
            <div class="row">
                 <h1>Eliminar</h1>
                <p class="">
                    cita eliminada.
                </p>

                <a href="index.php" class="btn btn-primary">Regresar</a>
            </div>
        </div>


    </body>
</html>