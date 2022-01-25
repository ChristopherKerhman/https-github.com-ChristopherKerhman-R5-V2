<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $idFigurine = filter($_POST['idVehicule']);
    $_POST = doublePOP($_POST, $idNav);
    if(empty(filter($_POST['nomVehicule']))) {
        header('location:../../index.php?idNav='.$idNav.'&message=Nom du véhicule abscent');
    } else {
      $prep = new Preparation ();
      $prepare = $prep->creationPrepIdUser($_POST);
      $requetteSQL = "UPDATE `transport` SET `nomVehicule`=:nomVehicule
      WHERE `idUser`= :idUser AND `idVehicule` =:idVehicule";
      $action = new CurDB($requetteSQL, $prepare);
      $action->actionDB();
    header('location:../../index.php?idNav='.$idNav.'&message=Nom du véhicule modifée');
    }

  } else {
    header('location:../../index.php?message=Erreur de modification de la fiche.');
  }
