<?php
	session_start();    // unirse a la sesión

	//BORRA SOLO LA SECCIÓN
	unset($_SESSION['correo']); 

	//BORRA TODAS LAS SECCIONES INCLUSO EL DE PRODUCTO
	// $_SESSION = array();
	// session_destroy();	// eliminar la sesion

	header("Location: login.php");