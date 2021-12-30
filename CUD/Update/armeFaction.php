<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
$SQL = ["UPDATE `armes` SET `fixer`= 1 WHERE `idArmes` = :idArmes", "UPDATE `armes` SET `fixer`= 0 WHERE `idArmes` = :idArmes"];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $_POST = doublePOP($_POST, $idNav);
    $preparation = new Preparation();
    $prepare = $preparation->creationPrep($_POST);
    $requetteSQL = "UPDATE `armes` SET `id_Faction`= :id_Faction WHERE `idArmes` = :idArmes";
    $action = new CurDB($requetteSQL, $prepare);
    $action->actionDB();
    header('location:../../index.php?idNav='.$idNav.'&message=Arme affecté.');
} else {
    header('location:../../index.php?message=Erreur de traitement.');
}
