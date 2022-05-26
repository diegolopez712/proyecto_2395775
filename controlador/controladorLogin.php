<?php
require_once('../modelo/usuario.php');
switch($_REQUEST['accion']){
    case 'Acceder':
        //echo $_POST['accion'];
        if(isset($_POST['nombreUsuario']) && isset($_POST['contrasena'])){
            if(strlen($_POST['nombreUsuario'] ) >0 && strlen($_POST['contrasena']) > 0 ){
                $usuario = $_POST['nombreUsuario'];
                $contrasena = $_POST['contrasena'];
                $Usuario = new Usuario();
                $Usuario->setnombreUsuario($usuario);
                $Usuario->setcontrasena($contrasena);
                $Usuario->validarAcceso();
                if($Usuario->getlogueado() == 1){
                    //echo "Bienvenido";
                    session_start();//Emplear variables de sesión
                    //Definición de variable de sesión
                    $_SESSION['idUsuario'] = $Usuario->getidUsuario();
                    $_SESSION['nombreUsuario'] = $_POST['nombreUsuario'];
                    $_SESSION['idRol'] = $Usuario->getidRol();
                    //Redireccionar al menú
                    header("Location:../vista/menu.php");
                }
                else{
                    echo "
                    <script>
                    alert('Usuario y/o contraseña incorrectos');
                    document.location.href = '../index.html';
                    </script>
                    ";
                }
            }
            else{
                echo "El nombre de usuario y/o contraseña no pueden estar vacíos";
            }
        }
        break;

    case 'Salir':
            session_start();
            session_destroy(); //Destruir las variables de sesión.
            header('Location:../index.html');
        break;
}
//header("Location: ../index.html");



?>