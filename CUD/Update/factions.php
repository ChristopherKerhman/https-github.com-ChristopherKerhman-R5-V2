<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $_POST = doublePOP($_POST, $idNav);
  print_r($_POST);
  $prep = new Preparation ();
  $prepare = $prep->creationPrepIdUser($_POST);
  $requetteSQL = "UPDATE `factions` SET `nomFaction`= :nomFaction,`partager`=:partager
  WHERE `idFaction` = :idFaction AND `idCreateur` = :idUser";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Faction modifée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
