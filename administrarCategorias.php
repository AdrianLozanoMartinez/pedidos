<?php 
include 'bd.php';
require 'navbar.php'; 

if($rol == '0') {
    header("Location: categorias.php");
}

$sql = 'SELECT * FROM categorias'; //Sino se especifica se debe poner tal cual como en la base de datos
$categorias = $bd->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Gestión de categorias</title>
</head>
<body>
    <div id="formulario">
        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($categorias as $categoria) { ?>
            <tr>
                <td><a href="verCategoria.php?CodCat=<?php echo $categoria['CodCat'] ?>" class='enlace'><?php echo $categoria['Nombre'] ?></a></td>
                <td><a href="verCategoria.php?CodCat=<?php echo $categoria['CodCat'] ?>" class='enlace'><?php echo $categoria['Descripcion'] ?></a></td>
                <td><a href='verCategoria.php?CodCat=<?php echo $categoria['CodCat'] ?>"'><img src="imagen/ver.jpg" width='40px' height='20px'></a></td>
                <td><a href='nuevoActualizarCategorias.php?CodCat=<?php echo $categoria['CodCat'] ?>'><img src="imagen/actualizar.png" width='40px' height='20px'></a></td>
                <td><a href='borrarDatoAdm.php?CodCat=<?php echo $categoria['CodCat'] ?>"'><img src="imagen/borrar.jpg" width='40px' height='20px'></a></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="9" style="text-align: center;"> <!--Se pone 0 para crear nuevo, ya que del 1 para arriba son id que se pone automáticamente-->
                    <a href='nuevoActualizarCategorias.php?CodCat=0'><img src="imagen/agregar.jpg" width='50px' height='40px'></a>
                </td>  
            </tr>
        </table>
    </div>
    
</body>
</html>