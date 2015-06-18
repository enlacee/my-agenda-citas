<?php require_once 'header.php' ?>
<?php require_once 'mysqli.php' ?>
<?php
$hoy = date('Y-m-d');
$idCita = 1; 

// process
$query = "SELECT *FROM citas WHERE DATE(fecha) = '{$hoy}'; ";
$stm = $mysqli->query($query);

/* close connection */
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Agenda de citas</title>
        <link>
        <link rel='stylesheet' href='style.css' type='text/css' media='all' />
    </head>
    <body>

        <div class="container">
            <?php if (isset($_SESSION['flashMessage'])) : ?>
                <p></p>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Great!</strong> <?php echo $_SESSION['flashMessage'] ?>.
                </div>
            <?php unset($_SESSION['flashMessage']); endif; ?>
                
            <h1>Lista de Citas</h1>
            <p>
                Citas para hoy <strong><?php echo $hoy ?></strong>
            </p>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titulo</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cnt = 1; while ($data = $stm->fetch_assoc()) : ?>
                            <tr>
                                <th scope="row"><?php echo $cnt ?></th>
                                <td><?php echo $data['titulo'] ?> | <?php $d = new DateTime($data['fecha']); echo $d->format('H:i:s') ?></td>
                                <td>
                                    <a href="cambiarcita.php?id=<?php echo $data['id'] ?>" class="btn-warning">Editar</a>
                                    <a href="#" data-url="eliminarcita.php?id=<?php echo $data['id'] ?>" class="btn-danger eliminar">Eliminar</a>
                                </td>
                                
                            </tr>
                            <?php $cnt++; endwhile; ?>
                        </tbody>
                    </table>

                </div>
            </div>
            
            <!-- buttons-->
            <div class="row">
                <a href="agregarcita.php" class="btn btn-primary">Nueva cita</a>
                <p></p>
                <br /><br /><br /> 
            </div>
        </div>
        <script>
            var classname = document.getElementsByClassName("eliminar");

            var myFunction = function() {
                var r = confirm("Seguro de Eliminar?");
                if (r == true) {
                    window.location.href = this.getAttribute('data-url');
                }
            };

            for(var i=0;i<classname.length;i++){
                classname[i].addEventListener('click', myFunction, false);
            }
            
        </script>
    </body>
</html>
