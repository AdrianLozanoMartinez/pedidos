<?php
    include 'bd.php';

    $correo = "";

    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $correo = $_POST['correo'];
            $clave = $_POST['clave'];

            //SIN ENCRIPTAR CONTRASEÑA
            $sql = "SELECT Correo, Clave FROM restaurantes WHERE Correo = '$correo' AND Clave='$clave'";
            $restaurantes = $bd->query($sql);

            if ($restaurantes->rowCount() > 0) {
                
                session_start();
                $_SESSION["correo"] = $correo;
                header("Location: categorias.php");
            } else {

                //ENCRIPTANDO CONTRASEÑA
                $sqlEncriptado = "SELECT Correo, Clave FROM restaurantes WHERE Correo = '$correo'";
                $restaurantesEncriptado = $bd->query($sqlEncriptado);
                $restaurante = $restaurantesEncriptado->fetch(PDO::FETCH_ASSOC);
                    
                if($restaurante == true){  

                    if (password_verify($clave, $restaurante['Clave'])) {  
                        session_start();
                        $_SESSION['correo'] = $correo;
                        header("Location: categorias.php");
                    } else {
                        echo 'Contraseña incorrecta';
                    }
                }else {
                    echo 'Correo incorrecto';
                }
            }
        }
    }catch(Exception $e){
        echo "Error $e";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilo.css">
        <title>Login</title>
    </head>
    <body>
        <main id="formulario">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <fieldset id="estrechar">
                    <legend>L O G I N</legend>
                    <label for="correo">Correo:</label>
                    <input type="text" name="correo" value="<?php if(isset($correo)) echo $correo;?>"> 
                    <br><br>
                    <label for="clave">Clave:</label>
                    <input type="password" name="clave">
                    <br><br>
                    <div class="centrar">
                        <input type="submit">
                    </div>
                </fieldset>
                <?php if(isset($_GET["noLogin"])){      
                    echo "<p>Haga login para continuar</p>";
                }?>
                <?php if(isset($err) and $err == true){   
                    echo "<p>Usuario o contraseña incorrecta</p>";
                }?>
            </form>
        </main>
    </body>
</html>