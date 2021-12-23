<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $nomUnivers = filter($_POST['nomUnivers']);
  $idUser = $_SESSION['idUser'];
  $NTUnivers = filter($_POST['NTunivers']);
  $valide = 1;
  $_SESSION['univers'] = $_SESSION['univers'] - 1;
  $requetteSQL = "INSERT INTO `univers`(`idProprietaire`, `nomUnivers`, `NTUnivers`, `valide`)
  VALUES (:idProprietaire, :nomUnivers, :NTUnivers, :valide);
  UPDATE `users` SET `universLibre`= :nbrU WHERE `idUser`= :idProprietaire";

  $prepare = [['prep'=> ':idProprietaire', 'variable' => $idUser],
              ['prep'=> ':nomUnivers', 'variable' => $nomUnivers],
              ['prep'=> ':NTUnivers', 'variable' => $NTUnivers],
              ['prep'=> ':valide', 'variable' => $valide],
              ['prep'=> ':nbrU', 'variable' => $_SESSION['univers']]];
//print_r($prepare);
$record = new CurDB($requetteSQL, $prepare);
$record->actionDB();
header('location:../../index.php?idNav='.$idNav.'&message=Univers enregistré.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
