<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idArmes = filter($_POST['idArmes']);
  $_POST = doublePOP($_POST, $idNav);
  $prep = new Preparation ();
  $prepare = $prep->creationPrep($_POST);
  $requetteSQL = "INSERT INTO `armesRules`(`id_Armes`, `id_Rules`, `tauxRules`) VALUES (:idArmes, :idRules, :modification)";
  $dataUser = new CurDB($requetteSQL, $prepare);
  $dataUser->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Règles spécial enregistré.&idArmes='.$idArmes.'');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}

 ?>
