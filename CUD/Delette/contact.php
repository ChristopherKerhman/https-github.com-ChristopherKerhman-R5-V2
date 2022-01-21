<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idContact = filter($_POST['idContact']);
  $prepare = [['prep'=> ':id', 'variable' => $idContact]];
  $requetteSQL = "DELETE FROM `contact` WHERE `idContact` = :id";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Message effacée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}

 ?>
