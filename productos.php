<?php
    include 'bd.php';
    include 'navbar.php';
    
    // Mostrar
    try{
        $CodCat='';
        if(isset($_GET['CodCat'])){
            $CodCat = $_GET['CodCat'];
        }

        $sql = "SELECT CodProd, Nombre, Descripcion, Peso, Stock 
                FROM productos 
                WHERE Categoria = '$CodCat'";

        $productos = $bd->query($sql);

    } catch (PDOException $ex) {
        echo 'Error al mostrar los productos: ' . $ex->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
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
                <th>Añadir</th>
            </tr>
            <?php foreach ($productos as $producto){ 
                if($producto['Stock'] > 0){?>
            <tr>
                <form action="agregar.php" method="POST">  
                    <input type="hidden" value="<?php echo $CodCat ?>" name="CodCat"> 
                    <input type="hidden" value="<?php echo $producto['CodProd']; ?>" name="CodProd" >
                    <input type="hidden" value="<?php echo $producto['Nombre'] ?>" name="Nombre">
                    <input type="hidden" value="<?php echo $producto['Descripcion'] ?>" name="Descripcion">
                    <input type="hidden" value="<?php echo $producto['Peso'] ?>" name="Peso">
                    <input type="hidden" value="<?php echo $producto['Stock'] ?>" name="Stock">
                    <td><?php echo $producto['Nombre'] ?></td>
                    <td><?php echo $producto['Descripcion'] ?></td>
                    <td><?php echo $producto['Peso'] ?></td>
                    <td><?php echo $producto['Stock'] ?></td> <!--Quitar lo cogido en productos al stock para mostrar-->
                    <td>
                        <input type="number" name="cantidad"  min="1" max="<?php echo $producto['Stock'] ?>">
                        <button type="submit" name="add">Añadir</button>
                    </td>
                </form>
            </tr>
            <?php } }?>
            <tr>
                <td colspan="5" style="text-align: center;">
                    <a href="categorias.php"><button>Categorías</button></a>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
