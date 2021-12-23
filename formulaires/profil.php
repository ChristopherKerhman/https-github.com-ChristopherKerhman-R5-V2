<?php
$idUser = $_SESSION['idUser'];
$requetteSQL = "SELECT `idUser`, `nom`, `prenom`, `login`, `valide`, `role`, `universLibre`, `mailSecurite`
FROM `users`
WHERE `idUser` = :idUser";
$parametreUser = [['prep'=> ':idUser', 'variable' => $idUser]];
$readFicheUser = new readDB($requetteSQL, $parametreUser);
$dataUser = $readFicheUser->read();
require 'objets/ficheUser.php';
$affichage = new ficheUser ($dataUser);
?>
<h4 class="sousTitre">Profil de <?=$dataUser[0]['login']?></h4>
<div class="flex-ligne">
  <?php $affichage->fiche(); ?>
  <?php $affichage->modUserFiche(); ?>
  <?php
    if ($dataUser[0]['mailSecurite'] === NULL) {
      $affichage->mailSecurite($idUser);
    }
   ?>
</div>
