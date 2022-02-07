<?php
session_start();
include '../../securite/securiterCreateur.php';
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idTexte = filter($_POST['idTexte']);
  $titre = filter($_POST['titre']);
  $texte = filterTexte($_POST['texte']);
  $valide = filter($_POST['valide']);
  $idUser = $_SESSION['idUser'];
  $prepare = [['prep'=>':titre', 'variable'=>$titre],
['prep'=>':texte', 'variable'=>$texte],
['prep'=>':valide', 'variable'=>$valide],
['prep'=>':idUser', 'variable'=>$idUser],
['prep'=>':idTexte', 'variable'=>$idTexte],];
  $requetteSQL = "UPDATE `texteIndex` SET `titre`=:titre,`texte`=:texte,`valide`= :valide, `id_User` = :idUser WHERE `idTexte` = :idTexte";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&idTexte='.filter($_POST['idTexte']).'&message=Texte modifié.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
