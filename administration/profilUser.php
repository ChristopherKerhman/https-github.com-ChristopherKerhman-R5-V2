<?php
include 'administration/securite.php';
require 'objets/ficheUser.php';
require 'objets/ficheUserAdmin.php';
$idUser = filter($_GET['idUser']);
$idNav = filter($_GET['idNav']);
$requetteSQL = "SELECT `idUser`, `nom`, `prenom`, `login`, `valide`, `role`, `universLibre`, `mailSecurite`
FROM `users`
WHERE `idUser` = :idUser";
$prepare = [['prep'=> ':idUser', 'variable' => $idUser]];
$readUser = new readDB($requetteSQL, $prepare);
$dataUser = $readUser->read();
$ficheUser = new FicheUserAdmin($dataUser);
 ?>
 <div class="flex-ligne">
   <?php $ficheUser->fiche(); ?>
   <?php $ficheUser->modUserFicheAdmin($idNav); ?>
 </div>
