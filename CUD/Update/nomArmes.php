<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $_POST = doublePOP($_POST, $idNav);
    if(empty(filter($_POST['nom']))) {
        header('location:../../index.php?idNav='.$idNav.'&message=Nom de l\'arme abscent.');
    } else {
      $prep = new Preparation ();
      $prepare = $prep->creationPrepIdUser($_POST);
      $requetteSQL = "UPDATE `armes` SET `nom`= :nom WHERE `idArmes` = :idArmes AND `idCreateur` = :idUser";
      $action = new CurDB($requetteSQL, $prepare);
      $action->actionDB();
    header('location:../../index.php?idNav='.$idNav.'&message=Nom de de l\'arme modifée.');
    }

  } else {
    header('location:../../index.php?message=Erreur de modification de la fiche.');
  }
