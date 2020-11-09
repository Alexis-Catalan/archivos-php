<?php session_start();

if(isset($_POST['modificar'])) {
    $id = (int) $_POST['idMod'];
    $nombre = $_POST['nombreMod'];
    $apellidos = $_POST['apellidosMod'];
    $edad = $_POST['edadMod'];
    $puesto = $_POST['puestoMod'];

    $leer = fopen("datos.txt", "r");
    $status = false;

    while (!feof($leer)) {
        $guardar = fopen('respaldo.txt', 'a+');
        $claveid = fgets($leer);
        $clavenom = fgets($leer);
        $claveape = fgets($leer);
        $claveeda = fgets($leer);
        $clavepue = fgets($leer);
        if ($claveid == $id) {
            fputs($guardar, $id."\n");
            fputs($guardar, $nombre."\n");
            fputs($guardar, $apellidos."\n");
            fputs($guardar, $edad."\n");
            fputs($guardar, $puesto."\n");
            fclose($guardar);
            $status = true;
        }
        fputs($guardar, $claveid);
        fputs($guardar, $clavenom);
        fputs($guardar, $claveape);
        fputs($guardar, $claveeda);
        fputs($guardar, $clavepue);
        fclose($guardar);
    }
    fclose($leer);

    rename('respaldo.txt', 'datos.txt');

    if($status) {
        $_SESSION['message'] = 'Datos modificados correctamente.';
        $_SESSION['message_type'] = 'warning';
        header("Location: index.php");
    }
}

if(isset($_GET['id'])){
    $id = (int) $_REQUEST['id'];
    
    $leer = fopen("datos.txt", "r");

    while (!feof($leer)) {
        $claveid = fgets($leer);
        if ($id == $claveid) {
            $nombre = fgets($leer);
            $apellidos = fgets($leer);
            $edad = fgets($leer);
            $puesto = fgets($leer);
        }
    }
    fclose($leer);
}
?>

<?php include("includes/header.php")?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="modificar.php" method="POST">
                    <div class="form-group">
                        <label >ID:</label>
                        <input type="text" name="idMod" value="<?php echo $id; ?>" class="form-control"  readonly>
                    </div>
                    <div class="form-group">
                        <label >Nombre:</label>
                        <input type="text" name="nombreMod" value="<?php echo $nombre; ?>" class="form-control" placeholder="Modificar Nombre" autofocus required>
                    </div>
                    <div class="form-group">
                        <label >Apellidos:</label>
                        <input type="text" name="apellidosMod" value="<?php echo $apellidos; ?>" class="form-control" placeholder="Modificar Apellidos" required>
                    </div>
                    <div class="form-group">
                        <label >Edad:</label>
                        <input type="text" name="edadMod" value="<?php echo $edad; ?>" class="form-control" placeholder="Modificar Edad" required>
                    </div>
                    <div class="form-group">
                        <label >Puesto:</label>
                        <input type="text" name="puestoMod" value="<?php echo $puesto; ?>" class="form-control" placeholder="Modificar Puesto" required>
                    </div>
                    <button class="btn btn-success" name="modificar">Modificar Alumno</button>
                    <a href="index.php" class="btn btn-primary" name="Cancelar">Cancelar</a>
                </form>
            </div>
        </div>
</div>

<?php include("includes/footer.php")?>