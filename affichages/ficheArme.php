<?php
include 'securite/securiterUtilisateur.php';
require 'objets/armes.php';
require 'objets/rulesSp.php';
$idArmes = filter($_GET['idArmes']);
$ficheArmes = new Armes ($_SESSION['idUser'], $idNav);
$puissanceArme = $ficheArmes->valeurArmes($idArmes);
$dataFiche = $ficheArmes->ficheArme($idArmes, $puissanceArme);
$ficheArmes->specialRulesFicheArmes($idArmes);
$puissanceArme = $ficheArmes->valeurArmes($idArmes);
 ?>