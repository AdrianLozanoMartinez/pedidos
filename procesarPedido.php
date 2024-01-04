<?php
    include 'bd.php';
    include 'navbar.php';

    try{
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['procesarPedido'])) {
            
            //Obtener RESTAURANTE
            //Cogemos el correo de la sessión cuando se longea el restaurante
            $correo = $_SESSION['correo'];
            $restaurantes = $bd->query("SELECT CodRes FROM restaurantes WHERE Correo = '$correo'");
            $codRes = $restaurantes->fetchColumn();  //OBTENEMOS CÓDIGO RESTAURANTE

            //Insertar PEDIDO
            $fechaGuardar = date("Y-m-d H:i:s");
            $enviado = '0';
            $pedidos = "INSERT INTO pedidos(Fecha, Enviado, Restaurante) values('$fechaGuardar', '$enviado', '$codRes');";
            $bd->query($pedidos); 
            
            //Código del PEDIDO creado de arriba
            $codPed = $bd->lastInsertId();
            
            //Recorremos productos
            $cesta = $_SESSION['cesta'];
            
            //Actualizar stock de productos
            $email='';
            foreach ($cesta as $producto) {
                $cantidad = $producto['cantidad'];
                $CodProd = $producto['CodProd'];

                //Insertar en PEDIDOSPRODUCTOS
                $pedidosProductos = "INSERT INTO pedidosproductos (pedido, producto, unidades) VALUES ('$codPed', '$CodProd', '$cantidad')";
                $bd->query($pedidosProductos);
 
                $sql = "UPDATE productos SET Stock = Stock - $cantidad WHERE CodProd='$CodProd'";
                $carrito = $bd->query($sql);

               
            }
        } else{
            $cesta = [];
            header('Location: carrito.php');
        }
    }catch (PDOException $ex){
        echo 'Error con la base de datos: ' . $ex->getMessage();
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesado pedido</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1 style="display:flex; justify-content:center; align-items:center;">Compra realizada con éxito</h1>
    <div id="formulario">
    <?php if($cesta != []){ 
        foreach ($cesta as $producto) {?>
        <fieldset>
            <legend><?php echo $producto['Nombre'] ?></legend>
            <ul>
                <li>Descripción <?php echo $producto['Descripcion'] ?></li>
                <li>Peso: <?php echo $producto['Peso'] ?></li>
                <li>Cantidad: <?php echo $producto['cantidad'] ?></li>
            </ul>
        </fieldset>
        <?php } 
        }?>  
    </div>
    <?php         
        if($carrito->rowCount() > 0){
            unset($_SESSION['cesta']);
        }?>
</body>
</html>