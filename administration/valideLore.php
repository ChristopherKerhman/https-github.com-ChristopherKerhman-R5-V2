<?php
session_start();
require '../objets/paramDB.php';
require '../objets/cud.php';
include '../CUD/fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $id = filter($_POST['idLore']);
  $valide = filter($_POST['valide']);
  $partager = filter($_POST['partager']);
  $prepare = [['prep'=> ':id', 'variable' => $id], ['prep'=> ':valide', 'variable' => $valide], ['prep'=> ':partager', 'variable' => $partager]];
  $requetteSQL = "UPDATE `lore` SET `valide` = :valide, `partager` = :partager WHERE `idLore` = :id";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../index.php?idNav='.$idNav.'&message=Lore modifiée.');
} else {
  header('location:../index.php?message=Erreur de traitement.');
}
