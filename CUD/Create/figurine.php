<?php

session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $_POST = doublePOP($_POST, $idNav);
  if(empty(filter($_POST['nomFigurine']))) {
    header('location:../../index.php?idNav='.$idNav.'&message=Au moins un champs est vide.');
  }
  $prep = new Preparation ();
  $prepare = $prep->creationPrepIdUser($_POST);
  print_r($prepare);
  $requetteSQL = "INSERT INTO `figurines`(`nomFigurine`, `description`, `typeFigurine`, `tailleFigurine`, `DQM`, `DC`, `pdv`, `svg`, `mouvement`,`id_User`)
  VALUES (:nomFigurine, :description, :typeFigurine, :tailleFigurine, :DQM, :DC, :pdv, :svg,  :mouvement, :idUser)";
  $action = new CurDB ($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Figurine '.filter($_POST['nomFigurine']).' enregistrée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}

 ?>
