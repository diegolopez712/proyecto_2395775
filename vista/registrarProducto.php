<?php
require_once('../controlador/controladorCategoria.php');
$controladorCategoria = new controladorCategoria();
$listarCategoria = $controladorCategoria->listarCategoria();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Producto</title>
</head>
<body>
    <h1 align='center'>Registrar Producto</h1>
    <label>Nombre</label>
    <input type="text" name="nombre" id="nombre" />
    <br> 
    <label>Categoria</label>
    <select name="idCategoria" id="idCategoria" >
        <option value="">Seleccione la Categoriía</option>
        <?php
            foreach($listarCategoria as $categoria){
        ?>
            <option value="<?php echo $categoria['idCategoria'] ?>">
                <?php echo $categoria['nombre'] ?>
            </option>
        <?php
            }
        ?>
    </select>
    <br> 
    <label>Precio</label>
    <input type="text" name="precio" id="precio" />
    <br> 
    <label>Estado</label>
    <input type="radio" name="estado" id="estadoD" />Disponible
    <input type="radio" name="estado" id="estadoND" />No Disponible
    <br> 
    <button type="submit" name="Registrar" id="Registrar">Registrar</button>
</body>
</html>