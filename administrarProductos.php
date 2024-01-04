<?php 
include 'bd.php';
require 'navbar.php'; 

if($rol == '0') {
    header("Location: categorias.php");
}

$sql = 'SELECT p.CodProd AS CodProd, p.nombre, p.descripcion, p.peso, p.stock, c.Nombre AS categoria, c.Descripcion AS categoriaDescrip
        FROM productos AS p
        JOIN categorias AS c ON p.categoria = c.CodCat'; //Añadimos JOIN porque queremos mostrar campos de otra tabla. Si queremos insertar/actualizar deberemos hacer dos
                                                       //veces la insercción/actualización para evitar problema con la clave foragnea que no puede estar vacía
$productos = $bd->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Gestión de productos</title>
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
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($productos as $producto) { ?>
            <tr>
                <td><a href="verProducto.php?CodProd=<?php echo $producto['CodProd'] ?>" class='enlace'><?php echo $producto['nombre'] ?></a></td>
                <td><a href="verProducto.php?CodProd=<?php echo $producto['CodProd'] ?>" class='enlace'><?php echo $producto['descripcion'] ?></a></td>
                <td><a href="verProducto.php?CodProd=<?php echo $producto['CodProd'] ?>" class='enlace'><?php echo $producto['peso'] ?></a></td>
                <td><a href="verProducto.php?CodProd=<?php echo $producto['CodProd'] ?>" class='enlace'><?php echo $producto['stock'] ?></a></td>
                <td><a href="verProducto.php?CodProd=<?php echo $producto['CodProd'] ?>" class='enlace'><?php echo $producto['categoria'] ?></a></td>
                <td><a href="verProducto.php?CodProd=<?php echo $producto['CodProd'] ?>" class='enlace'><?php echo $producto['categoriaDescrip'] ?></a></td>
                <td><a href='verProducto.php?CodProd=<?php echo $producto['CodProd'] ?>"'><img src="imagen/ver.jpg" width='40px' height='20px'></a></td>
                <td><a href='nuevoActualizarProductos.php?CodProd=<?php echo $producto['CodProd'] ?>'><img src="imagen/actualizar.png" width='40px' height='20px'></a></td>
                <td><a href='borrarDatoAdm.php?CodProd=<?php echo $producto['CodProd'] ?>"'><img src="imagen/borrar.jpg" width='40px' height='20px'></a></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="9" style="text-align: center;"> <!--Se pone 0 para crear nuevo, ya que del 1 para arriba son id que se pone automáticamente-->
                    <a href='nuevoActualizarProductos.php?CodProd=0'><img src="imagen/agregar.jpg" width='50px' height='40px'></a>
                </td>  
            </tr>
        </table>
    </div>
    
</body>
</html>