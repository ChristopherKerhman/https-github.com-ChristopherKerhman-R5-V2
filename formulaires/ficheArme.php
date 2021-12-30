<?php
include 'securite/securiterUtilisateur.php';
require 'objets/armes.php';
require 'objets/rulesSp.php';
$idArmes = filter($_GET['idArmes']);
$ficheArmes = new Armes ($_SESSION['idUser'], $idNav);
$dataFiche = $ficheArmes->ficheArme($idArmes);
$ficheArmes->specialRulesFicheArmes($idArmes);
$liste = new Rules();
$dataRSArme = $liste->readRules(0);
$liste->affectation($dataRSArme, $idArmes, $idNav);

 ?>
