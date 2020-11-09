<?php include("includes/header.php");

session_start();

if (!file_exists("datos.txt")) {
    fopen("datos.txt", "a");
}
?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4">
            <?php if(isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php session_unset(); } ?>
            <div class="card card-body">
                <form action="agregar.php" method="POST">
                    <div class="form-group">
                        <label >ID:</label>
                        <input type="text" name="id" class="form-control" placeholder="Introducir ID" autofocus required>
                    </div>
                    <div class="form-group">
                        <label >Nombre:</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Introducir Nombre" required>
                    </div>
                    <div class="form-group">
                        <label >Apellidos:</label>
                        <input type="text" name="apellidos" class="form-control" placeholder="Introducir Apellidos" required>
                    </div>
                    <div class="form-group">
                        <label >Edad:</label>
                        <input type="text" name="edad" class="form-control" placeholder="Introducir Edad" required>
                    </div>
                    <div class="form-group">
                        <label >Puesto:</label>
                        <input type="text" name="puesto" class="form-control" placeholder="Introducir Puesto" required>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" value="Agregar Alumno">
                </form>
            </div>
        </div>
        <div class=col-md-8>
                <table class="table table-hover">
                    <thead class="thead text-white text-center" style="background-color: #1F45A8;">
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Acciones</th>
                    </thead>
                    <tbody>
                    <?php
                        $leer = fopen("datos.txt", "r");
                        while (!feof($leer)){
                            $id = fgets($leer);
                            if (!$id == null) {
                         ?>
                            <tr class="text-center">
                                <td><?php echo $id ?></td>
                                <td><?php echo $nombre = fgets($leer); ?></td>
                                <td><?php echo $apellidos = fgets($leer); ?></td>
                                <td><?php echo $edad = fgets($leer); ?></td>
                                <td><?php echo $puesto = fgets($leer); ?></td>
                                <td>
                                    <a href="modificar.php?id=<?php echo $id ?>" class="btn btn-outline-info">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 
                                    2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 
                                    13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 
                                    5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/></svg></a>
                                    <a href="eliminar.php?id=<?php echo $id ?>" onclick="return confirm('¿Esta seguro de eliminar este registro?');" class="btn btn-outline-danger">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 
                                    1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 
                                    5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/></svg></a>
                                </td>
                            </tr>
                        <?php 
                        }
                    }fclose($leer); ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>

<?php include("includes/footer.php")?>
    
