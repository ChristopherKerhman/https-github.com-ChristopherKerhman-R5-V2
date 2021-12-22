<?php
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
// Controle Formulaire en amont
$stop = 1;
$dataForm = [filter($_POST['mailSecurite']), filter($_POST['idUser'])];
  for ($i=0; $i < count($dataForm) ; $i++) {
    if (empty($dataForm[$i])) {
      $stop = 0;
    }
}
// Fin controle formulaire
if ($stop == 1) {
  $mail = filter($_POST['mailSecurite']);
  $idUser = filter($_POST['idUser']);
  $requetteSQL = "SELECT `login` FROM `users` WHERE `mailSecurite` = :mail";
  $prepare = [['prep'=> ':mail', 'variable' => $mail],];
  $controle = new readDB($requetteSQL, $prepare);
  $doublon = $controle->read();
  if (empty($doublon[0]['mailSecurite'])) {
    $requetteSQL = "UPDATE `users` SET `mailSecurite`= :mail, `universLibre` = 1 WHERE `idUser`= :idUser";
      $prepare = [['prep'=> ':idUser', 'variable' => $idUser],
        ['prep'=> ':mail', 'variable' => $mail]];
        $dataUser = new CurDB($requetteSQL, $prepare);
        $dataUser->actionDB();
      header('location:../../index.php?message=Mail de sécurité enregistré.');
  } else {
  header('location:../../index.php?message=Mail déjà utilisé.');
  }
  } else {
    header('location:../../index.php?message=Erreur de traitement.');
}
}

 ?>
