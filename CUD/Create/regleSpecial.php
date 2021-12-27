<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$_POST = doublePOP($_POST);
$preparation = new Preparation();
$prepare = $preparation->creationPrep($_POST);
$requetteSQL = "INSERT INTO `rules`( `nomRules`, `descriptionRules`, `modification`, `typeRules`)
VALUES (:nomRules, :descriptionRules, :modification, :typeRules)";
$action = new CurDB ($requetteSQL, $prepare);
$action->actionDB();
header('location:../../index.php?idNav='.$idNav.'&message=Nouvelle règle spéciale enregistrée.');
} else {
header('location:../../index.php?message=Erreur de traitement.');
}
