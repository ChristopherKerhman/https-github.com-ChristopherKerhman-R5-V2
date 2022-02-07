<?php
session_start();
include '../../securite/securiterCreateur.php';
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $valide = filter($_POST['valide']);
  $titre = filter($_POST['titre']);
  $texte = filterTexte($_POST['texte']);
  $prepare = [['prep'=>':idUser', 'variable'=> $_SESSION['idUser']],
                  ['prep'=>':titre', 'variable'=> $titre],
                  ['prep'=>':texte', 'variable'=> $texte],
                  ['prep'=>':valide', 'variable'=> $valide]];
  $requetteSQL = "INSERT INTO `texteIndex`(`id_User`, `titre`, `texte`, `valide`) VALUES (:idUser, :titre, :texte, :valide)";
  $action = new CurDB($requetteSQL, $prepare);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Texte enregistré.');
} else {
header('location:../../index.php?message=Erreur de traitement.');
}
 ?>
