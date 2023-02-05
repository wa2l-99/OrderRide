<?php
try {
	// On se connecte à MySQL en utilsant pdo
	$bdd = new PDO("mysql:host=localhost;dbname=web;charset=utf8", "root", "root");
	$bdd->query("set character set utf8");
} catch (Exception $e) {
	// En cas d'erreur, on affiche un message et on arrête tout
	die('Erreur : ' . $e->getMessage());
}
