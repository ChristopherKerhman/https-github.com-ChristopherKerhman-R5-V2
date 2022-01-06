<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
$SQL = ["INSERT INTO `armes`( `id_Univers`,`nom`, `description`, `typeArme`, `puissance`, `surPuissance`, `sort`, `idCreateur`)
  VALUES (:id_Univers, :nom, :description, :typeArme, :puissance, :surPuissance, :sort , :idUser)",
  "INSERT INTO `armes`(`id_Univers`, `nom`, `description`, `typeArme`, `puissance`, `maxRange` ,`surPuissance`, `sort`, `assaut`, `couverture`, `cadenceTir`, `lourd`, `idCreateur`)
  VALUES (:id_Univers, :nom, :description, :typeArme, :puissance, :maxRange, :surPuissance, :sort, :assaut, :couverture, :cadenceTir, :lourd, :idUser)",
  "INSERT INTO `armes`(`id_Univers`, `nom`, `description`, `typeArme`, `puissance`, `maxRange`, `surPuissance`, `sort`, `assaut`, `couverture`, `cadenceTir`, `lourd`, `puissanceExplosif`, `gabarit`, `idCreateur`)
  VALUES (:id_Univers, :nom, :description, :typeArme, :puissance, :maxRange, :surPuissance, :sort, :assaut, :couverture, :cadenceTir, :lourd, :puissanceExplosif, :gabarit, :idUser)"];
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
  $requetteSQL = $SQL[filter($_POST['typeArme'])];
  $action = new CurDB ($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Arme '.filter($_POST['nom']).' enregistrée.');}
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
