<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
require '../../objets/armes.php';
require '../../objets/readDB.php';
include '../fonctionsDB.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $idVehicule = filter($_POST['idVehicule']);
    $FU = filter($_POST['FU']);
    $FU = str_getcsv($FU, ',');
    $U = $FU[0];
    $F = $FU[1];
    $requetteSQL = "UPDATE `transport`
    SET `id_univers`=:idUnivers,`id_faction`=:idFaction
    WHERE `idVehicule` = :idVehicule";
    // Sauvegarde de la valeur de l'arme lors du fixe de celle-ci ou on efface la valeur quand on defixe l'arme pour la modifier.
    $prepare = [['prep' => ':idVehicule', 'variable' => $idVehicule],
    ['prep' => ':idUnivers', 'variable' => $U],
    ['prep' => ':idFaction', 'variable' => $F],];
    $action = new CurDB($requetteSQL, $prepare);
    $action->actionDB();
    header('location:../../index.php?idNav='.$idNav.'&message=Véhicule affecter.');
} else {
    header('location:../../index.php?message=Erreur de traitement.');
}
