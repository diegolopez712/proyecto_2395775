<?php
session_start();
//Garantizar que si no se está logueado se envíe al index
if(!isset($_SESSION['nombreUsuario'])){
    header("Location:../index.html");
}

if(isset($_REQUEST['pagina'])) //Si la variable página existe
{
    $pagina = $_REQUEST['pagina']; //Asignar a la variable $pagina la página.
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>CRUD Básico</title>
</head>
<body>
<div id="contenedor">
    <div id="superior">
        <a href="../controlador/controladorLogin.php?accion=Salir">Salir</a>
    </div>
    <div id="medio">
        <div id="izquierdo">
            <?php
            if ($_SESSION['idRol']==1){
            ?>
                <a href="../controlador/controladorCategoria.php?vista=listarCategorias.php">Categorias</a>
            <br>
            <?php
            }
            else{
            ?>
                <a href="../controlador/controladorProducto.php?vista=listarProductos.php">Productos</a>
                <br>
                <a href="../controlador/controladorPedido.php?vista=listarPedidos.php">Pedidos</a>
            <?php
            }
            ?>
        </div>
        <div id="derecho">