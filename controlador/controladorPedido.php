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
            <tr><th>Id Prod.</th>  
            <th>Nombre Prod.</th>  
            <th>Cantidad</th> 
            <th>Vr. Unitario COP</th> 
            <th>Subtotal COP</th> 
            <th>Acción</th>
            </tr></thead>";
            $content = "";
            $total = 0;
            foreach($listaDetalle as $detalle){
              
              $subTotal = 0;
              $precio = 0;
              $subTotal =$detalle['cantidad']*$detalle['precio'];
              $total = $total + $subTotal;
              $precio = $detalle['precio'];
              $precio = number_format($precio,2,",",".");
              $subTotal = number_format($subTotal,2,",",".");
              $content = $content."<tr>
              <td>$detalle[idProducto]</td>
              <td>$detalle[nombreProducto]</td>
              <td>$detalle[cantidad]</td>
              <td align='right'>$precio</td>
              <td align='right'>$subTotal</td>
              <td align='center'><button type='button' onclick='eliminarDetallePedido($detalle[idDetallePedido])'>X</button></td>
              </tr>";
            }
            $total = number_format($total,2,",",".");
            $content = $content."<tr><td colspan='4' align='right'>Total</td>
            <td align='right'>$total</td> 
            </tr>";
            $footer = "</table>";
            echo $header.$content.$footer;
        break;

        case 'EliminarDetalle':
            $idDetallePedido = $_POST['idDetallePedido'];
            $detallePedido = new DetallePedido();
            $detallePedido->setidDetallePedido($idDetallePedido);
            echo $detallePedido::eliminarDetallePedido($detallePedido);
            break;
    }   
}
else if(isset($_REQUEST['vista'])){
    desplegarVista($_REQUEST['vista']);
}

?>