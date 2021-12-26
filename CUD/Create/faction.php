<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  if (empty($_POST['nomFaction'])) {
    header('location:../../index.php?idNav='.$idNav.'&message=Nom de faction abscente.');
  } else {
  $nomFaction =  filter($_POST['nomFaction']);
  }
  $idUnivers = filter($_POST['idUnivers']);
  $partager = filter($_POST['partager']);
  $requetteSQL = "INSERT INTO `factions`(`idCreateur`, `idUnivers`, `nomFaction`, `valide`, `partager`)
  VALUES (:idUser, :idUnivers, :nomFaction, :valide, :partager)";
  $prepare = [['prep'=> ':idUser', 'variable' => $_SESSION['idUser']],
    ['prep'=> ':idUnivers', 'variable' => $idUnivers],
    ['prep'=> ':nomFaction', 'variable' => $nomFaction],
    ['prep'=> ':valide', 'variable' => 1],
    ['prep'=> ':partager', 'variable' => $partager]];
    $dataUser = new CurDB($requetteSQL, $prepare);
    $dataUser->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Faction enregistrée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
