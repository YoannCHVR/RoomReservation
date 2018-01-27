<?php
//--------------------------  Exercice 1  ----------------------------
//on se connecte à la BDD en incluant notre fichier de connexion, à partir de là notre variable $connexion est disponible
require_once('config/connexion.php');

//Dans un premier temps on écrit la requête et on la stocke dans une variable
$sql_chambres = "SELECT * FROM chambres";
//Ensuite on envoie la requête à la bdd et on stocke les résultats dans une variable. ATTENTION, ces résultats ne sont pas lisibles en PHP
$resultat_chambres = $connexion->query($sql_chambres);
//Il y a plusieurs résultats, il faut donc utiliser fetchAll pour les organiser dans un tableau php
$chambres = $resultat_chambres->fetchAll(PDO::FETCH_OBJ);

//print_r($chambres);


//--------------------------  Exercice 3  ----------------------------
//on écrit la requête pour les lits et on la stocke dans une variable
$sql_lits = "SELECT * FROM lit";
//Ensuite on envoie la requête à la bdd et on stocke les résultats dans une variable. ATTENTION, ces résultats ne sont pas lisibles en PHP
$resultats_lits = $connexion->query($sql_lits);
//Il y a plusieurs résultats, il faut donc utiliser fetchAll pour les organiser dans un tableau php
$lits = $resultats_lits->fetchAll(PDO::FETCH_OBJ);

//on écrit la requête pour les standings et on la stocke dans une variable
$sql_standings = "SELECT * FROM standing";
//Ensuite on envoie la requête à la bdd et on stocke les résultats dans une variable. ATTENTION, ces résultats ne sont pas lisibles en PHP
$resultats_standings = $connexion->query($sql_standings);
//Il y a plusieurs résultats, il faut donc utiliser fetchAll pour les organiser dans un tableau php
$standings = $resultats_standings->fetchAll(PDO::FETCH_OBJ);


//--------------------------  Exercice 4  ----------------------------
//Si le formulaire de filtre a été soumis, la superglobale POST existe, si elle existe, on écrase la requête des chambres en faisant un WHERE sur 1 ou 2 critères
if (!empty($_POST)) {
	//Dans un premier temps on écrit la requête et on la stocke dans une variable
	$sql_chambres .= " WHERE 1=1";
	$sql_chambres .= (!empty($_POST['lit']))? " AND id_lit = ".$_POST['lit'] : '';
	$sql_chambres .= (!empty($_POST['standing']))? " AND id_standing = ".$_POST['standing'] : '';

	//Ensuite on envoie la requête à la bdd et on stocke les résultats dans une variable. ATTENTION, ces résultats ne sont pas lisibles en PHP
	$resultat_chambres = $connexion->query($sql_chambres);
	//Il y a plusieurs résultats, il faut donc utiliser fetchAll pour les organiser dans un tableau php
	$chambres = $resultat_chambres->fetchAll(PDO::FETCH_OBJ);

}

?>
<!DOCTYPE HTML>
<html>
<head>
        <title>Liste des chambres</title>
        <meta charset="utf-8">
</head>
<body>

	<?php

	if(!empty($_GET['msg_edition'])) {
		echo '<p>'.$_GET['msg_edition'].'</p>';
	}

	?>

        <?php
		//traitement de notre liste de chambre par un foreach
		foreach($chambres as $chambre) {
		?>
		<article>
            <h3><?php echo $chambre->nom;  //mettre ici le nom de la chambre ?></h3>
            <a href="detail.php?id_chambre=<?php echo $chambre->id; //mettre ici l'id de la chambre ?>">Détail</a>
			 -
            <a href="modifier_chambre.php?id_chambre=<?php echo $chambre->id;//mettre ici l'id de la chambre ?>">Modifier</a>
         </article>
        <?php
		//fin du foreach
		}
		?>
<br>
<br>
<fieldset>
	<legend>Filtre</legend>
	<form method="post">
		<p>
			<select name="lit">
				<option value="" >Choisir un type de lit</option>
				<?php
				foreach ($lits as $lit) {
					?>
				<option value="<?php echo $lit->id; //met l'id du genre en value à envoyer dans le formulaire ?>"
					<?php
				 if(!empty($_POST)) {
					 	if ($_POST['lit'] == $lit->id) {
 							echo "selected";
 						}
				 }
				  ?>><?php echo $lit->lit; ?></option>
				<?php
				//fin du foreach
				}
				?>
			</select>
		</p>
		<p>
			<select name="standing">
				<option value="" >Choisir un standing</option>
				<?php
				foreach ($standings as $standing) {
					?>
				<option value="<?php echo $standing->id; //met l'id du genre en value à envoyer dans le formulaire ?>"
					<?php
				 if(!empty($_POST)) {
					 	if ($_POST['standing'] == $standing->id) {
 							echo "selected";
 						}
				 }
				  ?>><?php echo $standing->standing; ?></option>
				<?php
				//fin du foreach
				}
				?>
			</select>
		</p>
		<p>
			<input type="submit" value="Rechercher" />
		</p>
	</form>
	<a href="index.php">Réinitialiser</a>
</fieldset>
</body>
</html>
