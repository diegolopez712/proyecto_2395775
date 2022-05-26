<?php
require_once('../modelo/crudCliente.php');

class controladorCliente{
    
    public function __construct(){

    }
    public function listarCliente(){
        //Crear un objeto de la clase categoria
        $crudCliente = new crudCliente();
        return $crudCliente->listarCliente();
    }
}
$controladorCliente = new controladorCliente();
?>