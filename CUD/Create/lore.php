<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
// On récupére la nav
$idNav = $_POST['idNav'];
// On supprime les deux dernière entre de $_POST
array_pop($_POST);
array_pop($_POST);
// On fabrique la préparation
$preparation = new Preparation();
$prepare = $preparation->creationPrep($_POST);
$requetteSQL = "INSERT INTO `lore`( `idUnivers`, `titreLore`, `texteLore`, `partager`)
VALUES (:idUnivers, :titreLore, :texteLore, :partager)";
$action = new CurDB ($requetteSQL, $prepare);
$action->actionDB();
header('location:../../index.php?idNav='.$idNav.'&message=Texte de lore enregistré.');
} else {
  header('location:../../index.php?message=Erreur de traitement');
}

 ?>
