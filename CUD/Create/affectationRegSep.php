<?php
session_start();
include 'securite/securiterUtilisateur.php';
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
$SQLcollection = ["INSERT INTO `armesRules`(`id_Armes`, `id_Rules`, `tauxRules`) VALUES (:id, :idRules, :modification)",
"INSERT INTO `figurinesRules`(`id_Figurine`, `id_Rules`, `modificateur`) VALUES (:id, :idRules, :modification)",
"INSERT INTO `vehiculeRules`( `id_Vehicule`, `id_Rules`, `modificateur`) VALUES (:id, :idRules, :modification)"];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // param Navigation
  $idNav = filter($_POST['idNav']);
  $id = filter($_POST['id']);
  $type = filter($_POST['type']);
  $Nav = ['location:../../index.php?idNav='.$idNav.'&message=Règles spécial enregistré.&idArmes='.$id.'',
'location:../../index.php?idNav='.$idNav.'&message=Règles spécial enregistré.&idFigurine='.$id.'',
'location:../../index.php?idNav='.$idNav.'&message=Règles spécial enregistré.&idVehicule='.$id.''];
  // Fin param navigation
  $idRules = filter($_POST['idRules']);
  // collecter donnée de modification
  $SQL = "SELECT `modification` FROM `rules` WHERE `idRules` = :idRules";
  $param = [['prep'=>':idRules', 'variable'=>$idRules]];
  $read = new readDB($SQL, $param);
  $dataMod = $read->read();
  //Enregistrement des données dans la base.
  $requetteSQL = $SQLcollection[$type];
  $prepare = [['prep'=> ':id', 'variable'=>$id], ['prep'=> ':idRules', 'variable'=>$idRules],
  ['prep'=> ':modification', 'variable'=> $dataMod[0]['modification']]];
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header($Nav[$type]);
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}

 ?>
