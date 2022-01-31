<?php
include 'securite/securiterUtilisateur.php';
require 'objets/vehicules.php';
require 'objets/rulesSp.php';
require 'objets/armes.php';
$idVehicule = filter($_GET['idVehicule']);
$ficheVehicule = new Vehicules($_SESSION['idUser'], $idNav);
$dataID = $ficheVehicule->securiteID ($idVehicule);
if (!empty($dataID)) {
  echo '<form action="CUD/Update/fixerVehicule.php" method="post">
    <input type="hidden" name="idVehicule" value="'.$idVehicule.'">
    <button type="submit" name="button">Bon pour le service</button>
  </form>
  <h3 class="titreArticle">Dotation de nouvelles armes sur un véhicule</h3>';
  $dataVehicule = $ficheVehicule->readVehicule($idVehicule);
  $DC = $dataVehicule[0]['DC'];
  $dataUF = $ficheVehicule->UniversFaction($idVehicule);
  $prix = $ficheVehicule->prixBrute($idVehicule);
  $ficheVehicule->fiche($dataVehicule);
  $dataDotation = $ficheVehicule->dotationArme($idVehicule);
  //print_r($dataDotation);
  foreach ($dataDotation as $key => $value) {
    $doter = new Armes($_SESSION['idUser'], $idNav);
    $dataArme = $doter->readOneArmes($value['id_Arme']);
    $doter->resumeArme ($dataArme, $DC);
  }
  $ficheVehicule->spRules($idVehicule);
  // On sort la valeur idFaction en vue du tri sur les armes.
  $idF = $dataUF[0]['id_faction'];
  $armes = new Armes($_SESSION['idUser'], $idNav);
  $dataArmes = $armes->readArmes($idF);
   $ficheVehicule->delArmesVehicule($idVehicule);
  $armes->mosaiqueArmes($dataArmes, $idVehicule, $idNav, 1);
} else {
    echo '<h3 class="sousTitre">Pas de données</h3>';
}
