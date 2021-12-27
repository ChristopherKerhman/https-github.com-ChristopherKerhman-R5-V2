<?php
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $idLore = filter($_POST['idLore']);
    $_POST = doublePOP($_POST);
    if (empty($_POST['texteLore']) || empty($_POST['titreLore']) || strlen($_POST['texteLore']) < 180) {
      header('location:../../index.php?idNav='.$idNav.'&idLore='.$idLore.'&message=Titre ou texte manquant ou pas assez long.');
    } else {
      // On fabrique la préparation
      $preparation = new Preparation();
      $prepare = $preparation->creationPrep($_POST);
      $requetteSQL= "UPDATE `lore`
      SET `titreLore`= :titreLore,`texteLore`= :texteLore,`valide`= :valide,`partager`= :partager
      WHERE `idLore`=:idLore";
      $action = new CurDB ($requetteSQL, $prepare);
      $action->actionDB();
    header('location:../../index.php?idNav='.$idNav.'&idLore='.$idLore.'&message=Modification prise en compte.');
    }


  } else {
    header('location:../../index.php?message=Erreur de traitement.');
  }

 ?>
