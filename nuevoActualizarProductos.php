<?php
require 'bd.php';
require 'navbar.php'; 

try {
    //Mostrar TODO MENOS CATEGORIAS
    if (isset($_GET['CodProd'])) {
        $CodProd = $_GET['CodProd'];
        $result='';
        
        $sql = "SELECT CodProd, p.Nombre AS Nombre, p.Descripcion AS Descripcion, Peso, Stock, p.Categoria AS Categoria, c.CodCat AS CodCat, c.Nombre AS nomCategoria, c.Descripcion AS categoriaDescrip 
                FROM productos AS p 
                JOIN categorias AS c ON p.categoria = c.CodCat
                WHERE p.CodProd = '$CodProd'";

        $productos = $bd->query($sql);
        $producto = $productos->fetch(PDO::FETCH_ASSOC);
    
        //Mostrar CATEGORIAS
        $sql2 = "SELECT CodCat, Nombre, Descripcion FROM categorias";
        $categorias = $bd->query($sql2);
    
    //Nuevo/Actualizar
    } else {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $CodProd = $_POST['CodProd'];
            $Nombre = $_POST['Nombre'];
            $Descripcion = $_POST['Descripcion'];
            $Peso = $_POST['Peso'];
            $Stock = $_POST['Stock'];
            $categoria = $_POST['categoria'];

            if ($CodProd == 0) {
                //NUEVO
                $sql = "INSERT INTO productos(Nombre, Descripcion, Peso, Stock, categoria) 
                        values('$Nombre', '$Descripcion', '$Peso', '$Stock', '$categoria');"; 
                $productos = $bd->query($sql);
                //Control de errores
                if ($productos->rowCount() > 0) {
                    $result = "update correcto <br>";
                    header('Location: administrarProductos.php');
                } else {
                    $result = "update incorrecto <br>";
                    print_r($bd->errorinfo());
                }
            } else {
                //ACTUALIZAR
                $sql = "UPDATE productos 
                        SET Nombre='$Nombre', Descripcion='$Descripcion', Peso='$Peso', Stock='$Stock', categoria='$categoria' 
                        WHERE CodProd = '$CodProd'";
                $productos = $bd->query($sql);
                if ($productos->rowCount() > 0) {
                    $result = "update correcto <br>";
                    header('Location: administrarProductos.php');
                } else {
                    $result = "update incorrecto <br>";
                    print_r($bd->errorinfo());
                }
            }
        }
    }
} catch (PDOException $e) {
    echo 'Error con la base de datos: ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php if(isset($_GET['CodProd']) && $_GET['CodProd'] != 0) echo "Actualizar"; else echo "Guardar"; ?></title>
    </head>
    <body>
    <?php echo $result; ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <input type="hidden" name="CodProd" value="<?php echo $CodProd; ?>">
                <br><br>
                <label for="Nombre">Nombre:</label>
                <input required type="text" name="Nombre" value="<?php echo isset($producto['Nombre']) ? $producto['Nombre'] : ''; ?>" placeholder="<?php echo isset($producto['Nombre']) ? $producto['Nombre'] : ''; ?>">
                <br><br>
                <label for="Descripcion">Descripcion:</label>
                <input required type="text" name="Descripcion" value="<?php echo isset($producto['Descripcion']) ? $producto['Descripcion'] : ''; ?>" placeholder="<?php echo isset($producto['Descripcion']) ? $producto['Descripcion'] : ''; ?>">
                <br><br>
                <label for="Peso">Peso:</label>
                <input required type="text" name="Peso" value="<?php echo isset($producto['Peso']) ? $producto['Peso'] : ''; ?>" placeholder="<?php echo isset($producto['Peso']) ? $producto['Peso'] : ''; ?>">
                <br><br>
                <label for="Stock">Stock:</label>
                <input required type="text" name="Stock" value="<?php echo isset($producto['Stock']) ? $producto['Stock'] : ''; ?>" placeholder="<?php echo isset($producto['Stock']) ? $producto['Stock'] : ''; ?>">
                <br><br>
                <label for="categoria">Categorias:</label><br>
                <select name="categoria" id="categoria" required> 
                    <option <?php echo !isset($producto['Categoria']) ? "selected" : ''; ?> disabled>Seleccione una categoría</option>
                    <?php foreach ($categorias as $categoria) { 
                        if(isset($categoria['CodCat'])){ 
                                if(isset($producto['Categoria'])){ ?>
                                    <option value="<?php echo $categoria['CodCat']; ?>" <?php echo $categoria['CodCat'] == $producto['Categoria'] ? "selected" : ''; ?>>
                        <?php } else{ ?>
                                    <option value="<?php echo $categoria['CodCat']; ?>">
                        <?php } }?>    
                                        <?php echo $categoria['CodCat']." - ".$categoria['Descripcion']; 
                    } ?>
                    </option>
                </select>      
                <br><br>
                <input type="submit" value=<?php echo isset($_GET['CodProd']) && $_GET['CodProd'] != 0 ? "Actualizar" : "Guardar"; ?>>
            </form>
        <a href="./administrarProductos.php" style='text-decoration: none;'><button>Listado de productos</button></a>
    </body>
</html>
