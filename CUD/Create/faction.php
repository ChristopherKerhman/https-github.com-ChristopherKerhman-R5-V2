<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $_POST = doublePOP($_POST, $idNav);
  $prep = new Preparation ();
  $prepare = $prep->creationPrepIdUser($_POST);
  $requetteSQL = "INSERT INTO `factions`( `idUnivers`, `partager`, `nomFaction`, `idCreateur`, `valide`)
  VALUES (:idUnivers, :partager, :nomFaction, :idUser, 1 )";
  print_r($_POST);
  echo '<br />';
  print_r($prepare);
  $dataUser = new CurDB($requetteSQL, $prepare);
  $dataUser->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Faction enregistrée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
