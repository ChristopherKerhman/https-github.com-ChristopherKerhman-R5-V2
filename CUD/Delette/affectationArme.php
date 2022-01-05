<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idFigurine = filter($_POST['idFigurine']);
  $idDotation = filter($_POST['idDotation']);
  $prepare = [['prep'=> ':idDotation', 'variable' => $idDotation]];
  $requetteSQL = "DELETE FROM `dotationFigurine` WHERE `idDotation` = :idDotation";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Arme effacée.&idFigurine='.$idFigurine.'');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
