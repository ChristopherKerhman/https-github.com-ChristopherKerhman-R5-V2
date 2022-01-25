<?php
require 'objets/rulesSp.php';
$reglesSpeciales = new Rules();
$dataRulesArmes = $reglesSpeciales->readRules(0);
$dataRulesFigurines = $reglesSpeciales->readRules(1);
$dataRulesVehicules = $reglesSpeciales->readRules(2);
// Conversion en JSON des données des règles spéciales
$dataRulesArmes = json_encode($dataRulesArmes);
$dataRulesFigurines = json_encode($dataRulesFigurines);
$dataRulesVehicules = json_encode($dataRulesVehicules);
 ?>

<div id="RS">
    <!--Debut Présentation en fenêtre-->
<div class="dialogue" v-if="cleW" class="overlay">
  <h3 id="top">{{titre}}</strong></h3>
  <button id="placeButton" type="button" name="button" v-on:click="cleW = false">X</button>
    <h4 id="">{{type}}</h4>
  <p>{{texteRS}}</p>
</div>
  <!--Fin Présentation en fenêtre-->
  <h3 class="sousTitre">Les règles spéciales Armes</h3>
  <div class="mosaique">
    <a class="lienRS" v-for="Wap in regleW" v-bind:key="Wap" v-on:click="action(Wap)">{{Wap.nomRules}}</a>
  </div>

  <h3 class="sousTitre">Les règles spéciales Figurines</h3>
  <div class="mosaique">
    <a class="lienRS" class="item" v-for="Fig in regleF" v-bind:key="Fig" v-on:click="action(Fig)">{{Fig.nomRules}}</a>
  </div>
  <h3 class="sousTitre">Les règles spéciales Véhicules</h3>
  <div class="mosaique">
    <a class="lienRS" class="item" v-for="Veh in regleV" v-bind:key="Veh" v-on:click="action(Veh)">{{Veh.nomRules}}</a>
  </div>
</div>
<!--Traitement des éléments des règles spéciale-->
<?php include 'javascript/regleSpeciales.php'; ?>
