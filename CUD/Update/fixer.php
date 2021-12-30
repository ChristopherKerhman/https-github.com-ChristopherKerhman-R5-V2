<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
$SQL = ["UPDATE `armes` SET `fixer`= 1 WHERE `idArmes` = :idArmes", "UPDATE `armes` SET `fixer`= 0 WHERE `idArmes` = :idArmes"];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $idArmes = filter($_POST['idArmes']);
    $prepare = [['prep' => ':idArmes', 'variable' => $idArmes]];
    $requetteSQL = $SQL[filter($_POST['fixer'])];
    $action = new CurDB($requetteSQL, $prepare);
    $action->actionDB();
    header('location:../../index.php?idNav='.$idNav.'&message=Arme fixée.');
} else {
    header('location:../../index.php?message=Erreur de traitement.');
}
