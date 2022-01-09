<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $id = filter($_POST['id']);
  $prepare = [['prep'=> ':id', 'variable' => $id],['prep'=> ':idUser', 'variable' => $_SESSION['idUser']]];
  $requetteSQL = "DELETE FROM `transport` WHERE `idVehicule` = :id AND `idUser` = :idUser";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Véhicule effacé.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
