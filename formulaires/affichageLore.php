<?php
include 'securite/securiterUtilisateur.php';
require 'objets/lore.php';
$idLore = filter($_GET['idLore']);
$lore = new Lore($idLore);
$lore->readLore();
$lore->modLore($idNav);
?>
