<?php
require_once('conexion.php');
class crudProducto{

    public function __construct(){

    }

    public function listarProducto(){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query('SELECT * FROM producto ORDER BY idProducto ASC');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function registrarProducto($producto){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO 
        producto(idProducto,idCategoria, nombre, precio, estado)
        VALUES(:idProducto,:idCategoria, :nombre, :precio,:estado) ');
        $sql->bindValue('idProducto', '');
        $sql->bindValue('idCategoria', $producto->getidCategoria());
        $sql->bindValue('nombre', $producto->getnombre());
        $sql->bindValue('precio', $producto->getprecio());
        $sql->bindValue('estado', $producto->getestado());
        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "Registro Exitoso";
        }
        catch(Excepcion $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::desconectar($baseDatos); //Cierra la conexión.
        return $mensaje;
    }
    
    public function buscarProducto($Producto){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query("SELECT * FROM producto 
               WHERE idProducto=".$Producto->getidProducto());
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return $sql->fetch();
        //return($sql->fetch()); //retornar todos los registros de la consulta.
    }

    public function actualizarProducto($producto){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE producto 
        SET 
        idCategoria =:idCategoria,
        nombre =:nombre,
        precio =:precio,
        estado =:estado
        WHERE idProducto=:idProducto');
        $sql->bindValue('idProducto', $producto->getidProducto());
        $sql->bindValue('idCategoria', $producto->getIdCategoria());
        $sql->bindValue('nombre', $producto->getnombre());
        $sql->bindValue('precio', $producto->getprecio());
        $sql->bindValue('estado', $producto->getestado());
        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "Actualización Exitosa";
        }
        catch(Excepcion $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::desconectar($baseDatos); //Cierra la conexión.
        return $mensaje;
    }

    public function eliminarProducto($producto){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('DELETE FROM producto 
        WHERE idProducto=:idProducto');
        $sql->bindValue('idProducto', $producto->getidProducto());
        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "Eliminación Exitosa";
        }
        catch(Excepcion $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::desconectar($baseDatos); //Cierra la conexión.
        return $mensaje;
    }
 
}

//$prueba = new crudCategoria();
//var_dump($prueba->listarCategoria());
?>