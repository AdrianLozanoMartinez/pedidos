<?php
require 'bd.php';
require 'navbar.php'; 

try {
    $result='';
    if (isset($_GET['CodRes'])) {
        $CodRes = $_GET['CodRes'];
        
        $sql = "SELECT * FROM restaurantes WHERE CodRes = '$CodRes'";

        $restaurantes = $bd->query($sql);
        $restaurante = $restaurantes->fetch(PDO::FETCH_ASSOC);
    
    //Nuevo/Actualizar
    } else {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $CodRes = $_POST['CodRes'];
            $Correo = $_POST['Correo'];
            $Clave = $_POST['Clave'];
            $Pais = $_POST['Pais'];
            $CP = $_POST['CP'];
            $Ciudad = $_POST['Ciudad'];
            $Direccion = $_POST['Direccion'];
            $Rol = $_POST['Rol'];

            //EVITAR DUPLICIDAD
            $sql = "SELECT * FROM restaurantes";

            $restaurantes = $bd->query($sql);
            $restaurante = $restaurantes->fetch(PDO::FETCH_ASSOC);

            try{ //EVITAR DUPLICIDAD
                if ($CodRes == 0 && $Correo != $restaurante['Correo']) { //EVITAR DUPLICIDAD
                    //NUEVO
                    $sql = "INSERT INTO restaurantes(Correo, Clave, Pais, CP, Ciudad, Direccion, Rol) 
                            values('$Correo', '$Clave', '$Pais', '$CP', '$Ciudad', '$Direccion', '$Rol');"; 
                    $restaurantes = $bd->query($sql);
                    //Control de errores
                    if ($restaurantes->rowCount() > 0) {
                        $result = "update correcto <br>";
                        header('Location: administrarRestaurantes.php');
                    } else {
                        $result = "update incorrecto <br>";
                        print_r($bd->errorinfo());
                    }
                } else if($CodRes != 0 && $Correo != $restaurante['Correo']){ //EVITAR DUPLICIDAD
                    //ACTUALIZAR
                    $sql = "UPDATE restaurantes SET Correo='$Correo', Clave='$Clave', Pais='$Pais', CP='$CP', Ciudad='$Ciudad', Direccion='$Direccion', Rol='$Rol' 
                            WHERE CodRes = '$CodRes'";
                    $restaurantes = $bd->query($sql);
                    if ($restaurantes->rowCount() > 0) {
                        $result = "update correcto <br>";
                        header('Location: administrarRestaurantes.php');
                    } else {
                        $result = "update incorrecto <br>";
                        print_r($bd->errorinfo());
                    }
                } 
            //EVITAR DUPLICIDAD
            }catch (PDOException $e) {
                echo 'No se puede duplicar el Restaurante, revise el Correo';
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
        <title><?php if(isset($_GET['CodRes']) && $_GET['CodRes'] != 0) echo "Actualizar"; else echo "Guardar"; ?></title>
    </head>
    <body>
    <?php echo $result; ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <input type="hidden" name="CodRes" value="<?php echo $CodRes; ?>">
                <br><br>
                <label for="Correo">Correo:</label>
                <input required type="text" name="Correo" value="<?php echo isset($restaurante['Correo']) ? $restaurante['Correo'] : ''; ?>" placeholder="<?php echo isset($restaurante['Correo']) ? $restaurante['Correo'] : ''; ?>">
                <br><br>
                <label for="Clave">Clave:</label>
                <input required type="text" name="Clave" value="<?php echo isset($restaurante['Clave']) ? $restaurante['Clave'] : ''; ?>" placeholder="<?php echo isset($restaurante['Clave']) ? $restaurante['Clave'] : ''; ?>">     
                <br><br>
                <label for="Pais">Pais:</label>
                <input required type="text" name="Pais" value="<?php echo isset($restaurante['Pais']) ? $restaurante['Pais'] : ''; ?>" placeholder="<?php echo isset($restaurante['Pais']) ? $restaurante['Pais'] : ''; ?>">
                <br><br>
                <label for="CP">CP:</label>
                <input required type="text" name="CP" value="<?php echo isset($restaurante['CP']) ? $restaurante['CP'] : ''; ?>" placeholder="<?php echo isset($restaurante['CP']) ? $restaurante['CP'] : ''; ?>">     
                <br><br>
                <label for="Ciudad">Ciudad:</label>
                <input required type="text" name="Ciudad" value="<?php echo isset($restaurante['Ciudad']) ? $restaurante['Ciudad'] : ''; ?>" placeholder="<?php echo isset($restaurante['Ciudad']) ? $restaurante['Ciudad'] : ''; ?>">
                <br><br>
                <label for="Direccion">Direccion:</label>
                <input required type="text" name="Direccion" value="<?php echo isset($restaurante['Direccion']) ? $restaurante['Direccion'] : ''; ?>" placeholder="<?php echo isset($restaurante['Direccion']) ? $restaurante['Direccion'] : ''; ?>">     
                <br><br>
                <select name="Rol" id="Rol" required> 
                    <option value="0">Usuario</option>
                    <option value="1">Administrador</option>
                </select>     
                <br><br>
                <input type="submit" value=<?php echo isset($_GET['CodRes']) && $_GET['CodRes'] != 0 ? "Actualizar" : "Guardar"; ?>>
            </form>
        <a href="./administrarRestaurantes.php" style='text-decoration: none;'><button>Listado de restaurante</button></a>
    </body>
</html>
