<?php
class Categoria{
    //Definir los atributos
    private $idCategoria;
    private $nombre;

    //Definir el constructor
    
    public function __construct(){ //Constructor vacio

    }
    
    /*
    public function __construct($idCategoria,$nombre){ //constructor lleno
        $this->idCategoria = $idCategoria;
        $this->nombre = $nombre;
    }
    */

    //Definir los métodos de set y get.
    public function setidCategoria($idCategoria){
        $this->idCategoria = $idCategoria;
    }

    public function setnombre($nombre){
        $this->nombre = $nombre;
    }

    public function getidCategoria(){
        return $this->idCategoria;
    }

    public function getnombre(){
        return $this->nombre;
    }
}
?>