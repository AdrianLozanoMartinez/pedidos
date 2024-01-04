<?php
require 'bd.php';
try {
    session_start();    // unirse a la sesión

    //C A R R I T O
    //Un producto de la cesta elegido
    if (isset($_GET['CodProd'])) {
        $codProd = $_GET['CodProd'];
        if (isset($_SESSION['cesta'])) {
            foreach ($_SESSION['cesta'] as $key => $producto) {
                if ($producto['CodProd'] == $codProd) {
                    unset($_SESSION['cesta'][$key]);
                }
            }
        }
        header('Location: carrito.php');
    //Toda la cesta
    } else {
        unset($_SESSION['cesta']);
        header('Location: carrito.php');
    }
} catch (PDOException $e) {
    echo 'Error con la base de datos: ' . $e->getMessage();
}
?>