<?php
require_once('../modelo/pedido.php');
require_once('../modelo/detallePedido.php');

function listarPedido(){
    $pedido = new Pedido();
    return $pedido::listarPedido(); //Llamar el método que lista el pedido
}

function desplegarVista($pagina){
    header("Location:../vista/".$pagina);
}

if(isset($_POST['accion'])){
    switch($_POST['accion']){
        case 'Registrar':
                $idPedido = $_POST['idPedido'];
                $idCliente = $_POST['idCliente'];
                $idProducto = $_POST['idProducto'];
                $cantidad =  $_POST['cantidad'];
                $precio = $_POST['precio'];
                $idUsuario = $_SESSION['idUsuario'];
                //Instanciar Pedido
                if($idPedido == ""){
                    $pedido = new Pedido();
                    $pedido->setidPedido($idPedido);
                    $pedido->setidCliente($idCliente);
                    $pedido->setestado(1);
                    $pedido->setidUsuario($idUsuario);
                    $idPedido = $pedido::registrarPedido($pedido);
                }
                //Instanciar DetallePedido
                $detallePedido = new DetallePedido();
                $detallePedido->setidDetallePedido('');
                $detallePedido->setidPedido($idPedido);
                $detallePedido->setidProducto($idProducto);
                $detallePedido->setcantidad($cantidad);
                $detallePedido->setprecio($precio);
                $detallePedido::registrarDetallePedido($detallePedido); 
                echo $idPedido;
                break;
    }   
}
else if(isset($_REQUEST['vista'])){
    desplegarVista($_REQUEST['vista']);
}

?>