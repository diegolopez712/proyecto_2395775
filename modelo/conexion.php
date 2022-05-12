<?php
//conexion a usar en el proyecto es: PDO
//PDO: Librería de php para conexión y transacciones 
//orientada a objetos hacia una base de datos.
//objetos  
class Conexion{
    private static $conexion = NULL;
    private $host = 'localhost'; //Servidor de base de datos
    private $baseDatos = 'crud_2395775';//base de datos
    private $usuario = 'root';//Usuario de base de datos
    private $contrasena = '';//Contraseña.
    //mysqli: Conexiones exclusivas a mysql soporta POO
    //mysql: Conexiones exclusivas a mysql no soporta POO

    private function __construct(){} //Constructor vacio

    public static function conectar(){
        //Verificar errores
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        self::$conexion = new PDO('mysql:host=127.0.0.1;dbname=crud_2395775','root','',$pdo_options);
        return self::$conexion;
    }

    static function desconectar(&$conexion){
        $conexion = null;
    }
}

$baseDatos = Conexion::conectar();

?>