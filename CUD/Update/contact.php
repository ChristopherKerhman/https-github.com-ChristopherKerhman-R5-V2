<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $_POST = doublePOP($_POST, $idNav);
  $prep = new Preparation();
  $param = $prep->creationPrep ($_POST);
  $update = "UPDATE `contact` SET `traitement`=:traitement WHERE `idContact` = :idContact";
  $action = new CurDB($update, $param);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Message modifier.');
} else {
header('location:../../index.php?message=Erreur de traitement.');
}

 ?>
