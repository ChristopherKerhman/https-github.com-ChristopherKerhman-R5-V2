<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $_POST = doublePOP($_POST, $idNav);
  $prep = new Preparation ();
  $prepare = $prep->creationPrepIdUser($_POST);
  $requetteSQL = "INSERT INTO `armes`( `id_Univers`,`nom`, `description`, `typeArme`, `puissance`, `surPuissance`, `sort`, `valide`, `idCreateur`)
  VALUES (:id_Univers, :nom, :description, :typeArme, :puissance, :surPuissance, :sort , 1, :idUser)";
  $action = new CurDB ($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Arme '.filter($_POST['nom']).' enregistrée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
