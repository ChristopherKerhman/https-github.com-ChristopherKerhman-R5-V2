<?php
session_start();
include 'securite/securiterUtilisateur.php';
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
require '../../objets/preparationRequette.php';
require '../../objets/figurines.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idFigurine = filter($_POST['idFigurine']);
  $idNav = filter($_POST['idNav']);
  print_r($_POST);
  $prixFigurine = new Figurines($_SESSION['idUser'], $idNav);
  $prixFinal = $prixFigurine->calculPrixFigurine($idFigurine);
  $prepare = [['prep'=>':idFigurine', 'variable'=>$idFigurine],
            ['prep'=>':prixFinal', 'variable'=>$prixFinal]];
  $record = "UPDATE `figurines`
  SET `liste`=1,`prixFinal`= :prixFinal WHERE `idFigurine` = :idFigurine";
  $action = new CurDB($record, $prepare);
  $action->actionDB();
  header('location:../../index.php?message=Figurine bonne pour le service.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}


 ?>
