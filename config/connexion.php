<?php
/*
Dans ce fichier nous allons établir la connexion avec la BDD Mysql.
Une fois la connexion établie, nous stockons les informations de la connexion dans la variable $connexion

Chaque page qui appellera ce fichier connexion.php (par un require_once) pourra utiliser la variable $connexion pour interagir avec la BDD

*/

/*
La connexion se fait grâce au module PDO.
Les modules PHP fonctionnent par "Instance", on crée un instance avec l'instruction "new"

Les paramètres à passer sont les suivants : hôte, nom de la bdd, user, mdp
Pour plus de clarté dans le code et pour faciliter les modifications nous stockons les infos dans des variables :
*/
//Connexion au serveur UWAMP
/*
$serveur = 'localhost';
$bdd = 'hotel';
$user = 'root';
$mdp = 'root';
*/

$serveur = 'localhost';
$bdd = 'chambre';
$user = 'root';
$mdp = '';
try {
	$connexion = new PDO('mysql:host='.$serveur.';dbname='.$bdd,$user,$mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	//echo "connexion";
} catch(Exception $e) {
	die('erreur de connexion');
}

?>
