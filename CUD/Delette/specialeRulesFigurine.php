<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $id_Figurine = filter($_POST['id_Figurine']);
  $idFigurineRules = filter($_POST['idFigurineRules']);
  $prepare = [['prep'=> ':idFigurineRules', 'variable' => $idFigurineRules]];
  $requetteSQL = "DELETE FROM `figurinesRules` WHERE `idFigurineRules` = :idFigurineRules";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
header('location:../../index.php?idNav='.$idNav.'&idFigurine='.$id_Figurine.'&message=Nouvelle règle spéciale effacée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
