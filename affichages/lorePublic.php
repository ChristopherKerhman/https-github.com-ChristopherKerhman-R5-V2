<?php
require 'objets/lore.php';
$idLore = filter($_GET['idLore']);
$lore = new Lore($idLore);
$lore->readlore();
 ?>
