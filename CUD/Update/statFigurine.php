<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idFigurine = filter($_POST['idFigurine']);
  $_POST = doublePOP($_POST, $idNav);
  $prep = new Preparation ();
  $prepare = $prep->creationPrep($_POST);
  $requetteSQL = "UPDATE `figurines` SET
  `nomFigurine`= :nomFigurine,`description`=:description,`typeFigurine`=:typeFigurine,`tailleFigurine`=:tailleFigurine,`DQM`=:DQM,`DC`=:DC,`pdv`=:pdv, `svg`=:svg,`mouvement`=:mouvement, `vol` = :vol, `stationnaire` =:stationnaire WHERE `idFigurine` = :idFigurine";
//  print_r($prepare);
$action = new CurDB($requetteSQL, $prepare);
$action->actionDB();
header('location:../../index.php?idNav='.$idNav.'&message=Figurine modifée&idFigurine='.$idFigurine);
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
