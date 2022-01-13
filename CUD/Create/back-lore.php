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
$_POST = doublePOP($_POST);
// On contrôle que le titre et le texte ne soit pas vide
if (empty($_POST['texteLore']) || empty($_POST['titreLore']) || strlen($_POST['texteLore']) < 180) {
  header('location:../../index.php?idNav='.$idNav.'&message=Titre ou texte manquant ou pas assez long.');
} else {
  // On fabrique la préparation
  $preparation = new Preparation();
  $prepare = $preparation->creationPrep($_POST);
  // On enregistre le Lore dans la DB
  $requetteSQL = "INSERT INTO `lore`( `idUnivers`, `titreLore`, `texteLore`, `partager`)
  VALUES (:idUnivers, :titreLore, :texteLore, :partager)";
  $action = new CurDB ($requetteSQL, $prepare);
  $action->actionDB();
  // On repart d'où on est venus.
  header('location:../../index.php?idNav='.$idNav.'&message=Texte de lore enregistré.');
}

} else {
  header('location:../../index.php?message=Erreur de traitement');
}

 ?>
