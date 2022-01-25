<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idArme = filter($_POST['idArmes']);
  $_POST = doublePOP($_POST, $idNav);
  $param = [['prep'=>'idArmes', 'variable'=>$idArme]];
  $getArme = "SELECT `id_Univers`, `id_Faction`, `idCreateur`, `nom`, `description`, `typeArme`,
  `puissance`, `maxRange`, `surPuissance`, `sort`, `assaut`, `couverture`, `cadenceTir`, `lourd`,
  `puissanceExplosif`, `gabarit`, `fixer`, `valide`, `prix`
  FROM `armes` WHERE `idArmes` = :idArmes";
$readArmes = new readDB($getArme, $param);
$dataArme = $readArmes->read();
$param = [['prep'=>':id_Univers', 'variable'=>$dataArme[0]['id_Univers']],
  ['prep'=>':id_Faction', 'variable'=>$dataArme[0]['id_Faction']],
  ['prep'=>':idCreateur', 'variable'=>$dataArme[0]['idCreateur']],
  ['prep'=>':nom', 'variable'=>$dataArme[0]['nom']],
  ['prep'=>':description', 'variable'=>$dataArme[0]['description']],
  ['prep'=>':typeArme', 'variable'=>$dataArme[0]['typeArme']],
  ['prep'=>':puissance', 'variable'=>$dataArme[0]['puissance']],
  ['prep'=>':maxRange', 'variable'=>$dataArme[0]['maxRange']],
  ['prep'=>':surPuissance', 'variable'=>$dataArme[0]['surPuissance']],
  ['prep'=>':sort', 'variable'=>$dataArme[0]['sort']],
  ['prep'=>':assaut', 'variable'=>$dataArme[0]['assaut']],
  ['prep'=>':couverture', 'variable'=>$dataArme[0]['couverture']],
  ['prep'=>':cadenceTir', 'variable'=>$dataArme[0]['cadenceTir']],
  ['prep'=>':lourd', 'variable'=>$dataArme[0]['lourd']],
  ['prep'=>':puissanceExplosif', 'variable'=>$dataArme[0]['puissanceExplosif']],
  ['prep'=>':gabarit', 'variable'=>$dataArme[0]['gabarit']],
  ['prep'=>':fixer', 'variable'=>$dataArme[0]['fixer']],
  ['prep'=>':valide', 'variable'=>$dataArme[0]['valide']],
  ['prep'=>':prix', 'variable'=>$dataArme[0]['prix']]];
  //Copie de l'arme
  $requetteSQL = "INSERT INTO `armes`(`id_Univers`, `id_Faction`, `idCreateur`, `nom`, `description`, `typeArme`, `puissance`,
    `maxRange`, `surPuissance`, `sort`, `assaut`, `couverture`, `cadenceTir`, `lourd`, `puissanceExplosif`, `gabarit`,
    `fixer`, `valide`, `prix`) VALUES (
:id_Univers, :id_Faction, :idCreateur, :nom, :description, :typeArme, :puissance, :maxRange,
:surPuissance, :sort, :assaut, :couverture, :cadenceTir, :lourd, :puissanceExplosif, :gabarit, :fixer, :valide, :prix)";
  $action = new CurDB ($requetteSQL, $param);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Arme clonée.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
