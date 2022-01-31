<?php
include 'securite/securiterUtilisateur.php';
$idFigurine = filter($_GET['idFigurine']);
require 'objets/figurines.php';
require 'objets/armes.php';
$oneFigurine = new Figurines ($_SESSION['idUser'], $idNav);
$dataID = $oneFigurine->securiterIDFigurine($idFigurine);
if (!empty($dataID)) {
$dataFigurine = $oneFigurine->readFiche($idFigurine);
$oneFigurine->UniversFaction($idFigurine);
$oneFigurine->ficheSimple($dataFigurine);
$oneFigurine->spRules($idFigurine);
$DC = $dataFigurine[0]['DC'];
$dotationArme = $oneFigurine->dotationArme($idFigurine);
foreach ($dotationArme as $key) {
  $doter = new Armes ($_SESSION['idUser'], $idNav);
  $dataArme = $doter->readOneArmes($key['id_Armes']);
  $doter->resumeArme($dataArme, $DC);
}
}  else {
    echo '<h3 class="sousTitre">Pas de données</h3>';
}
 ?>
