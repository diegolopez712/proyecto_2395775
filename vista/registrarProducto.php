<?php
require_once('../controlador/controladorCategoria.php');
$controladorCategoria = new controladorCategoria();
$listarCategoria = $controladorCategoria->listarCategoria();

?>
<?php 
require_once('layoutSuperior.php');
?>
    <h1 align='center'>Registrar Producto</h1>
    <form method="POST" action="../controlador/controladorProducto.php" >
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
    <button type="submit" name="registrar" id="Registrar">Registrar</button>
    </form>
<?php
require_once('layoutInferior.php');
?>