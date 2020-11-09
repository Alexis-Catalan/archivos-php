<?php session_start();

$id = (int) $_GET['id'];

$leer = fopen("datos.txt", "r");
$status = false;

while (!feof($leer)) {
    $claveid = fgets($leer);
    $nombre = fgets($leer);
    $apellidos = fgets($leer);
    $edad = fgets($leer);
    $puesto = fgets($leer);
    if ($id == $claveid) {
        $status = true;
    } else {
        $guardar = fopen('respaldo.txt', 'a+');
        fputs($guardar, $claveid);
        fputs($guardar, $nombre);
        fputs($guardar, $apellidos);
        fputs($guardar, $edad);
        fputs($guardar, $puesto);
        fclose($guardar);
    }
}
fclose($leer);

rename('respaldo.txt', 'datos.txt');

if($status) {
    $_SESSION['message'] = 'Datos eliminados correctamente.';
    $_SESSION['message_type'] = 'danger';
    header("Location: index.php");   
}

?>