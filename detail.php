<?php
//--------------------------  Exercice 2  ----------------------------
//on se connecte à la BDD en incluant notre fichier de connexion, à partir de là notre variable $connexion est disponible
require_once('config/connexion.php');

//Dans un premier temps on écrit la requête et on la stocke dans une variable
//il faut faire une condition WHERE sur l'id de la chambre en GET
//nous aurons besoin du standing et du type de lit donc il faut faire un join ou 2 autres requetes pour récupérer le lit et le standing
$sql_chambre = "SELECT * FROM chambres";
$sql_chambre .= " WHERE chambres.id = ".$_GET['id_chambre'];

//Ensuite on envoie la requête à la bdd et on stocke les résultats dans une variable. ATTENTION, ces résultats ne sont pas lisibles en PHP
$resultat_chambre = $connexion->query($sql_chambre);
//Il y a 1 seul résultat, il faut donc utiliser fetch pour l'organiser dans un tableau php
$chambre = $resultat_chambre->fetch(PDO::FETCH_OBJ);

?>
<!DOCTYPE HTML>
<html>
<head>
        <title>Détail d'une chambre</title>
        <meta charset="utf-8">
</head>
<body>
        <article>
            <a href="index.php">Retour à la liste</a>
            <h3>Nom de la chambre : <?php echo $chambre->nom; //mettre ici le nom de la chambre ?></h3>
            <p>Description : <?php echo $chambre->description; //mettre ici la description de la chambre ?></p>
            <p>Prix : <?php echo $chambre->prix; //mettre ici le prix de la chambre ?></p>
            <p>Standing : <?php
            $sql_standings = "SELECT * FROM standing";
    				$resultats_standings = $connexion->query($sql_standings);
    				$standings = $resultats_standings->fetchAll(PDO::FETCH_OBJ);

            foreach ($standings as $standing) {
              if(!empty($chambre->id) && $chambre->id_standing == $standing->id) {
                echo $standing->standing;
              }
            } //mettre ici le standing (champ standing) de la chambre ?></p>
            <p>Type de lit : <?php
            $sql_lits = "SELECT * FROM lit";
    				$resultats_lits = $connexion->query($sql_lits);
    				$lits = $resultats_lits->fetchAll(PDO::FETCH_OBJ);

            foreach ($lits as $lit) {
              if(!empty($chambre->id) && $chambre->id_lit == $lit->id) {
                echo $lit->lit;
              }
            } //mettre ici le type de lit (champ lit)) de la chambre ?></p>
         </article>

<br>

</body>
</html>
