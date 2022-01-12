<?php
  include 'securite/securiterUtilisateur.php';
  require 'objets/armes.php';
  $listeArmes = new Armes ($_SESSION['idUser'], $idNav);
?>
<h3 class="sousTitre">Liste des armes sans faction</h3>
<ul>
  <?php $listeArmes->sansFactions(); ?>
</ul>
<h3 class="sousTitre">Liste des armes avec faction</h3>
<ul>
<?php $listeArmes->avecFactions(); ?>
</ul>
