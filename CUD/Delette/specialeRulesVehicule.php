<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idVehicule = filter($_POST['id_Vehicule']);
  $id = filter($_POST['idVehiculeRules']);
  $prepare = [['prep'=> ':id', 'variable' => $id]];
  $requetteSQL = "DELETE FROM `vehiculeRules` WHERE `idVehiculeRules` = :id";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
header('location:../../index.php?idNav='.$idNav.'&idVehicule='.$idVehicule.'&message=Nouvelle règle spéciale effacée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
