<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idArmes = filter($_POST['idArmes']);
  $idAffectation = filter($_POST['idAffectation']);
  $prepare = [['prep'=> ':idAffectation', 'variable' => $idAffectation]];
  $requetteSQL = "DELETE FROM `armesRules` WHERE `idAffectation` = :idAffectation";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
header('location:../../index.php?idNav='.$idNav.'&idArmes='.$idArmes.'&message=Nouvelle règle spéciale effacée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
