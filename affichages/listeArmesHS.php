<?php
include 'stockageData/figurine.php';
include 'securite/securiterUtilisateur.php';
require 'objets/figurines.php';
require 'objets/armes.php';
$listeArmesHS = new Armes ($_SESSION['idUser'], $idNav);
$listeArmesHS->listeArmesHS()
