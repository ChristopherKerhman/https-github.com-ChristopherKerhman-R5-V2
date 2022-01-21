<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $_POST = doublePOP($_POST, $idNav);

  $ok = champsVide($_POST);
  if(filter($_POST['robot']) != 'A+B') {
      $ok = 1;
  }

  if ($ok > 0) {
  header('location:../../index.php?idNav='.$idNav.'&message=Un champs est vide.');
  } else {
    array_pop($_POST);
    $prep = new Preparation();
    $param = $prep->creationPrep ($_POST);
    $requetteSQL = "INSERT INTO `contact`( `mail`, `objet`, `message`) VALUES (:email, :objet, :message)";
    $action = new CurDB($requetteSQL, $param);
    $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Votre message est transmit.');
  }
} else {
header('location:../../index.php?message=Erreur de traitement.');
}

 ?>
