<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idArmes = filter($_POST['idArmes']);
  $prepare = [['prep'=> ':idArmes', 'variable' => $idArmes], ['prep'=> ':idUser', 'variable' => $_SESSION['idUser']]];
  $requetteSQL = "DELETE FROM `armes` WHERE `idArmes` = :idArmes AND `idCreateur` = :idUser";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Arme effacée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
