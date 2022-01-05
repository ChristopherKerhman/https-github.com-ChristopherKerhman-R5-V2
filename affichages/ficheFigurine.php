<?php
include 'stockageData/figurine.php';
include 'securite/securiterUtilisateur.php';
require 'objets/figurines.php';
require 'objets/rulesSp.php';
  $idFigurine = filter($_GET['idFigurine']);
  $figurine = new Figurines ($_SESSION['idUser'], $idNav);
  $dataFiche = $figurine->readFiche($idFigurine);
  // Logique pour mettre un titre.
  if ($dataFiche[0]['figurineAffecter'] > 0) {
  $figurine->UniversFaction($dataFiche[0]['idFigurine']);
} else {
  echo '<h3 class="sousTitre">Pas encore d\'univers</h3>';
}
  $figurine->ficheFigurine($dataFiche, $idNav);
  $figurine->spRules($idFigurine);
  $figurine->DelSpecialRules($idFigurine, $idNav);
  $specialRules = new Rules ();
  $dataSP = $specialRules->readRules(1);
  $specialRules->affectationFigurine($dataSP, $dataFiche[0]['idFigurine'], $idNav);
?>
