<?php 
include 'bd.php';
require 'navbar.php'; 

try{
    if($rol == '0') {
        header("Location: categorias.php");
    }

    if(isset($_GET['codProd'])) {
        $codProd = $_GET['codProd'];
    }

    $sql = "SELECT p.codProd AS codProd, p.nombre AS nombre, p.descripcion AS descripcion, p.peso, p.stock, C.Nombre AS categoria, C.Descripcion AS categoriaDescrip 
            FROM productos AS p
            JOIN categorias AS C ON p.categoria = C.CodCat 
            WHERE p.codProd = '$codProd'"; 

    $productos = $bd->query($sql);  
    $producto = $productos->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $ex) {
    echo 'Error con la base de datos: ' . $ex->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Ver producto</title>
</head>
<body>
    <div id="formulario">
        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Peso</th>
                <th>Stock</th>
                <th>Categoria</th>
                <th>Descripción categoría</th>
                <th></th>
            </tr>
            <tr>
                <td><?php echo $producto['nombre'] ?></td>
                <td><?php echo $producto['descripcion'] ?></td>
                <td><?php echo $producto['peso'] ?></td>
                <td><?php echo $producto['stock'] ?></td>
                <td><?php echo $producto['categoria'] ?></td>
                <td><?php echo $producto['categoriaDescrip'] ?></td>
                <td>
                    <a href='nuevoActualizarproducto.php?codProd=<?php echo $producto['codProd'] ?>'><img src="imagen/actualizar.png" width='40px' height='20px'></a>
                    <a href='borrarDato.php?codProd=<?php echo $producto['codProd'] ?>'><img src="imagen/borrar.jpg" width='40px' height='20px'></a>
                    <a href="./administrarProductos.php" style='text-decoration: none;'><button>Listado de productos</button></a>
                </td>
            </tr>
        </table>
    </div>
    
</body>
</html>