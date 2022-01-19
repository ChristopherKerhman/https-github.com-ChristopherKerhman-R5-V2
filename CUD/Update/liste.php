<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idListe = filter($_POST['idListe']);
  $_POST = doublePOP($_POST, $idNav);
  $ok = champsVide($_POST);
  if ($ok > 0) {
    header('location:../../index.php?idNav='.$idNav.'&idListe='.$idListe.'&message=Un champs au moins est vide');
  }  else {
$update = "UPDATE `listeArmee` SET `nomListe`=:nomListe ,`partager`= :partager WHERE `idListe` = :idListe AND `idUser` = :idUser";
$prep = new Preparation ();
$prepare = $prep->creationPrepIdUser($_POST);
$action = new CurDB ($update, $prepare);
$action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&idListe='.$idListe.'&message=Modification prise en compte');
}
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}

 ?>
