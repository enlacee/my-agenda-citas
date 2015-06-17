<?php
$mysqli = new mysqli("localhost", "root", "123456", "agenda_citas");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexión: %s\n", mysqli_connect_error());
    exit();
}

$query = "INSERT INTO citas (titulo, fecha, date_created) VALUES ('', '', '')";
$mysqli->query($query);

printf ("Nuevo registro con el id %d.\n", $mysqli->insert_id);

/* drop table */
$mysqli->query("DROP TABLE myCity");

/* close connection */
$mysqli->close();
?>