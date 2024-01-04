<?php
    include 'bd.php';
    include 'navbar.php';
    try{
        if (isset($_SESSION['cesta'])) {
            $cesta = $_SESSION['cesta'];
        }
        else{
            $cesta = [];
        }
    }
    catch (PDOException $ex){
        echo 'Error mostrando los artículos: ' . $ex->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div id="formulario">
        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Peso</th>
                <th>Stock</th>
                <th colspan="5">Modificar valor</th>
            </tr>
            <tr>
            <?php if($cesta != []){ 
                foreach ($cesta as $producto) { ?>
                <!-- <form action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">   -->
                <form action="agregar.php" method="POST">  
                    <input type="hidden" value="<?php echo $producto['CodProd'] ?>" name="CodProd">
                    <input type="hidden" value="<?php echo $producto['Nombre'] ?>" name="Nombre">
                    <input type="hidden" value="<?php echo $producto['Descripcion'] ?>" name="Descripcion">
                    <input type="hidden" value="<?php echo $producto['Peso'] ?>" name="Peso">
                    <input type="hidden" value="<?php echo $producto['Stock'] ?>" name="Stock">
                    <td><?php echo $producto['Nombre'] ?></td>
                    <td><?php echo $producto['Descripcion'] ?></td>
                    <td><?php echo $producto['Peso'] ?></td>
                    <td><?php echo $producto['Stock'] - $producto['cantidad'] ?></td> <!--Quitar lo cogido en productos al stock para mostrar-->
                    <td>
                        <!-- Usando el input para cambiar cantidad -->
                        <input type="number" name="<?php echo $producto['CodProd']; ?>" value="<?php echo $producto['cantidad']; ?>" min="1" max="<?php echo $producto['Stock'] ?>">
                        <!-- Usando solo + y - para cambiar cantidad -->
                        <!-- <input type="number" name="cantidad" value="<?php //echo $producto['cantidad']; ?>"> -->
                        <button type="submit" name="actualizar">Actualizar</button>
                        <button type="submit" name="accion" value="aumentar">+</button>
                        <button type="submit" name="accion" value="disminuir">-</button>
                    </td>
                </form>
                    <td><a href="borrarDato.php?CodProd=<?php echo $producto['CodProd'] ?>"><button type="submit">Eliminar</button></a></td></td>
                </tr>
                <?php } ?>
            <tr>
                <!-- PROCESAR PEDIDO -->
                <form action="procesarPedido.php" method="POST">
                    <td colspan="6" style="text-align: center;">
                        <button type="submit" name="procesarPedido">Realizar pedido</button>
                    </td>
                </form>
            </tr>
            <tr>
                <?php } else{ ?>
                    <td colspan="5" style="text-align: center;">Cesta vacía</td>
                <?php }?>
            </tr>
            <tr>
                <td colspan="6" style="text-align: center;">
                    <a href="productos.php?CodCat=<?php echo $producto['CodCat'] ?>"><button type="submit">Volver a los últimos productos añadidos</button></a>
                    <a href="borrarDato.php"><button type="submit">Vaciar carrito</button></a>
                    <a href="categorias.php"><button>Categorías</button></a>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>