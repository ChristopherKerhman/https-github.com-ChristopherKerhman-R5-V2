<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
include '../fonctionsDB.php';
$requette = ["INSERT INTO `compositionListe`(`id_Liste`, `id_Figurine`, `nbr`, `prixTotal`) VALUES (:id_Liste, :id, :nbr, :prixTotal)",
"INSERT INTO `compositionListe`(`id_Liste`,`id_Vehicule`, `nbr`, `prixTotal`) VALUES (:id_Liste,:id, :nbr, :prixTotal)"];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $nbr = filter($_POST['nbr']);
  $idListe = filter($_POST['id_Liste']);
  if (isset($_POST['id_Figurine'])) {
    $SQL = $requette[0];
    $id = filter($_POST['id_Figurine']);
    // Recherche prix figurine
    $SQLprix = "SELECT `prixFinal` FROM `figurines` WHERE `idFigurine` = :id AND `id_User` = :idUser";
    $param = [['prep'=> ':id', 'variable'=> $id], ['prep'=> ':idUser', 'variable'=> $_SESSION['idUser']]];
    $prix = new readDB($SQLprix, $param);
    $prixElement = $prix->read();
    $prix = $prixElement[0]['prixFinal'];
  } else {
    $SQL = $requette[1];
    $id = filter($_POST['id_Vehicule']);
    // recherche prix véhicule
    $SQLprix = "SELECT `prixVehicule` FROM `transport` WHERE `idVehicule` = :id AND `idUser` = :idUser";
    $param = [['prep'=> ':id', 'variable'=> $id], ['prep'=> ':idUser', 'variable'=> $_SESSION['idUser']]];
    $prix = new readDB($SQLprix, $param);
    $prixElement = $prix->read();
    $prix = $prixElement[0]['prixVehicule'];
  }
$preparation = [['prep'=>':id_Liste', 'variable'=>  $idListe],
                ['prep'=> ':id', 'variable'=> $id],
                ['prep'=>':nbr', 'variable'=> $nbr],
                ['prep'=> ':prixTotal', 'variable'=> $prix * $nbr]];
              /*  print_r($SQL);
                echo '<br />';
                print_r($preparation);*/
$create = new CurDB($SQL, $preparation);
$create->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&idListe='.$idListe.'');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
