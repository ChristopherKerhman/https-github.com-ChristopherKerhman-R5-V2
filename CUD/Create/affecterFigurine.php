<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$_POST = doublePOP($_POST, $idNav);
$id_Faction = filter($_POST['id_Faction']);
$idFigurine = filter($_POST['idFigurine']);
// Aller chercher l'idUnivers correspondant
$sqlIdUnivers = "SELECT `idUnivers`FROM `factions` WHERE `idFaction` = :idFaction";
$preparation = [['prep' => ':idFaction', 'variable' => $id_Faction]];
$univers = new readDB($sqlIdUnivers, $preparation);
$idUnivers = $univers->read();
$idUnivers = $idUnivers[0]['idUnivers'];
// On enregistre les données dans la base
$requetteSQL = "INSERT INTO `AffecterFigurineUF`(`id_Univers`, `id_Faction`, `id_Figurine`)
VALUES (:id_Univers, :id_Faction, :id_Figurine);
UPDATE `figurines` SET `figurineAffecter`= 1 WHERE `idFigurine` = :id_Figurine";
$prepare = [['prep' => ':id_Univers', 'variable' => $idUnivers],
            ['prep' => ':id_Faction', 'variable' => $id_Faction],
            ['prep' => ':id_Figurine', 'variable' => $idFigurine]];
$action = new CurDB ($requetteSQL, $prepare);
$action->actionDB();
header('location:../../index.php?idNav='.$idNav.'&message=figurine affectée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
