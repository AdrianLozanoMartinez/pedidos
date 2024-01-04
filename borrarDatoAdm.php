<?php
require 'bd.php';
try {
    //A D M I N I S T R A R
    //PRODUCTOS
    if(isset($_GET['CodProd'])){
		$CodProd = $_GET['CodProd'];

        //Comprobar si está en PEDIDOSPRODUCTOS, ya que si está no se puede borrar
        $verificarPedidos = "SELECT COUNT(*) as numPedidos FROM pedidosproductos WHERE producto = '$CodProd'";
        $consultaPedidos = $bd->query($verificarPedidos);
        $resultadoPedidos = $consultaPedidos->fetch(PDO::FETCH_ASSOC);

		if ($resultadoPedidos['numPedidos'] > 0) {
            //Mensaje
            echo '<script type="text/javascript">
                    alert("No se puede borrar el producto porque hay pedidos asociados.");
                    window.location.href = "administrarProductos.php";
                  </script>';
		} else {
			// Borra producto
			$del = "DELETE FROM productos WHERE CodProd = '$CodProd'";
			$resul = $bd->query($del);	
            
			header('Location: administrarProductos.php');
		}
        //Sin comprobar si se ha hecho pedidos o sino afecta
		/*$del = "DELETE FROM productos WHERE CodProd = '$CodProd'";
		$borrado = $bd->query($del);	

		if($borrado) header('Location: administrarProductos.php');
		else print_r( $bd -> errorinfo());*/
    //CATEGORÍA
    } else if(isset($_GET['CodCat'])){
        $CodCat = $_GET['CodCat'];

        $verificarPedidos = "SELECT COUNT(*) as numPedidos
        FROM pedidosproductos AS pp
        JOIN productos AS p ON pp.Producto = p.CodProd
        JOIN categorias AS c ON p.Categoria = c.CodCat
        WHERE c.CodCat = '$CodCat'";

        $consultaPedidos = $bd->query($verificarPedidos);
        $resultadoPedidos = $consultaPedidos->fetch(PDO::FETCH_ASSOC);

        if ($resultadoPedidos['numPedidos'] > 0) {  
            // Hay pedidos asociados a productos de esta categoría, mostrar mensaje de advertencia
            echo '<script type="text/javascript">
                    alert("No se puede borrar la categoría porque hay pedidos asociados.");
                    window.location.href = "administrarCategorias.php";
                  </script>';
		} else {
			// borrar
			$del = "DELETE FROM categorias WHERE CodCat = '$CodCat'";
			$resul = $bd->query($del);	

			header('Location: administrarCategorias.php');
		}
        /*$del = "DELETE FROM categorias WHERE CodCat = '$CodCat'";
        $borrado = $bd->query($del);	

        if($borrado) header('Location: administrarCategorias.php');
        else print_r( $bd -> errorinfo());*/
    //RESTAURANTES
    } else if(isset($_GET['CodRes'])){
        $CodRes = $_GET['CodRes'];

        $verificarPedidos = "SELECT COUNT(*) as numPedidos
        FROM pedidos
        WHERE Restaurante = '$CodRes'";

        $consultaPedidos = $bd->query($verificarPedidos);
        $resultadoPedidos = $consultaPedidos->fetch(PDO::FETCH_ASSOC);

        if ($resultadoPedidos['numPedidos'] > 0) {  
            // Hay pedidos asociados a productos de esta categoría, mostrar mensaje de advertencia
            echo '<script type="text/javascript">
                    alert("No se puede borrar el Restaurante porque hay pedidos asociados.");
                    window.location.href = "administrarRestaurantes.php";
                </script>';
        } else {
            // borrar
            $del = "DELETE FROM restaurantes WHERE CodRes = '$CodRes'";
            $resul = $bd->query($del);	

            header('Location: administrarRestaurantes.php');
        }
        /*$del = "DELETE FROM Restaurantes WHERE CodRes = '$CodRes'";
        $borrado = $bd->query($del);	

        if($borrado) header('Location: administrarRestaurantes.php');
        else print_r( $bd -> errorinfo());*/
    } 
} catch (PDOException $e) {
    echo 'Error con la base de datos: ' . $e->getMessage();
}
?>