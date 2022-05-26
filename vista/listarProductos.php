<?php
require_once('../controlador/controladorProducto.php');
$controladorProducto = new controladorProducto();
$listarProducto = $controladorProducto->listarProducto();
//var_dump($listarCategoria);
?>
<?php
require_once('layoutSuperior.php');
?>
    <a href="../Controlador/controladorProducto.php?vista=registrarProducto.php">Registrar</a>
    <table  id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($listarProducto as $producto){
                    echo "<tr>";
                    echo "<td>".$producto['idProducto']."</td>";
                    echo "<td>".$producto['nombre']."</td>";
                    echo "<td>
                    <form method='POST' action='../Controlador/controladorProducto.php'>
                    <input type='hidden' name='idProducto' value=".$producto['idProducto']." />
                    <button type='submit' name='editar'>Editar</button>
                    </form>
                    <a href='#' onclick='validarEliminacion($producto[idProducto])' >Eliminar</a>
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
    function validarEliminacion(idProducto){
        let eliminar = "";
        if(confirm('Está seguro de eliminar el producto?')){
            document.location.href = "../Controlador/controladorProducto.php?idProducto="+idProducto+"&eliminar";
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
