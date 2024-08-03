<?php
/*$connect = 'mysql:dbname=pedidos;host=127.0.0.1';
$user = 'root';
$pass = '';*/

//Hostinguer
$connect = 'mysql:dbname=u425952029_pedidos;host=localhost';
$user = 'u425952029_Sodert_pedidos';  //u425952029 -> Usuario de Filezilla y de WorkBench
$pass = '26.RsAoTdCeHrEtT';

$bd = new PDO($connect, $user, $pass);