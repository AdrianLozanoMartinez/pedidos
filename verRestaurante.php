<?php 
include 'bd.php';
require 'navbar.php'; 

try{
    if($rol == '0') {
        header("Location: restaurantes.php");
    }

    if(isset($_GET['CodRes'])) {
        $CodRes = $_GET['CodRes'];
    }

    $sql = "SELECT * FROM restaurantes WHERE CodRes = '$CodRes'"; 

    $restaurantes = $bd->query($sql);  
    $restaurante = $restaurantes->fetch(PDO::FETCH_ASSOC);

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
    <title>Ver categoría</title>
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
                <th>Direccion</th>
                <th>Rol</th>
                <th></th>
            </tr>
            <tr>
                <td><?php echo $restaurante['Correo'] ?></td>
                <td><?php echo $restaurante['Clave'] ?></td>
                <td><?php echo $restaurante['Pais'] ?></td>
                <td><?php echo $restaurante['CP'] ?></td>
                <td><?php echo $restaurante['Ciudad'] ?></td>
                <td><?php echo $restaurante['Direccion'] ?></td>
                <td><?php echo $restaurante['Rol'] ?></td>
                <td>
                    <a href='nuevoActualizarRestaurante.php?CodRes=<?php echo $restaurante['CodRes'] ?>'><img src="imagen/actualizar.png" width='40px' height='20px'></a>
                    <a href='borrarDato.php?CodRes=<?php echo $restaurante['CodRes'] ?>'><img src="imagen/borrar.jpg" width='40px' height='20px'></a>
                    <a href="./administrarRestaurantes.php" style='text-decoration: none;'><button>Listado de restaurantes</button></a>
                </td>
            </tr>
        </table>
    </div>
    
</body>
</html>