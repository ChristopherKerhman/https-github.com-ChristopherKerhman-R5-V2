<?php
include 'securite/securiterUtilisateur.php';
require 'objets/lienCentrale.php';
$role = $_SESSION['role'];
$centrale = 2;
$LienCentrale = new LienCentrale($role, $centrale, $idNav);
$dataNav = $LienCentrale->NavCentrale();
 ?>
<h3 class="sousTitre">Gestion Univers</h3>

  <ul>
    <?php
    $LienCentrale->affichageLien($dataNav);
     ?>
  </ul>
