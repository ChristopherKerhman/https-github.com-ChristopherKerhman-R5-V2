<?php
include 'securite/securiterUtilisateur.php';
require 'objets/armes.php';
// A mettre en commentaire ?
require 'objets/rulesSp.php';
$idArmes = filter($_GET['idArmes']);
$ficheArmes = new Armes ($_SESSION['idUser'], $idNav);
$securiterID = $ficheArmes->securiteID ($idArmes);
if(empty($securiterID)) {
  echo '<h3 class="sousTitre">Pas de données</h3>';
} else {
  $puissanceArme = $ficheArmes->valeurArmes($idArmes);
  $dataFiche = $ficheArmes->ficheArme($idArmes, $puissanceArme);
  $ficheArmes->specialRulesFicheArmes($idArmes);
  $puissanceArme = $ficheArmes->valeurArmes($idArmes);
}


 ?>
