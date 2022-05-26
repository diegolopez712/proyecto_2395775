<?php
require_once('layoutSuperior.php');
?>    
    <form action="../controlador/controladorCategoria.php" method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" id="nombre" required/>
        <br>
        <button type="submit" name="registrar">Registrar</button>
    </form>
    <?php
require_once('layoutInferior.php');
?>