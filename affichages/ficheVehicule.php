<?php
include 'securite/securiterUtilisateur.php';
require 'objets/vehicules.php';
require 'objets/rulesSp.php';
$idVehicule = filter($_GET['idVehicule']);
$ficheVehicule = new Vehicules($_SESSION['idUser'], $idNav);
$dataID = $ficheVehicule->securiteID ($idVehicule);
if (!empty($dataID)) {
  $dataVehicule = $ficheVehicule->readVehicule($idVehicule);
  if ($dataVehicule[0]['id_univers']>0) {
    $ficheVehicule->UniversFaction($idVehicule);
  } else {
    echo '<h3 class="sousTitre">Pas encore d`univers affecté</h3>';
  }
  $prix = $ficheVehicule->prixBrute($idVehicule);
  $ficheVehicule->fiche($dataVehicule);
  $ficheVehicule->spRules($idVehicule);

  $ficheVehicule->DelSpecialRules($idVehicule, $idNav);

  $liste = new Rules();
  $type = 2;
  $dataRS = $liste->readRules($type);
  $liste->affectation($dataRS, $idVehicule, $idNav, $type);
} else {
    echo '<h3 class="sousTitre">Pas de données</h3>';
}

 ?>
