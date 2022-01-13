<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
require '../../objets/vehicules.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idVehicule =filter($_POST['idVehicule']);
$prix = new Vehicules($_SESSION['idUser'], 66);
$prixFinal = $prix->prixBrute($idVehicule);
$updateSQL ="UPDATE `transport` SET `fixer`=1,`prixVehicule`=:prix, `service` = 1 WHERE `idVehicule` = :idVehicule";
$param = [['prep'=> ':prix', 'variable'=> $prixFinal], ['prep'=> ':idVehicule', 'variable'=> $idVehicule]];
$action = new CurDB($updateSQL, $param);
$action->actionDB();

    // changer si besoin lors de la mise en ligne
    header('location:../../index.php?message=Véhicule mi en service&idNav=66.');
 } else {
    header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
