<?php 
include 'bd.php';
require 'navbar.php'; 

try{
    if($rol == '0') {
        header("Location: categorias.php");
    }

    if(isset($_GET['CodCat'])) {
        $CodCat = $_GET['CodCat'];
    }

    $sql = "SELECT * FROM categorias WHERE CodCat = '$CodCat'"; 

    $categorias = $bd->query($sql);  
    $categoria = $categorias->fetch(PDO::FETCH_ASSOC);

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
                <th>Nombre</th>
                <th>Descripcion</th>
                <th></th>
            </tr>
            <tr>
                <td><?php echo $categoria['Nombre'] ?></td>
                <td><?php echo $categoria['Descripcion'] ?></td>
                <td>
                    <a href='nuevoActualizarCategoria.php?CodCat=<?php echo $categoria['CodCat'] ?>'><img src="imagen/actualizar.png" width='40px' height='20px'></a>
                    <a href='borrarDato.php?CodCat=<?php echo $categoria['CodCat'] ?>'><img src="imagen/borrar.jpg" width='40px' height='20px'></a>
                    <a href="./administrarCategorias.php" style='text-decoration: none;'><button>Listado de categorias</button></a>
                </td>
            </tr>
        </table>
    </div>
    
</body>
</html>