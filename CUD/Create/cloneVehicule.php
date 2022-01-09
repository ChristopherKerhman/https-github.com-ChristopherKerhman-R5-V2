<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/readDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $id = filter($_POST['idVehicule']);
  $prepare = [['prep'=> ':id', 'variable' => $id]];
  $requetteSQL = "SELECT `nomVehicule`, `description`, `typeVehicule`, `roleVehicule`, `tailleVehicule`,
  `equipage`, `passage`, `vol`, `stationnaire`, `DQM`, `DC`, `pds`, `svgVehicule`, `deplacement`
  FROM `transport` WHERE `idVehicule`=:id";
  $action = new readDB($requetteSQL, $prepare);
  $dataClone = $action->read();
      $paramClone = array();
      for ($i=0; $i <count($dataClone) ; $i++) {
        foreach ($dataClone[$i] as $key => $value) {
          array_push($paramClone, ['prep' => ':'.$key, 'variable' => $value]);
        }
      }
array_push($paramClone, ['prep' => ':idUser', 'variable' => $_SESSION['idUser']]);
  $clone = "INSERT INTO `transport`(`nomVehicule`, `description`, `typeVehicule`, `roleVehicule`, `tailleVehicule`, `equipage`, `passage`, `vol`, `stationnaire`, `DQM`, `DC`, `pds`, `svgVehicule`, `deplacement`, `idUser`)
  VALUES (:nomVehicule, :description, :typeVehicule, :roleVehicule, :tailleVehicule, :equipage, :passage, :vol, :stationnaire, :DQM, :DC, :pds, :svgVehicule, :deplacement, :idUser)";
  $action = new CurDB ($clone, $paramClone);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Vehicule '.$dataClone[0]['nomVehicule'].' cloner.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
