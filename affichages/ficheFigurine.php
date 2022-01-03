<?php
include 'stockageData/figurine.php';
include 'securite/securiterUtilisateur.php';
require 'objets/figurines.php';
  $idFigurine = filter($_GET['idFigurine']);
  $figurine = new Figurines ($_SESSION['idUser'], $idNav);
  $dataFiche = $figurine->readFiche($idFigurine);
  $figurine->ficheFigurine($dataFiche);
?>
