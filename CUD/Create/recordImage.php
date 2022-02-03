<?php
session_start();
include '../../administration/securite.php';
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';

//print_r($_FILES);
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$_POST = doublePOP($_POST, $idNav);
$ok = champsVide($_POST);
if (($ok == 1) || ($_FILES['nomImage']['size']== 0) ||($_FILES['nomImage']['size'] > 1000000)) {
  header('location:../../index.php?idNav='.$idNav.'&message=Un champs est vide ou image abscente ou trop grande.');
} else {
  // Enregistrement des images de la galerie dans la DB.
  $date = date("dmY");
  $rand = rand(0,1000);
  $entete = $date.$rand;
  $nomI = filter($_FILES['nomImage']['name']);
  $nameImage = $entete.$nomI;
  $creation = new Preparation();
  $param = $creation->creationPrep ($_POST);
  array_push($param, ['prep' => ':nomImage', 'variable' => $nameImage]);
  $requetteSQL = "INSERT INTO `images`(`description`, `alt`, `nomImage`) VALUES (:description, :alt, :nomImage)";
  $recordImage = new CurDB($requetteSQL, $param);
  $recordImage->actionDB();
  // Enregistrement des images sur le serveur.
  //move_uploaded_file($_FILES['nomImage']['tmp_name'],$f = '../../images/galerieFront'.$nameImage);
  move_uploaded_file($_FILES['nomImage']['tmp_name'],$f = '../../images/galerieFront/'.$nameImage);
  chmod($f, 0777);
  header('location:../../index.php?idNav='.$idNav.'&message=Image enregistrée.');
}
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}

 ?>
