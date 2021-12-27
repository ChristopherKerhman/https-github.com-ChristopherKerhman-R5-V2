<?php
session_start();
include '../../securite/securiterUtilisateur.php';
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idRules = filter($_POST['idRules']);
  $idNav = filter($_POST['idNav']);
  $prepare = [['prep'=> ':idRules', 'variable' => $idRules]];
  $requetteSQL = "DELETE FROM `rules` WHERE `idRules` = :idRules";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=règle spéciale effacée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
