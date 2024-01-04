<?php 
include 'bd.php';
require 'navbar.php'; 

if($rol == '0') {
    header("Location: categorias.php");
}

$sql = 'SELECT * FROM restaurantes'; 
$restaurantes = $bd->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Gestión de restaurantes</title>
</head>
<body>
    <div id="formulario">
        <table border="1">
            <tr>
                <th>Correo</th>
                <th>Clave</th>
                <th>Pais</th>
                <th>CP</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Rol</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($restaurantes as $restaurante) { ?>
            <tr>
                <td><a href="verRestaurante.php?CodRes=<?php echo $restaurante['CodRes'] ?>" class='enlace'><?php echo $restaurante['Correo'] ?></a></td>
                <td><a href="verRestaurante.php?CodRes=<?php echo $restaurante['CodRes'] ?>" class='enlace'><?php echo $restaurante['Clave'] ?></a></td>
                <td><a href="verRestaurante.php?CodRes=<?php echo $restaurante['CodRes'] ?>" class='enlace'><?php echo $restaurante['Pais'] ?></a></td>
                <td><a href="verRestaurante.php?CodRes=<?php echo $restaurante['CodRes'] ?>" class='enlace'><?php echo $restaurante['CP'] ?></a></td>
                <td><a href="verRestaurante.php?CodRes=<?php echo $restaurante['CodRes'] ?>" class='enlace'><?php echo $restaurante['Ciudad'] ?></a></td>
                <td><a href="verRestaurante.php?CodRes=<?php echo $restaurante['CodRes'] ?>" class='enlace'><?php echo $restaurante['Direccion'] ?></a></td>
                <td><a href="verRestaurante.php?CodRes=<?php echo $restaurante['CodRes'] ?>" class='enlace'><?php echo $restaurante['Rol'] ?></a></td>
                <td><a href='verRestaurante.php?CodRes=<?php echo $restaurante['CodRes'] ?>"'><img src="imagen/ver.jpg" width='40px' height='20px'></a></td>
                <td><a href='nuevoActualizarrestaurantes.php?CodRes=<?php echo $restaurante['CodRes'] ?>'><img src="imagen/actualizar.png" width='40px' height='20px'></a></td>
                <td><a href='borrarDatoAdm.php?CodRes=<?php echo $restaurante['CodRes'] ?>"'><img src="imagen/borrar.jpg" width='40px' height='20px'></a></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="10" style="text-align: center;"> <!--Se pone 0 para crear nuevo, ya que del 1 para arriba son id que se pone automáticamente-->
                    <a href='nuevoActualizarrestaurantes.php?CodRes=0'><img src="imagen/agregar.jpg" width='50px' height='40px'></a>
                </td>  
            </tr>
        </table>
    </div>
    
</body>
</html>