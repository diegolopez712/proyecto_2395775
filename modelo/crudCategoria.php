<?php
require_once('conexion.php');
class crudCategoria{

    public function __construct(){

    }

    public function listarCategoria(){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query('SELECT * FROM categoria ORDER BY idCategoria ASC');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function registrarCategoria($categoria){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO 
        categoria(idCategoria, nombre)
        VALUES(:idCategoria, :nombre) ');
        $sql->bindValue('idCategoria', '');
        $sql->bindValue('nombre', $categoria->getnombre());
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
    
    public function buscarCategoria($Categoria){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query("SELECT * FROM categoria 
               WHERE idCategoria=".$Categoria->getIdCategoria());
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return $sql->fetch();
        //return($sql->fetch()); //retornar todos los registros de la consulta.
    }

    public function actualizarCategoria($categoria){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE categoria 
        SET nombre =:nombre
        WHERE idCategoria=:idCategoria');
        $sql->bindValue('idCategoria', $categoria->getIdCategoria());
        $sql->bindValue('nombre', $categoria->getnombre());
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

    public function eliminarCategoria($categoria){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('DELETE FROM categoria 
        WHERE idCategoria=:idCategoria');
        $sql->bindValue('idCategoria', $categoria->getIdCategoria());
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