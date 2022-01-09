<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $id = filter($_POST['idFigurine']);
  $prepare = [['prep'=> ':id', 'variable' => $id],['prep'=> ':idUser', 'variable' => $_SESSION['idUser']]];
  $requetteSQL = "DELETE FROM `figurines` WHERE `idFigurine` = :id AND `id_User` = :idUser";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Figurine effacée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
