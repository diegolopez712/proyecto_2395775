<?php
require_once('../modelo/categoria.php');
require_once('../modelo/crudCategoria.php');

class controladorCategoria{
    
    public function __construct(){

    }

    public function listarCategoria(){
        //Crear un objeto de la clase categoria
        $crudCategoria = new crudCategoria();
        return $crudCategoria->listarCategoria();
    }

    public function registrarCategoria($nombre){
        //Crear un objeto de la clase categoria
        $crudCategoria = new crudCategoria();
        $Categoria = new Categoria();
        $Categoria->setidCategoria('');
        $Categoria->setnombre($nombre);
        $mensaje = $crudCategoria->registrarCategoria($Categoria);
        echo $mensaje;
        
    }

    public function buscarCategoria($idCategoria){
        //Crear un objeto de la clase categoria
        $crudCategoria = new crudCategoria();
        $Categoria = new Categoria();
        $Categoria->setidCategoria($idCategoria);
        //Buscar los datos de la categoria en la BD
        //var_dump($Categoria);
        $datosCategoria = $crudCategoria->buscarCategoria($Categoria);
        $Categoria->setnombre($datosCategoria['nombre']);
        //var_dump($Categoria);
        return $Categoria;
    }

    public function actualizarCategoria($idCategoria,$nombre){
        //Crear un objeto de la clase categoria
        $crudCategoria = new crudCategoria();
        $Categoria = new Categoria();
        $Categoria->setidCategoria($idCategoria);
        $Categoria->setnombre($nombre);
        //var_dump($Categoria);
        $mensaje = $crudCategoria->actualizarCategoria($Categoria);
        echo $mensaje;
    }

    public function eliminarCategoria($idCategoria){
        //Crear un objeto de la clase categoria
        $crudCategoria = new crudCategoria();
        $Categoria = new Categoria();
        $Categoria->setidCategoria($idCategoria);
        $Categoria->setnombre('');
        //var_dump($Categoria);
        $mensaje = $crudCategoria->eliminarCategoria($Categoria);
        //echo $mensaje;
         //El siguiente script muestra eventos con javascript
        echo "<script>
            alert('$mensaje');
            document.location.href='../Vista/listarCategorias.php';
        </script>";
    }

    public function desplegarVista($pagina){
        header("Location:../vista/".$pagina);
    }
}

$controladorCategoria = new controladorCategoria();
if (isset($_POST['registrar'])){ //Si la variable existe 
    //Recibir variables del formulario
    $nombre = $_POST['nombre'];
    $controladorCategoria->registrarCategoria($nombre);
}
else if(isset($_REQUEST['editar'])){
    //Recibir variables desde el formulario
    $idCategoria = base64_encode($_REQUEST['idCategoria']);
    $idCategoria = base64_encode($idCategoria);
    //base_decode: función que encripta una variable
    //var_dump($categoria);
    $controladorCategoria->desplegarVista('editarCategoria.php?idCategoria='.$idCategoria);
}
else if (isset($_POST['actualizar'])){ //Si la variable existe 
    //Recibir variables del formulario
    $idCategoria = $_POST['idCategoria'];
    $nombre = $_POST['nombre'];
    $controladorCategoria->actualizarCategoria($idCategoria,$nombre);
}
else if(isset($_GET['eliminar'])){
    //Recibir variables desde el formulario
    $idCategoria = $_REQUEST['idCategoria'];
    //var_dump($categoria);
    $controladorCategoria->eliminarCategoria($idCategoria);
    //$controladorCategoria->desplegarVista('listarCategorias.php');

}
elseif(isset($_REQUEST['vista'])){
    $controladorCategoria->desplegarVista($_REQUEST['vista']);
}

?>