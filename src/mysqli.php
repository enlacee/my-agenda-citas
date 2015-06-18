<?php
$mysqli = new mysqli("localhost", "root", "123456", "agenda_citas");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexión: %s\n", mysqli_connect_error());
    exit();
}
