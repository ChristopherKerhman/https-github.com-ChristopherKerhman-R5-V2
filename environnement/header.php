<?php
session_start();
$titre = "R5";
$sousTitre = "Le jeu d'escarmouches multivers";
include 'CUD/fonctionsDB.php';
$vueJSCDN = 'node_modules/vue/dist/vue.global.prod.js';
require 'objets/paramDB.php';
require 'objets/readDB.php';
// Préparation de la requette :
// Mutliple menu selon la connexion
if (!isset($_SESSION['role'])) {
  // Menu visiteur non connecter
  $requetteSQL = "SELECT `idNav`, `nomLien`, `cheminNav`, `valide`, `levelAdmi`
  FROM `nav`
  WHERE `valide` = 1 AND `levelAdmi` = :levelAdmi AND `centrale` = 0
  ORDER BY `ordre` DESC";
  $prepare = [['prep'=> ':levelAdmi', 'variable' => 0]];
} else {
  $requetteSQL = "SELECT `idNav`, `nomLien`, `cheminNav`, `valide`, `levelAdmi`
  FROM `nav`
  WHERE `valide` = 1 AND `levelAdmi` = :levelAdmi AND `centrale` = 0
  ORDER BY `ordre` ASC";
  $prepare = [['prep'=> ':levelAdmi', 'variable' => $_SESSION['role']]];
}
$readNav = new readDB($requetteSQL, $prepare);
$dataNav = $readNav->read();
$idNav = $dataNav[0]['idNav'];
//header('Content-Type: text/html');
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="boardgame, jeu d'escarmouche, figurines, 28mm">
    <link rel="stylesheet" href="css/master.css">
    <script src="<?php echo $vueJSCDN; ?>"></script>
    <title><?=$titre?></title>
  </head>
  <body>
  <header>
    <div id="titrePrincipal">
      <h1 class="titre"><?=$titre?></h1>
        <h2 class="sousTitre"><?=$sousTitre?></h2>
  </div>
  <nav>
    <ul class="flex-center">
      <li><a href="bibliotheque/R5-V2-2022.zip">Obtenir R5</a></li>
      <li><div id="BACK"><a v-on:click="backTo"><<</a></div></li>
      <?php
        foreach ($dataNav as $key) {
          echo '<li><a href="index.php?idNav='.$key['idNav'].'">'.$key['nomLien'].'</a></li>';
        }
       ?>
    </ul>
  </nav>
  <?php if(isset($_GET['message'])){ echo '<h3 class="titreArticle">'.filter($_GET['message']).'</h3>'; } ?>
  </header>
  <main>
    <section>
