<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idVehicule = filter($_POST['idVehicule']);
  $_POST = doublePOP($_POST, $idNav);
  $ok = champsVide($_POST);
  if ($ok > 0) {
  header('location:../../index.php?idNav='.$idNav.'&message=Un champs est vide.');
  }
   else {
     $prep = new Preparation ();
     $prepare = $prep->creationPrepIdUser($_POST);
     $requetteSQL = "UPDATE `transport` SET `nomVehicule`=:nomVehicule,`description`=:description,`typeVehicule`=:typeVehicule,`roleVehicule`=:roleVehicule,
     `tailleVehicule`=:tailleVehicule,`equipage`=:equipage,`passage`=:passage,`vol`=:vol,`stationnaire`=:stationnaire,
     `DQM`=:DQM,`DC`=:DC,`pds`=:pds,`svgVehicule`=:svgVehicule,`deplacement`=:deplacement WHERE `idVehicule`= :idVehicule AND `idUser` = :idUser";
     $action = new CurDB ($requetteSQL, $prepare);
     $action->actionDB();

  header('location:../../index.php?idNav='.$idNav.'&message=Vehicule '.filter($_POST['nomVehicule']).' modifié.&idVehicule='.$idVehicule.'');
  }

} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
