<?php
require_once('../controlador/controladorCategoria.php');
$controladorCategoria = new controladorCategoria();
$listarCategoria = $controladorCategoria->listarCategoria();
//var_dump($listarCategoria);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css">
    <title>Document</title>
</head>
<body>
    <a href="../Controlador/controladorCategoria.php?vista=registrarCategoria.php">Registrar</a>
    <table  id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($listarCategoria as $categoria){
                    echo "<tr>";
                    echo "<td>".$categoria['idCategoria']."</td>";
                    echo "<td>".$categoria['nombre']."</td>";
                    echo "<td>
                    <form method='POST' action='../Controlador/controladorCategoria.php'>
                    <input type='hidden' name='idCategoria' value=".$categoria['idCategoria']." />
                    <button type='submit' name='editar'>Editar</button>
                    </form>
                    <a href='#' onclick='validarEliminacion($categoria[idCategoria])' >Eliminar</a>
                    </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>
<script>
    function validarEliminacion(idCategoria){
        let eliminar = "";
        if(confirm('Está seguro de eliminar la Categoría?')){
            document.location.href = "../Controlador/controladorCategoria.php?idCategoria="+idCategoria+"&eliminar";
        }
    }



</script>
<script src="../assets/js/jquery-3.5.1.js"></script>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script>
        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
        });
    } );
</script>
</body>
</html>
