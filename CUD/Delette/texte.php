<?php session_start();
include '../../securite/securiterCreateur.php';
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $_POST = doublePOP($_POST, $idNav);
  $prep = new Preparation ();
  $prepare = $prep->creationPrepIdUser($_POST);
  $requetteSQL = "DELETE FROM `texteIndex` WHERE `id_User` = :idUser AND `idTexte`= :idTexte";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Texte effacé.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
