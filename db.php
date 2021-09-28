<?php

$host = "localhost";
$user = "root";
$pass = "root";
$database = "oldiberdi";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$database;charset=$charset";

try {
	$pdo = new PDO($dsn, $user, $pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e->getMessage();
	throw new PDOException($e->getMessage());
	
}
require_once "crud.php";
$crud = new crud($pdo);


// Front yaxshilash  edit delete update search
// Paginatsiya qo'shish

// GET va POST farqlari
// oop examole

