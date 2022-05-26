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
<?php
require_once('layoutSuperior.php');
?>
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
<?php
require_once('layoutInferior.php');
?>