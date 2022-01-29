<?php
session_start();
$vueJSCDN = 'node_modules/vue/dist/vue.global.prod.js';
require 'objets/rulesSp.php';
require 'objets/paramDB.php';
require 'objets/readDB.php';
include 'CUD/fonctionsDB.php';
include 'stockageData/typeRules.php';
$type = filter($_GET['type']);
$reglesSpeciales = new Rules();
$dataRulesSP = $reglesSpeciales->readRules($type);
$titre = 'Règle spéciale '.$typeRules[$type];
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="boardgame, jeu d'escarmouche, figurines, 28mm">
    <link rel="stylesheet" href="css/master.css">
      <script src="<?php echo $vueJSCDN; ?>"></script>
    <title>R5 - <?=$titre?></title>
  </head>
  <body>
    <section class="listeBlanche">
        <h1 class="titre">R5</h1>
        <h2 class="sousTitre"><?=$titre?></h2>
        <div id="BACK"><a class="lienImpression" v-on:click="backTo"> << retour </a></div>
           <article class="listeBlanche">
             <?php $reglesSpeciales->affichageRules($dataRulesSP); ?>
          </article>
    </section>
    <?php include 'javascript/back.php'; ?>
  </body>
</html>
