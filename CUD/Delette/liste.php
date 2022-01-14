<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $id = filter($_POST['idListe']);
    $delSQL = "DELETE FROM `listeArmee` WHERE `idListe` = :id AND `idUser` = :idUser";
    $prepare = [['prep'=> ':id', 'variable' => $id],['prep'=> ':idUser', 'variable' => $_SESSION['idUser']]];
    $action = new CurDB($delSQL, $prepare);
    $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Liste effacée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
