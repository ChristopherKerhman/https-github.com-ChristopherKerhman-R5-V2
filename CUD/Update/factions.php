<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idFaction = filter($_POST['idFaction']);
  $nomFaction = filter($_POST['nomFaction']);
  $partager = filter($_POST['partager']);
  $prepare = [['prep'=> ':idUser', 'variable' => $_SESSION['idUser']],
              ['prep'=> ':idFaction', 'variable' => $idFaction],
              ['prep'=> ':nomFaction', 'variable' => $nomFaction],
              ['prep'=> ':partager', 'variable' => $partager]];
  $requetteSQL = "UPDATE `factions` SET `nomFaction`= :nomFaction,`partager`=:partager
  WHERE `idFaction` = :idFaction AND `idCreateur` = :idUser";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Faction modifée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
