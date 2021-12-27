<?php
// Créer une liste des univers de l'utilisateur
require 'objets/univers.php';
$univers = new Univers ($_SESSION['idUser']);
 ?>
  <ul>
  <?php $univers->listeUnivers(); ?>
  </ul>
