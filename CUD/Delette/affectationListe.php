<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $idListe = filter($_POST['id_Liste']);
    $id = filter($_POST['idComposition']);
    $delSQL = "DELETE FROM `compositionListe` WHERE `idComposition` = :id AND `id_Liste` = :idListe";
    $prepare = [['prep'=> ':id', 'variable' => $id], ['prep'=> ':idListe', 'variable' => $idListe]];
    $action = new CurDB($delSQL, $prepare);
    $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Liste effacée&idListe='.$idListe);
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
