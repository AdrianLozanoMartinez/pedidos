<?php
    session_start();
    try{
        //GENERAL
        $cesta = [];
        $CodCat = '';
        $cantidad = 0;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $CodProd = $_POST['CodProd'];
            $stock = $_POST['Stock'];

            if(isset($_POST['cantidad'])){
                $cantidad = $_POST['cantidad'];
            }

            //PRODUCTO - Agregar al carrito
            if(isset($_POST['add'])){   //Pongo name al botón para que se ejecute si se pulsa el botón y de ese modo ser ignorado si se pulsa otro
                $nuevo = false;

                //ACTUALIZAR añadiendo en producto
                foreach ($_SESSION['cesta'] as &$producto) {
                    if ($producto['CodProd'] == $CodProd) {
                        $producto['cantidad'] = $cantidad;
                        $nuevo = true;
                        header('Location: productos.php?CodCat='.$producto['CodCat']);
                    }
                }

                //AÑADIR nuevo en producto
                if(!$nuevo){
            
                    $CodProd        = $_POST['CodProd'];
                    $CodCat         = $_POST['CodCat'];
                    $cantidad       = $_POST['cantidad'];
                    $Nombre         = $_POST['Nombre'];
                    $Descripcion    = $_POST['Descripcion'];
                    $Peso           = $_POST['Peso'];
                    $Stock          = $_POST['Stock'];

                    $cesta = [
                        'CodProd'       => $CodProd,
                        'CodCat'        => $CodCat,
                        'cantidad'      => $cantidad,
                        'Nombre'        => $Nombre,
                        'Descripcion'   => $Descripcion,
                        'Peso'          => $Peso,
                        'Stock'         => $Stock
                    ];

                    // Verificar si ya existe el producto en el carrito
                    //$_SESSION es un string al ponerle [] se convierte en array para coger los valores y meterlo en el array
                    if (isset($_SESSION['cesta'])) {
                        $_SESSION['cesta'][] = $cesta;
                        //Permanecer en productos para coger todos los necesarios y luego ir a la cesta
                        header('Location: productos.php?CodCat='.$CodCat);
                    } else {
                        $_SESSION['cesta'] = [$cesta];
                        header('Location: productos.php?CodCat='.$CodCat);
                    } 
                }
            }
            //CARRITO - Actualizar pulsando botón actualizar (CARRITO)
            else if (isset($_POST['actualizar'])) {
                foreach ($_POST as $key => $value) {
                    $CodProd = $key;
                    $cantidad = (int)$value;
                    
                    //Igual que actualizar de producto
                    foreach ($_SESSION['cesta'] as &$producto) {
                        if ($producto['CodProd'] == $CodProd) {
                            $producto['cantidad'] = $cantidad;
                            header('Location: carrito.php');
                        }
                    }
                }
            }
            //Actualizar pulsando botones + y - (CARRITO)
            else if(isset($_POST['accion'])){
                $accion = $_POST['accion'];
            
                if (isset($_SESSION['cesta'])) {
                    foreach ($_SESSION['cesta'] as &$producto) {
                        if ($producto['CodProd'] == $CodProd) {
                            if ($accion == 'aumentar') {
                                if($producto['cantidad'] < $stock && $producto['Stock'] >= 0 ){
                                    $producto['cantidad']++;
                                }
                            } else if ($accion == 'disminuir') {
                                if ($producto['cantidad'] > 1) {
                                    $producto['cantidad']--;
                                }
                            }
                            header('Location: carrito.php');
                        }
                    }
                }
            }
            
        }
    }
    catch (PDOException $ex){
        echo 'Error con la base de datos: ' . $ex->getMessage();
    }

     

    ?>