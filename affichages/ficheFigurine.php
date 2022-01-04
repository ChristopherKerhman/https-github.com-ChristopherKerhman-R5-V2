<?php
include 'stockageData/figurine.php';
include 'securite/securiterUtilisateur.php';
require 'objets/figurines.php';
require 'objets/rulesSp.php';
  $idFigurine = filter($_GET['idFigurine']);
  $figurine = new Figurines ($_SESSION['idUser'], $idNav);
  $dataFiche = $figurine->readFiche($idFigurine);
  $figurine->ficheFigurine($dataFiche);
  $figurine->spRules($idFigurine);
  $specialRules = new Rules ();
  $dataSP = $specialRules->readRules(1);
  $specialRules->affectationFigurine($dataSP, $dataFiche[0]['idFigurine'], $idNav);
?>
