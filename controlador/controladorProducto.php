<?php
require_once('../modelo/producto.php');
require_once('../modelo/crudProducto.php');

class controladorProducto{
    
    public function __construct(){

    }

    public function listarProducto(){
        //Crear un objeto de la clase categoria
        $crudProducto = new crudProducto();
        return $crudProducto->listarProducto();
    }

    public function registrarProducto($idCategoria,$nombre,$precio,$estado){
        //Crear un objeto de la clase categoria
        $crudProducto = new crudProducto();
        $Producto = new Producto();
        $Producto->setidProducto('');
        $Producto->setidCategoria($idCategoria);
        $Producto->setnombre($nombre);
        $Producto->setprecio($precio);
        $Producto->setestado($estado);
        $mensaje = $crudProducto->registrarProducto($Producto);
        echo $mensaje;   
    }

    public function buscarProducto($idProducto){
        //Crear un objeto de la clase categoria
        $crudProducto = new crudProducto();
        $Producto = new Producto();
        $Producto->setidProducto($idProducto);
        //Buscar los datos de la categoria en la BD
        //var_dump($Categoria);
        $datosProducto = $crudProducto->buscarProducto($Producto);
        $Producto->setidCategoria($datosProducto['idCategoria']);
        $Producto->setnombre($datosProducto['nombre']);
        $Producto->setprecio($datosProducto['precio']);
        $Producto->setestado($datosProducto['estado']);
        //var_dump($Categoria);
        return $Producto;
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

$controladorProducto = new controladorProducto();
if (isset($_POST['registrar'])){ //Si la variable existe 
    //Recibir variables del formulario
    $nombre = $_POST['nombre'];
    $idCategoria = $_POST['idCategoria'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];
    $controladorProducto->registrarProducto($idCategoria,$nombre,$precio,$estado);
}
else if(isset($_REQUEST['editar'])){
    //Recibir variables desde el formulario
    $idProducto = base64_encode($_REQUEST['idProducto']);
    $idProducto = base64_encode($idProducto);
    //base_decode: función que encripta una variable
    $controladorProducto->desplegarVista('editarProducto.php?idProducto='.$idProducto);
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