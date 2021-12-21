<?php
session_start();
if ($_SESSION['role'] != 3) {
  header('location:https://www.google.com/');
} else {
  require '../../objets/paramDB.php';
  require '../../objets/cud.php';
  require '../../objets/readDB.php';
  include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nomLien = filter($_POST['nomLien']);
  $cheminNav = filter($_POST['cheminNav']);
  $levelAdmi = filter($_POST['levelAdmi']);
  $ordre = filter($_POST['ordre']);
  $centrale = filter($_POST['centrale']);
  $classement = filter($_POST['classement']);
  $idNav = filter($_POST['idNavigation']);
  $requetteSQL = "INSERT INTO `nav`(`nomLien`, `cheminNav`, `levelAdmi`, `ordre`, `centrale`, `classement`)
  VALUES (:nomLien, :cheminNav, :levelAdmi, :ordre, :centrale, :classement)";
    $prepare = [
      ['prep'=> ':nomLien', 'variable' => $nomLien],
      ['prep'=> ':cheminNav', 'variable' => $cheminNav],
      ['prep'=> ':levelAdmi', 'variable' => $levelAdmi],
      ['prep'=> ':ordre', 'variable' => $ordre],
      ['prep'=> ':centrale', 'variable' => $centrale],
      ['prep'=> ':classement', 'variable' => $classement],
  ];
  $creatLien = new CurDB($requetteSQL, $prepare);
  $creatLien->actionDB();
  header('location:../../index.php?idNav='.$idNav.' & message=Menu '.$nomLien.' enregistré');
  } else {
  header('location:../../index.php?message=Erreur');
  }
}
