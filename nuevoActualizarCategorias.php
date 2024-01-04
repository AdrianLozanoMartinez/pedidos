<?php
require 'bd.php';
require 'navbar.php'; 

try {
    if (isset($_GET['CodCat'])) {
        $CodCat = $_GET['CodCat'];
        $result='';
        
        $sql = "SELECT * FROM categorias WHERE CodCat = '$CodCat'";

        $categorias = $bd->query($sql);
        $categoria = $categorias->fetch(PDO::FETCH_ASSOC);
    
    //Nuevo/Actualizar
    } else {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $CodCat = $_POST['CodCat'];
            $Nombre = $_POST['Nombre'];
            $Descripcion = $_POST['Descripcion'];

            //EVITAR DUPLICIDAD
            $sql = "SELECT * FROM categorias";

            $categorias = $bd->query($sql);
            $categoria = $categorias->fetch(PDO::FETCH_ASSOC);

            if ($CodCat == 0 && $Nombre != $categoria['Nombre']) { //EVITAR DUPLICIDAD
                //NUEVO
                $sql = "INSERT INTO categorias(Nombre, Descripcion) values('$Nombre', '$Descripcion');"; 
                $categorias = $bd->query($sql);
                //Control de errores
                if ($categorias->rowCount() > 0) {
                    $result = "update correcto <br>";
                    header('Location: administrarCAtegorias.php');
                } else {
                    $result = "update incorrecto <br>";
                    print_r($bd->errorinfo());
                }
            } else if($CodCat != 0 && $Nombre != $categoria['Nombre']){ //EVITAR DUPLICIDAD
                //ACTUALIZAR
                $sql = "UPDATE categorias SET Nombre='$Nombre', Descripcion='$Descripcion' WHERE CodCat = '$CodCat'";
                $categorias = $bd->query($sql);
                if ($categorias->rowCount() > 0) {
                    $result = "update correcto <br>";
                    header('Location: administrarCategorias.php');
                } else {
                    $result = "update incorrecto <br>";
                    print_r($bd->errorinfo());
                }
            //EVITAR DUPLICIDAD
            } else {
                $result = "No se puede duplicar las categorías, revise el nombre";
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
        <title><?php if(isset($_GET['CodCat']) && $_GET['CodCat'] != 0) echo "Actualizar"; else echo "Guardar"; ?></title>
    </head>
    <body>
    <?php echo $result; ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <input type="hidden" name="CodCat" value="<?php echo $CodCat; ?>">
                <br><br>
                <label for="Nombre">Nombre:</label>
                <input required type="text" name="Nombre" value="<?php echo isset($categoria['Nombre']) ? $categoria['Nombre'] : ''; ?>" placeholder="<?php echo isset($categoria['Nombre']) ? $categoria['Nombre'] : ''; ?>">
                <br><br>
                <label for="Descripcion">Descripcion:</label>
                <input required type="text" name="Descripcion" value="<?php echo isset($categoria['Descripcion']) ? $categoria['Descripcion'] : ''; ?>" placeholder="<?php echo isset($categoria['Descripcion']) ? $categoria['Descripcion'] : ''; ?>">     
                <br><br>
                <input type="submit" value=<?php echo isset($_GET['CodCat']) && $_GET['CodCat'] != 0 ? "Actualizar" : "Guardar"; ?>>
            </form>
        <a href="./administrarCategorias.php" style='text-decoration: none;'><button>Listado de categoria</button></a>
    </body>
</html>
