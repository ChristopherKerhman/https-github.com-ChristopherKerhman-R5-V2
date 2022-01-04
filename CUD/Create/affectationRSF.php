<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idFigurine = filter($_POST['id_Figurine']);
  $_POST = doublePOP($_POST, $idNav);
  $prep = new Preparation ();
  $prepare = $prep->creationPrep($_POST);
  $requetteSQL = "INSERT INTO `figurinesRules`(`id_Figurine`, `id_Rules`, `modificateur`) VALUES (:id_Figurine, :id_Rules, :modificateur)";
  $dataUser = new CurDB($requetteSQL, $prepare);
  $dataUser->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Règles spécial enregistré.&idFigurine='.$idFigurine.'');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}

 ?>
