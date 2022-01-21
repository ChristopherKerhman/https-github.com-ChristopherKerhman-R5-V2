<?php
session_start();
require '../objets/paramDB.php';
require '../objets/cud.php';
require '../objets/readDB.php';
require '../objets/preparationRequette.php';
include '../CUD/fonctionsDB.php';
// Génération d'un token de sécurité
$token = NULL;
// fonction pour générer un token de
function brassege($token) {
  $alpha = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYS';
  $nbr = strlen($alpha);
  for ($i=0; $i < 5 ; $i++) {
    for ($k=0; $k <4 ; $k++) {
      $random = rand(1,$nbr);
      $token = $token.substr($alpha, $random, 1);
    }
}
return $token;
}
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $email = filter($_POST['mailSecurite']);
  if($email == '') {
    header('location:../index.php?idNav='.$idNav.'&message=Erreur de traitement.');
  } else {
    // Vérification de l'authenticité du mot de passe
    $requetteSQL = "SELECT `idUser` FROM `users` WHERE `mailSecurite` = :email";
    $param = [['prep'=>':email', 'variable'=> $email]];
    $readIdUser = new readDB($requetteSQL,$param);
    $dataIdUser = $readIdUser->read();
    $idUser = $dataIdUser[0]['idUser'];
    if ($idUser <= 0) {
      header('location:../index.php?idNav='.$idNav.'&message=Erreur de traitement.');
    } else {
      $token = brassege($token);
      // Enregistrement du token dans la DB
      $updateToken = "UPDATE `users` SET `token`=:token WHERE `idUser` = :idUser";
      $param =[['prep'=>':token', 'variable'=> $token], ['prep'=>':idUser', 'variable'=> $idUser]];
      $updateForToken = new CurDB($updateToken, $param);
      $updateForToken->actionDB();
      //print_r($token);
      // A activé quand le site sera en ligne
      /*$to = $email;
      $subject = 'Votre token de securite';
      $message = 'Token de securite :'.$token;
      $headers = 'From: aresh_e430@ludis-r5.fr';*/
      // A activé quand le site sera en ligne
      header('location:../index.php?idNav='.$idNav.'&message=Procédure enclenché.');
    }

  }

} else {
  header('location:../index.php?message=Erreur de traitement.');
}
 ?>
