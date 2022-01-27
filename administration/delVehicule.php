<?php
session_start();
require '../objets/paramDB.php';
require '../objets/cud.php';
include '../CUD/fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $id = filter($_POST['idVehicule']);
  $prepare = [['prep'=> ':id', 'variable' => $id]];
  $requetteSQL = "DELETE FROM `transport` WHERE `idVehicule` = :id";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../index.php?idNav='.$idNav.'&message=Vehicule effacée.');
} else {
  header('location:../index.php?message=Erreur de traitement.');
}
