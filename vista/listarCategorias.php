<?php
require_once('../controlador/controladorCategoria.php');
$controladorCategoria = new controladorCategoria();
$listarCategoria = $controladorCategoria->listarCategoria();
//var_dump($listarCategoria);
?>
<?php
require_once('layoutSuperior.php')
?>

    <link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css">
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

<?php
require_once('layoutInferior.php');
?>