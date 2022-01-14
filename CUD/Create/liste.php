<?php
session_start();
include '../../securite/securiterUtilisateur.php';
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$FU = filter($_POST['FU']);
$FU = str_getcsv($FU, ',');
$U = $FU[0];
$F = $FU[1];
$_POST = doublePOP($_POST, $idNav);
$ok = champsVide($_POST);
if ($ok > 0) {
  header('location:../../index.php?message=Un champs est vide.');
} else {
$prep = [['prep'=>':id_Univers', 'variable'=>$U],
        ['prep'=>':id_Faction', 'variable'=>$F],
        ['prep'=>':nomListe', 'variable'=>filter($_POST['nomListe'])],
        ['prep'=>':partager', 'variable'=>filter($_POST['partager'])],
        ['prep'=>':idUser', 'variable'=>$_SESSION['idUser']]];
$sql = "INSERT INTO `listeArmee`(`id_Univers`, `id_Faction`, `nomListe`, `partager`, `valide`, `idUser`) VALUES (:id_Univers, :id_Faction, :nomListe, :partager, 1, :idUser)";
$action = new CurDB($sql, $prep);
$action->actionDB();

  header('location:../../index.php?idNav='.$idNav.'&message=Liste enregistrée.');
}

} else {
    header('location:../../index.php?message=Erreur de traitement.');
}

 ?>
