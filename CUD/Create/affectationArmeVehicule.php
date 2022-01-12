<?php
session_start();
//include '../../securite/securiterCreateur.php';
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idVehicule = filter($_POST['id_Vehicule']);
  $idArme = filter($_POST['id_Armes']);
  $_POST = doublePOP($_POST, $idNav);
  $prep = new Preparation ();
  $prepare = $prep->creationPrep($_POST);
  $param = [['prep'=>'idArmes', 'variable'=> $idArme]];
  $prixSQL = "SELECT `prix` FROM `armes` WHERE `idArmes`= :idArmes";
  $prixArme = new readDB($prixSQL, $param);
  $prix = $prixArme->read();
  $prix = $prix[0]['prix'];
  array_push($prepare,['prep'=>':prix', 'variable'=>$prix]);
  $requetteSQL = "INSERT INTO `dotationVehicule`(`id_Vehicule`, `id_Arme`, `coef`) VALUES (:id_Vehicule, :id_Armes, :prix)";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Arme doté.&idVehicule='.$idVehicule.'');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}

 ?>
