<input type="hidden" name="idFigurine" value="'.$data[0]['idFigurine'].'">
<input type="hidden" name="prix" value="'.$prixFigurine.'">
<input type="hidden" name="idNav" value="'.$idNav.'">

<?php session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idFigurine = filter($_POST['idFigurine']);
  $_POST = doublePOP($_POST, $idNav);
  $prep = new Preparation ();
  $prepare = $prep->creationPrep($_POST);
  $service = "UPDATE `figurines` SET `figurineFixer`= 1, `prix`= :prix WHERE `idFigurine` = :idFigurine";
  $action = new CurDB($service, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Figurine mise en service&idFigurine='.$idFigurine.'');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}



?>
