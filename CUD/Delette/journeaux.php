<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../../administration/securite.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$requetteSQL = "DELETE FROM `journaux`";
$action = new CurDB($requetteSQL, $prepare);
$action->actionDB();
header('location:../../index.php?idNav='.$idNav.'&message=Journeaux vidé.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}

 ?>
