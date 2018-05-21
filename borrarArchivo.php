<?php
    $nombre = $_POST['nombre'];
    unlink($nombre);
    echo 'ok';
?>