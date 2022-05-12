<?php
//Incluir el controlador a emplear
require_once('../controlador/controladorProducto.php');
require_once('../controlador/controladorCategoria.php');
//Recibir valor del id a busca
$idProducto = base64_decode($_REQUEST['idProducto']);
$idProducto = base64_decode($idProducto);
//base64_decode: Desencripta
//Buscar la categoria en la bd y guardarlo en un objeto
$producto = $controladorProducto->buscarProducto($idProducto);
//var_dump($categoria);

//Listar las categorías
$controladorCategoria = new controladorCategoria();
$listarCategoria = $controladorCategoria->listarCategoria();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
    <h1 align='center'>Editar Producto</h1>
    <label>Id</label>
    <input type="text" name="idProducto" id="idProducto" readonly value="<?php echo $producto->getidProducto(); ?>" />
    <br>
    <label>Nombre</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $producto->getnombre(); ?>" />
    <br> 
    <label>Categoria</label>
    <select name="idCategoria" id="idCategoria" >
        <option value="">Seleccione la Categoría</option>
        <?php
            foreach($listarCategoria as $categoria){
        ?>
            <option value="<?php echo $categoria['idCategoria'] ?>" 
            <?php if($categoria['idCategoria'] == $producto->getidCategoria()){?>   selected  <?php } ?> >
                <?php echo $categoria['nombre'] ?>
            </option>
        <?php
            }
        ?>
    </select>
    <br> 
    <label>Precio</label>
    <input type="text" name="precio" id="precio" value = "<?php echo $producto->getprecio() ?>"/>
    <br> 
    <label>Estado</label>
    <input type="radio" name="estado" id="estadoD" <?php  if($producto->getestado() == 1){ ?> checked  <?php } ?>  />Disponible
    <input type="radio" name="estado" id="estadoND" <?php  if($producto->getestado() == 0){ ?> checked  <?php } ?> />No Disponible
    <br> 
    <button type="submit" name="Editar" id="Editar">Registrar</button>
</body>
</html>