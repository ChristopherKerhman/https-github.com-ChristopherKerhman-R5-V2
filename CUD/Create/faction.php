<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $_POST = doublePOP($_POST, $idNav);
  if (empty(filter($_POST['nomFaction']))) {
    header('location:../../index.php?idNav='.$idNav.'&message=Faction vide.');
  } else {
    $prep = new Preparation ();
    $prepare = $prep->creationPrepIdUser($_POST);
    $requetteSQL = "INSERT INTO `factions`( `idUnivers`, `partager`, `nomFaction`, `idCreateur`, `valide`)
    VALUES (:idUnivers, :partager, :nomFaction, :idUser, 1 )";
    $dataUser = new CurDB($requetteSQL, $prepare);
    $dataUser->actionDB();
    header('location:../../index.php?idNav='.$idNav.'&message=Faction enregistrée.');
  }
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
