<?php
session_start();
include '../../administration/securite.php';
require '../../objets/paramDB.php';
require '../../objets/preparationRequette.php';
require '../../objets/cud.php';

include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$_POST = doublePOP($_POST, $idNav);
$creation = new Preparation();
$param = $creation->creationPrep ($_POST);
$requetteSQL = "UPDATE `images` SET `valide`= :valide WHERE `idImage` = :idImage";
$ModImage = new CurDB($requetteSQL, $param);
$ModImage->actionDB();

header('location:../../index.php?idNav='.$idNav.'&message=Validation de l\'image modifié.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}

 ?>
