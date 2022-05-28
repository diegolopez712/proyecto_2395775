<?php
//session_start();
require_once('../modelo/pedido.php');
require_once('../modelo/detallePedido.php');

function listarPedido(){
    $pedido = new Pedido();
    return $pedido::listarPedido(); //Llamar el método que lista el pedido
}

function listarDetallePedido($detallePedido){
    $detallePedido = new DetallePedido();
    return $detallePedido::listarDetallePedido($detallePedido); //Llamar el método que lista el pedido
}

function desplegarVista($pagina){
    header("Location:../vista/".$pagina);
}

if(isset($_POST['accion'])){
    session_start();
    switch($_POST['accion']){
        case 'Registrar':
                $idPedido = $_POST['idPedido'];
                $idCliente = $_POST['idCliente'];
                $idProducto = $_POST['idProducto'];
                $cantidad =  $_POST['cantidad'];
                $precio = $_POST['precio'];
                //$_SESSION['idUsuario']: Contiene el idUsuario del usuario logueado 
                $idUsuario = $_SESSION['idUsuario'];
                //Instanciar Pedido
                if($idPedido == ""){
                    //Insertar en Pedido
                    $pedido = new Pedido();
                    $pedido->setidPedido($idPedido);
                    $pedido->setidCliente($idCliente);
                    $pedido->setestado(1);
                    $pedido->setidUsuario($idUsuario);
                    //$idPedido: almacena el idPedido que se acaba de registrar
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
        case 'ListarDetalle':
            $idPedido = $_POST['idPedido'];
            $detallePedido = new DetallePedido();
            $detallePedido->setidPedido($idPedido);
            $listaDetalle = $detallePedido::listarDetallePedido($detallePedido); 
            $header = "<table border='1' align='center'>
            <thead>
            <tr><th>Id</th>  
            <th>Cantidad</th> 
            </tr></thead>";
            $content = "";
            foreach($listaDetalle as $detalle){
              $content = $content."<tr>
              <td>$detalle[idProducto]</td>
              <td>$detalle[cantidad]</td>
              </tr>";
            }
            $footer = "</table>";
            echo $header.$content.$footer;
        break;
    }   
}
else if(isset($_REQUEST['vista'])){
    desplegarVista($_REQUEST['vista']);
}

?>