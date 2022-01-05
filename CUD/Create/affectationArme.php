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
  $idArme = filter($_POST['idArmes']);
  $_POST = doublePOP($_POST, $idNav);
  $prep = new Preparation ();
  $prepare = $prep->creationPrep($_POST);
  // On va chercher le coef de l'arme :
  $param = [['prep'=>'idArmes', 'variable'=> $idArme]];
  $prixSQL = "SELECT `prix` FROM `armes` WHERE `idArmes`= :idArmes";
  $prixArme = new readDB($prixSQL, $param);
  $prix = $prixArme->read();
  $prix = $prix[0]['prix'];
  array_push($prepare,['prep'=>':prix', 'variable'=>$prix]);
  $requetteSQL = "INSERT INTO `dotationFigurine` (`id_Armes`, `id_Figurine`, `coef`) VALUES (:idArmes, :idFigurine, :prix)";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Arme doté.&idFigurine='.$idFigurine.'');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}

 ?>
