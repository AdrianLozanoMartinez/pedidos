<?php

session_start();
if(!isset($_SESSION['correo'])){	
    header("Location: login.php?noLogin=true");
}

//Mostrar opciones si es administrador
$correo = $_SESSION['correo'];

$rol ="SELECT Rol FROM restaurantes WHERE Correo = '$correo'"; 
$rol = $bd->query($rol);
$rol = $rol->fetch();
$rol = $rol['Rol'];
?>

<nav style='background: lightblue; display:flex; justify-content:center; align-items: center;'>
    <h1>Restaurante conectado: <?php echo $correo ?></h1>
    <div>
        <a href="logout.php" style='text-decoration: none; margin-left: 10px;'><button>Salir</button></a>
        <a href="categorias.php"><button>Categorías</button></a> 
        <a href="carrito.php" style='text-decoration: none;'><button>Carrito</button></a>
        <!-- Mostrar opciones si es administrador -->
        <?php if($rol == '1') {?>
            <hr>
            <a href="administrarProductos.php"><button>Administrar productos</button></a>
            <a href="administrarCategorias.php"><button>Administrar categorias</button></a>
            <a href="administrarRestaurantes.php"><button>Administrar restaurantes</button></a>
        <?php } ?>
    </div>
</nav>