<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $nomUnivers = filter($_POST['nomUnivers']);
    $idUnivers = filter($_POST['idUnivers']);
    $partager = filter($_POST['partager']);
    $del = filter($_POST['del']);
    if ($del == 0) {
      $requetteSQL = "UPDATE `univers` SET `nomUnivers`=:nomUnivers ,`partager`=:partager
      WHERE `idUnivers` = :idUnivers";
      $prepare = [['prep'=> ':idUnivers', 'variable' => $idUnivers],
                  ['prep'=> ':nomUnivers', 'variable' => $nomUnivers],
                  ['prep'=> ':partager', 'variable' => $partager],];
      $message = 'Modification prise en compte.';
    } else {
      $requetteSQL = "DELETE FROM `univers` WHERE `idUnivers` = :idUnivers";
      $prepare = [['prep'=> ':idUnivers', 'variable' => $idUnivers]];
      $message = $nomUnivers.'est effacé.';
    }

    $Update = new CurDB($requetteSQL, $prepare);
    $Update->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message='.$message.'');
  } else {
    header('location:../../index.php?message=Erreur de traitement.');
  }
 ?>
