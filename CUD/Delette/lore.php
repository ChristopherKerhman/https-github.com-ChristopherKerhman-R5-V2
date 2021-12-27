<?php
session_start();
include '../../securite/securiterUtilisateur.php';
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idLore = filter($_POST['idLore']);
  $prepare = [['prep'=> ':idLore', 'variable' => $idLore]];
  $requetteSQL = "DELETE FROM `lore` WHERE `idLore`= :idLore";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?message=Article de lore effacée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
