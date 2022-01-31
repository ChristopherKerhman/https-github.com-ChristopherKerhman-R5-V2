<?php
include 'securite/securiterUtilisateur.php';
require 'objets/vehicules.php';
require 'objets/armes.php';
require 'objets/rulesSp.php';
$idVehicule = filter($_GET['idVehicule']);
$ficheVehicule = new Vehicules($_SESSION['idUser'], $idNav);
$dataID = $ficheVehicule->securiteID ($idVehicule);
if (!empty($dataID)) {
$dataVehicule = $ficheVehicule->readVehicule($idVehicule);
$DC = $dataVehicule[0]['DC'];
if ($dataVehicule[0]['id_univers']>0) {
  $ficheVehicule->UniversFaction($idVehicule);
} else {
  echo '<h3 class="sousTitre">Pas encore d`univers affecté</h3>';
}
$prix = $ficheVehicule->prixBrute($idVehicule);
$ficheVehicule->fiche($dataVehicule);
$ficheVehicule->spRules($idVehicule);
$dataDotation = $ficheVehicule->dotationArme($idVehicule);
//print_r($dataDotation);
foreach ($dataDotation as $key => $value) {
  $doter = new Armes($_SESSION['idUser'], $idNav);
  $dataArme = $doter->readOneArmes($value['id_Arme']);
  $doter->resumeArme ($dataArme, $DC);
}
} else {
    echo '<h3 class="sousTitre">Pas de données</h3>';
}
