<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idArmes = filter($_POST['idArmes']);
  $prepare = [['prep'=> ':idArmes', 'variable' => $idArmes]];
  $requetteSQL = "UPDATE `armes` SET `valide`= 0 WHERE `idArmes` = :idArmes";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Arme Hors Service pour les futurs dotation.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
