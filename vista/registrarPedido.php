<?php
require_once('../controlador/controladorProducto.php');
require_once('../controlador/controladorCliente.php');
$controladorProducto = new controladorProducto();
$listarProducto = $controladorProducto->listarProducto();
$listarCliente = $controladorCliente->listarCliente();
?>
<?php 
require_once('layoutSuperior.php');
?>
    <form action="" method="post">
        <label>Id Pedido</label>
        <input readonly type="text" id="idPedido" name="idPedido" />
        <br>
        <label>Cliente</label>
        <select name="idCliente" id="idCliente"> 
        <option value="">Seleccione</option>
        <?php
            foreach($listarCliente as $cliente){
                echo "<option value='$cliente[idCliente]'>
                $cliente[razonSocial]
                </option>";
            }
        ?>
        </select>
        <br>
        <label>Producto:</label>
        <select name="idProducto" id="idProducto" onchange="buscarPrecio(this.value)">
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
    <br>
    <div id="mensajeDetalle">

    </div>

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
            listarDetallePedido();//LLamar a listarDetallePedido
        }

        async function buscarPrecio(idProducto) {
            //FormaData: Es una clase de Javascript
            //FormData permite definir parámetros para
            //enviarlos a través de flex.
            let formData = new FormData();
            formData.append("idProducto", idProducto);
            formData.append("buscarPrecio", 'buscarPrecio');
            //fetch: Tecnología para peticiones asíncronas
            let response = await fetch('../controlador/controladorProducto.php', {
                method: 'POST',
                body: formData
            });
            //result almacena la respuesta del servidor
            let result = await response.text(); 
            
            //Asignar a la caja de texto el resultado
            document.getElementById('precio').value = result;
        }

        async function listarDetallePedido() {
            let formData = new FormData();
            formData.append("idPedido", document.getElementById('idPedido').value);    
            formData.append("accion", 'ListarDetalle');

            let response = await fetch('../controlador/controladorPedido.php', {
                method: 'POST',
                body: formData
            });
            let result = await response.text();
            //innerHTML agregar HTML
            document.getElementById('mensajeDetalle').innerHTML = result;

        }

        async function eliminarDetallePedido(idDetallePedido) {
            if(confirm('Está seguro de eliminar el detalle del producto'+idDetallePedido)){
                let formData = new FormData();
                formData.append("idDetallePedido", idDetallePedido);    
                formData.append("accion", 'EliminarDetalle');

                let response = await fetch('../controlador/controladorPedido.php', {
                    method: 'POST',
                    body: formData
                });
                let result = await response.text();
                alert(result);
                listarDetallePedido();
            }
        }
    </script>
<?php 
require_once('layoutInferior.php');
?>