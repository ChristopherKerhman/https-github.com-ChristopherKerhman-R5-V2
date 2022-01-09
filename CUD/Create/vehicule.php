<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $_POST = doublePOP($_POST, $idNav);
  $ok = champsVide($_POST);
  if ($ok > 0) {
  header('location:../../index.php?idNav='.$idNav.'&message=Un champs est vide.');
  }
   else {
     $prep = new Preparation ();
     $prepare = $prep->creationPrepIdUser($_POST);
     $requetteSQL = "INSERT INTO `transport`(`nomVehicule`, `description`, `typeVehicule`, `roleVehicule`, `tailleVehicule`,
       `equipage`, `passage`, `vol`, `stationnaire`, `DQM`, `DC`, `pds`, `svgVehicule`, `deplacement`, `idUser`)
       VALUES (:nomVehicule, :description, :typeVehicule, :roleVehicule, :tailleVehicule,
         :equipage, :passage, :vol, :stationnaire, :DQM, :DC, :pds, :svgVehicule, :deplacement, :idUser)";
     $action = new CurDB ($requetteSQL, $prepare);
     $action->actionDB();

  header('location:../../index.php?idNav='.$idNav.'&message=Vehicule '.filter($_POST['nomVehicule']).' enregistré.');
  }

} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
