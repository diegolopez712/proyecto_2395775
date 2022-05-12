<?php
//Incluir el controlador a emplear
require_once('../controlador/controladorCategoria.php');
//Recibir valor del id a busca
$idCategoria = base64_decode($_REQUEST['idCategoria']);
$idCategoria = base64_decode($idCategoria);
//base64_decode: Desencripta
//Buscar la categoria en la bd y guardarlo en un objeto
$categoria = $controladorCategoria->buscarCategoria($idCategoria);
//var_dump($categoria);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 align='center'>Editar Categoría</h1>
    <form action="../controlador/controladorCategoria.php" method="POST">
        <label>Id:</label>
        <input type="text" name="idCategoria" id="idCategoria" value="<?php echo $categoria->getIdCategoria() ?>" readonly/>
        <br/>
        <label>Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $categoria->getnombre() ?>" required/>
        <br>
        <button type="submit" name="actualizar">Actualizar</button>
    </form>
</body>
</html>