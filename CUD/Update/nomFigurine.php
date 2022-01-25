<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $idFigurine = filter($_POST['idFigurine']);
    $_POST = doublePOP($_POST, $idNav);
    if(empty(filter($_POST['nomFigurine']))) {
        header('location:../../index.php?idNav='.$idNav.'&message=Nom de la figurine abscent');
    } else {
      $prep = new Preparation ();
      $prepare = $prep->creationPrepIdUser($_POST);
      $requetteSQL = "UPDATE `figurines` SET
      `nomFigurine`= :nomFigurine
      WHERE `idFigurine` = :idFigurine AND `id_User` = :idUser";
      $action = new CurDB($requetteSQL, $prepare);
      $action->actionDB();
    header('location:../../index.php?idNav='.$idNav.'&message=Nom de la figurine modifée');
    }

  } else {
    header('location:../../index.php?message=Erreur de modification de la fiche.');
  }
