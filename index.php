<?php
include_once "./database_handler.php";
include_once "./numeros_perfectos.php";

$databaseHandler = new DatabaseHandler();
$numerosPerfectos = new NumerosPerfectos();
$consulta = $databaseHandler->consultarNumerosPerfectos();

if (isset($_POST['btnGuardar'])) {
    $numerosPerfectos->procesarRango($_POST['numeroFinal'], strlen($_POST['numeroInicio']) > 0 ? $_POST['numeroInicio'] : 1, true);
}

if (isset($_POST['btnBorrar'])) {
    $databaseHandler->eliminarNumeroPerfecto($_POST['idNumeroPerfecto']);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numeros perfectos</title>

    <!-- bootstrap 4 CDN scripts y sytlesheet -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="jumbotron text-center text-justified" style="background-color: #ddd;">
            <h1>Números perfectos</h1>
            <p>A continuación ingrese el número de inicio y el número final para verificar los naturales perfectos</p>
            <form action="" method="post">
                <div class="row">
                    <div class="col-8 offset-2">
                        <input type="number" class="form-control" name="numeroInicio" id="numeroInicio" placeholder="Primer número" min="1">
                    </div>
                    <div class="col-8 offset-2 mt-3">
                        <input type="number" class="form-control" name="numeroFinal" id="numeroFinal" placeholder="Segundo número" min="1" required>
                    </div>
                    <?php if (isset($_GET['noguardado'])) : ?>
                        <div class="alert alert-danger">
                            <strong>Error</strong> Intenta de nuevo <br> Verifica la longitud de tu número<br>
                            estamos trabajando en dar más soporte</a>.
                        </div>
                    <?php endif; ?>
                    <div class="col-8 offset-2 mt-3">
                        <button type="submit" class="btn btn-success" name="btnGuardar">Guardar</button>
                        <button type="reset" class="btn btn-danger">Limpiar</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="jumbotron mt-5 text-center text-justified" style="background-color: #ddd;">
            <h1>Números guardados</h1>
            <?php foreach ($consulta as $row) : ?>
                <h2 class='mt-5'><?php echo $row['numero']; ?></h2>
                <div class="card">
                    <div class="card-body">
                        <?php
                        //En este foreach se imprimen los números que conforman el perfecto
                        echo str_replace(',', '+', $row['divisores']);
                        echo ' = ' . $row['numero'];
                        ?>
                        <form action="" method="POST">
                            <input type="text" value="<?php echo $row['id'] ?>" name='idNumeroPerfecto' hidden>
                            <button type="submit" class="btn btn-danger" name="btnBorrar">Borrar</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>