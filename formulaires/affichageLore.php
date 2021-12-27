<?php
include 'securite/securiterUtilisateur.php';
require 'objets/lore.php';
$idLore = filter($_GET['idLore']);
$lore = new Lore($idLore);
 ?>
<article class="">
  <?php $lore->readLore(); ?>
</article>
<article class="">
  <?php $lore->modLore($idNav); ?>
</article>
