<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
require '../../objets/armes.php';
require '../../objets/readDB.php';
include '../fonctionsDB.php';
$SQL = ["UPDATE `armes` SET `fixer`= 1, `prix`=:prix WHERE `idArmes` = :idArmes", "UPDATE `armes` SET `fixer`= 0, `prix`=:prix  WHERE `idArmes` = :idArmes"];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $idArmes = filter($_POST['idArmes']);
    $requetteSQL = $SQL[filter($_POST['fixer'])];
    // Sauvegarde de la valeur de l'arme lors du fixe de celle-ci ou on efface la valeur quand on defixe l'arme pour la modifier.
    if (filter($_POST['fixer']) == 0) {
      $dataprice = new Armes ($_SESSION['idUser'],$idNav);
      $prix = $dataprice->valeurArmes($idArmes);
      $prepare = [['prep' => ':idArmes', 'variable' => $idArmes],
                  ['prep' => ':prix', 'variable' => $prix]];
    } else {
      $prepare = [['prep' => ':idArmes', 'variable' => $idArmes],
                  ['prep' => ':prix', 'variable' => 0]];
    }
    $action = new CurDB($requetteSQL, $prepare);
    $action->actionDB();
    header('location:../../index.php?message=Arme fixée.');
} else {
    header('location:../../index.php?message=Erreur de traitement.');
}
