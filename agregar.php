<?php session_start();

$id = (int) $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$edad = $_POST['edad'];
$puesto = $_POST['puesto'];

$leer = fopen("datos.txt", "r");
$status = true;

while (!feof($leer)) {
    $claveid = fgets($leer);
    if ($id == $claveid) {
        $status = false;
        $_SESSION['message'] = 'Error el id ya existe en el archivo.';
        $_SESSION['message_type'] = 'danger';
        header("Location: index.php");
        break;
    }   
}
fclose($leer);

if ($status) {
    $guardar = fopen('datos.txt', 'a+');
    fputs($guardar, $id."\n");
    fputs($guardar, $nombre."\n");
    fputs($guardar, $apellidos."\n");
    fputs($guardar, $edad."\n");
    fputs($guardar, $puesto."\n");
    fclose($guardar);
    $_SESSION['message'] = 'Datos guardados correctamente.';
    $_SESSION['message_type'] = 'success';
    header("Location: index.php");
}
?>