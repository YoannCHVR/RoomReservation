<?php
//--------------------------  Exercice 5  ----------------------------
//on se connecte à la BDD en incluant notre fichier de connexion, à partir de là notre variable $connexion est disponible
require_once('config/connexion.php');

//Dans un premier temps on écrit la requête et on la stocke dans une variable
//il faut faire une condition WHERE sur l'id de la chambre en GET
$sql_chambre = "SELECT * FROM chambres";
$sql_chambre .= " WHERE chambres.id = ".$_GET['id_chambre'];
//Ensuite on envoie la requête à la bdd et on stocke les résultats dans une variable. ATTENTION, ces résultats ne sont pas lisibles en PHP
$resultat_chambre = $connexion->query($sql_chambre);
//Il y a 1 seul résultat, il faut donc utiliser fetch pour l'organiser dans un tableau php
$chambre = $resultat_chambre->fetch(PDO::FETCH_OBJ);


//Nous avons 2 champs select pour le type de lit et le standing
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



//--------------------------  Exercice 6  ----------------------------
//si le formulaire a été envoyé il a créé la superglobale POST, on enregistre les infos et on affiche un message d'erreur ou de succès
if (!empty($_POST)) {

	$sql_chambre = "UPDATE chambres";
	$sql_chambre .= " SET ";
	$sql_chambre .= "nom = '".$_POST['nom']."'";
	$sql_chambre .= ",prix = '".$_POST['prix']."'";
	$sql_chambre .= ",description = '".$_POST['description']."'";
	$sql_chambre .= ",id_lit = '".$_POST['lit']."'";
	$sql_chambre .= ",id_standing = '".$_POST['standing']."'";
	$sql_chambre .= " WHERE id='".$_POST['id']."'";

	//Ensuite on envoie la requête à la bdd pour execution. ATTENTION, il n'y aura pas de réponse à traiter, c'est un enregistrement
	//La méthode PDO pour executer une requête UPDATE est exec. Nous appellons cette méthode grâce à notre varaible qui contient les infos de communication avec la BDD, $connexion
	//nous pouvons définir un message de confirmation d'enregistrement

	if($connexion->exec($sql_chambre)) {
		$msg_edition = "Chambre modifiée";
	}
	else {
		$msg_edition = "Erreur lors de la modification";
	}

	header('location:index.php?msg_edition='.$msg_edition);
	exit();

}

?>
<!DOCTYPE HTML>
<html>
<head>
        <title>Modifier une chambre</title>
        <meta charset="utf-8">
</head>
<body>
    <a href="index.php">Retour à la liste</a>
	<br>
	<br>
<fieldset>
	<legend>Modification d'une chambre</legend>
	<form method="post">
		<input type="hidden" name="id" value="<?php echo $chambre->id; //nous passons l'id de la chambre dans le formulaire pour l'enregistrement des modifications en PHP?>" />
		<p>
			Nom <input type="text" name="nom" value="<?php echo $chambre->nom; //nom de la chambre?>" />
		</p>
		<p>
			Prix <input type="text" name="prix" value="<?php echo $chambre->prix; //prix de la chambre?>" />
		</p>
		<p>
			Description <textarea name="description"><?php echo $chambre->description; //description de la chambre?></textarea>
		</p>
		<p>
			<select name="lit">
				<option value="" >Choisir un type de lit</option>
				<?php
				foreach ($lits as $lit) {
					/*
					si le genre a déjà été sélectionné pour la voiture, il faut que l'option de la liste soit pré sélectionnée. en HTML5 il faut ajouter l'attribut selected.
					Pour ce faire nous allons créer une condition pour attribuer à une variable $selected la valeur "selected" ou null
					*/
					$selected_lit = (!empty($chambre->id) && $chambre->id_lit == $lit->id)? "selected":"";

					?>
				<option value="<?php echo $lit->id; //met l'id du genre en value à envoyer dans le formulaire ?>" <?php echo $selected_lit; //affiche "selected" ou rien ?>><?php echo $lit->lit; ?></option>
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
					/*
					si le genre a déjà été sélectionné pour la voiture, il faut que l'option de la liste soit pré sélectionnée. en HTML5 il faut ajouter l'attribut selected.
					Pour ce faire nous allons créer une condition pour attribuer à une variable $selected la valeur "selected" ou null
					*/
					$selected_standing = (!empty($chambre->id) && $chambre->id_standing == $standing->id)? "selected":"";

					?>
				<option value="<?php echo $standing->id; //met l'id du genre en value à envoyer dans le formulaire ?>" <?php echo $selected_standing; //affiche "selected" ou rien ?>><?php echo $standing->standing; ?></option>
				<?php
				//fin du foreach
				}
				?>
			</select>
		</p>
		<p>
			<input type="submit" value="Modifier" />
		</p>
	</form>
</fieldset>
</body>
</html>
