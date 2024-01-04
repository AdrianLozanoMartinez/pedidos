<?php
    include 'bd.php';
    include 'navbar.php';

    try{
        $sql = 'SELECT CodCat, Nombre, Descripcion FROM categorias';
        $categorias = $bd->query($sql);

    } catch (PDOException $ex) {
        echo 'Error con la base de datos: ' . $ex->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div id="formulario">
        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
            <?php foreach ($categorias as $categoria){?>
            <tr>
                <td><a class='enlace' href="productos.php?CodCat=<?php echo $categoria['CodCat']?>"><?php echo $categoria['Nombre']?></a></td>
                <td><a class='enlace' href="productos.php?CodCat=<?php echo $categoria['CodCat']?>"><?php echo $categoria['Descripcion']?></a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <br>
    
</body>
</html>