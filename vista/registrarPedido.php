<?php
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
        <input type="text" id="idPedido" name="idPedido" />
        <br>
        <label>Cliente</label>
        <input type="text" name="idCliente" id="idCliente" />
        <br>
        <input type="hidden" name="accion" value="Registrar" />
        <input type="button" onclick="registrar()" />
    </form>

    <script>
         async function registrar() {

            let formData = new FormData();
            formData.append("idPedido", document.getElementById('idPedido').value);
            formData.append("accion", 'Registrar');
            //formData.append("image", imageBlob, "image.png");

            let response = await fetch('../controlador/controladorPedido.php', {
                method: 'POST',
                body: formData
            });
            let result = await response.text();
            document.getElementById('idPedido').value = result;
            alert(result);
        }

    </script>
</body>
</html>