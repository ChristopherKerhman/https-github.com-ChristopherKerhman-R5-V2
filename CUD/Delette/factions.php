<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idFaction = filter($_POST['idFaction']);
  $prepare = [['prep'=> ':idUser', 'variable' => $_SESSION['idUser']],
              ['prep'=> ':idFaction', 'variable' => $idFaction]];
  $requetteSQL = "DELETE FROM `factions`
  WHERE `idFaction` = :idFaction AND `idCreateur` = :idUser";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Faction effacée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
