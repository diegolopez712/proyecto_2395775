<?php
require_once('../controlador/controladorProducto.php');
$controladorProducto = new controladorProducto();
$listarProducto = $controladorProducto->listarProducto();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label>Id Pedido</label>
        <input readonly type="text" id="idPedido" name="idPedido" />
        <br>
        <label>Cliente</label>
        <input type="text" name="idCliente" id="idCliente" />
        <br>
        <label>Producto:</label>
        <select name="idProducto" id="idProducto">
        <?php
            foreach($listarProducto as $producto){
        ?>
            <option value="<?php echo $producto['idProducto'] ?>">
                <?php echo $producto['nombre'] ?>
            </option>
        <?php
            }
        ?>
        </select>
        <br>
        <label>Precio</label>
        <input type="text" id="precio" name="precio" onkeypress="calcularSubtotal()" onkeydown="calcularSubtotal()" onkeyup="calcularSubtotal()" onblur="calcularSubtotal()" />
        <br>
        <label>Cantidad</label>
        <input type="text" id="cantidad" name="cantidad" onkeypress="calcularSubtotal()" onkeydown="calcularSubtotal()" onkeyup="calcularSubtotal()" onblur="calcularSubtotal()" />
        <br>
        <label>SubTotal:</label>
        <input readonly type="text" id="subTotal" name="subTotal" />
        <br>
        <input type="hidden" name="accion" value="Registrar" />
        <button type="button" onclick="registrar()">Agregar</button>
    </form>

    <script>
        function calcularSubtotal(){
            let precio = document.getElementById('precio').value;
            let cantidad = document.getElementById('cantidad').value;
            document.getElementById('subTotal').value = precio * cantidad;
        }

         async function registrar() {

            let formData = new FormData();
            formData.append("idPedido", document.getElementById('idPedido').value);
            formData.append("idCliente", document.getElementById('idCliente').value);
            formData.append("idProducto", document.getElementById('idProducto').value);
            formData.append("cantidad", document.getElementById('cantidad').value);
            formData.append("precio", document.getElementById('precio').value);
            formData.append("accion", 'Registrar');
            //formData.append("image", imageBlob, "image.png");

            let response = await fetch('../controlador/controladorPedido.php', {
                method: 'POST',
                body: formData
            });
            let result = await response.text();
            document.getElementById('idPedido').value = result;
            //alert(result);
        }

    </script>
</body>
</html>