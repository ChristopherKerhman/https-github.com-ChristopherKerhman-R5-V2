<?php
session_start();
require '../objets/paramDB.php';
require '../objets/cud.php';
include '../CUD/fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $id = filter($_POST['idFigurine']);
  $valide = filter($_POST['valide']);
  $prepare = [['prep'=> ':idFigurine', 'variable' => $id], ['prep'=> ':valide', 'variable' => $valide]];
  $requetteSQL = "UPDATE `figurines` SET `valide` = :valide WHERE `idFigurine` = :idFigurine";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../index.php?idNav='.$idNav.'&message=Figurine modifiée.');
} else {
  header('location:../index.php?message=Erreur de traitement.');
}
