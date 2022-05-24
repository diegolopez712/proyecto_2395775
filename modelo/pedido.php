<?php
require_once('conexion.php');
class Pedido{
    private $idPedido;
    private $idCliente;
    private $fecha;
    private $estado;
    private $idUsuario;
    

    public function __construct(){

    }

    public function setidPedido($idPedido){
        $this->idPedido = $idPedido;
    }

    public function setidCliente($idCliente){
        $this->idCliente = $idCliente;
    }

    public function setfecha($fecha){
        $this->fecha = $fecha;
    }

    public function setestado($estado){
        $this->estado = $estado;
    }

    public function setidUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function getidPedido(){
        return $this->idPedido;
    }

    public function getidCliente(){
        return $this->idCliente;
    }

    public function getfecha(){
        return $this->fecha;
    }

    public function getestado(){
        return $this->estado;
    }

    public function getidUsuario(){
        return $this->idUsuario;
    }

    public function registrarPedido($pedido){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO 
        pedido(idPedido,idCliente, fecha, estado, idUsuario)
        VALUES(:idPedido,:idCliente, now(), :estado,:idUsuario) ');
        $sql->bindValue('idPedido', '');
        $sql->bindValue('idCliente', $pedido->getidCliente());
        //$sql->bindValue('fecha', $producto->getnombre());
        $sql->bindValue('estado', $pedido->getestado());
        $sql->bindValue('idUsuario', $pedido->getidUsuario());
        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje = $baseDatos->lastInsertId();
        }
        catch(Excepcion $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::desconectar($baseDatos); //Cierra la conexión.
        return $mensaje;
    }
}

?>