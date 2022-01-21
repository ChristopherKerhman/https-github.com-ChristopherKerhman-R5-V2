<?php
session_start();
require '../objets/paramDB.php';
require '../objets/cud.php';
require '../objets/readDB.php';
require '../objets/preparationRequette.php';
include '../CUD/fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $_POST = doublePOP($_POST, $idNav);
  $token = filter($_POST['token']);
  $ok = champsVide($_POST);
  $tokenVerify = "SELECT `token`, `idUser` FROM `users` WHERE `token` = :token";
  $preparation = [['prep'=>':token', 'variable'=>$token]];
  $readToken = new readDB($tokenVerify, $preparation);
  $dataUser = $readToken->read();
  $tokenDB = $dataUser[0]['token'];
  $idUser = $dataUser[0]['idUser'];
  if (($ok === 1)||(strlen($token) != 20)||($tokenDB != $token)) {
        header('location:../index.php?message=Erreur de traitement.');
  } else {
    $moria = filter($_POST['mdp']);
    $mdp = haschage($moria);
    $param =[['prep'=>':mdp', 'variable'=>$mdp], ['prep'=>':idUser', 'variable'=>$idUser]];
    $updateMDP = "UPDATE `users` SET `mdp`=:mdp, `token`= 0 WHERE `idUser` = :idUser";
    $dataUser = new CurDB($updateMDP, $param);
    $dataUser->actionDB();
     header('location:../index.php?message=Mot de passe changé.');
  }

} else {
  header('location:../index.php?message=Erreur de traitement.');
}

//kbh47TqRbyvv2l16TXWQ
 ?>
