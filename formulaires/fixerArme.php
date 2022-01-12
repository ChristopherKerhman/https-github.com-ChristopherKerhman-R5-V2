<?php
  include 'securite/securiterUtilisateur.php';
  require 'objets/armes.php';
  $listeArmes = new Armes ($_SESSION['idUser'], $idNav);
?>
<h3 class="sousTitre">Liste des armes non fixé</h3>
<ul>
  <?php $listeArmes->listeArmes(0); ?>
</ul>
<h3 class="sousTitre">Liste des armes fixé</h3>
<ul>
  <?php $listeArmes->listeArmes(1); ?>
</ul>
