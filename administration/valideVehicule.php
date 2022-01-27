<?php
session_start();
require '../objets/paramDB.php';
require '../objets/cud.php';
include '../CUD/fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $id = filter($_POST['idVehicule']);
  $valide = filter($_POST['valide']);
  $prepare = [['prep'=> ':idVehicule', 'variable' => $id], ['prep'=> ':valide', 'variable' => $valide]];
  $requetteSQL = "UPDATE `transport` SET `valide` = :valide WHERE `idVehicule` = :idVehicule";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../index.php?idNav='.$idNav.'&message=Vehicule modifiée.');
} else {
  header('location:../index.php?message=Erreur de traitement.');
}
