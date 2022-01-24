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
  <h3 v-if="cleW" id="top">Type de règle spéciales: {{type}} / {{titre}}</strong></h3>
  <p v-if="cleW"> <br />{{texteRS}}</p>
  <h3 class="sousTitre">Les règles spéciales Armes</h3>
  <div class="mosaique">
    <a class="lienRS" href="#top" class="item" v-for="Wap in regleW" v-bind:key="Wap" v-on:click="action(Wap)">{{Wap.nomRules}}</a>
  </div>

  <h3 class="sousTitre">Les règles spéciales Figurines</h3>
  <div class="mosaique">
    <a class="lienRS" href="#top" class="item" v-for="Fig in regleF" v-bind:key="Fig" v-on:click="action(Fig)">{{Fig.nomRules}}</a>
  </div>
  <h3 class="sousTitre">Les règles spéciales Véhicules</h3>
  <div class="mosaique">
    <a class="lienRS" href="#top" class="item" v-for="Veh in regleV" v-bind:key="Veh" v-on:click="action(Veh)">{{Veh.nomRules}}</a>
  </div>
</div>
<!--Traitement des éléments des règles spéciale-->
<script>
const RS = Vue.createApp({
  data () {
    return {
      cleW: false,
      regleW: <?php echo $dataRulesArmes; ?>,
      regleF: <?php echo $dataRulesFigurines; ?>,
      regleV: <?php echo $dataRulesVehicules; ?>,
      titre: '',
      type: '',
      texteRS: '',
      typeRSp: ['Armes', 'Figurines', 'Véhicules'],

    }
  },
  methods: {
    action($id) {
      // Fonction pour retirer les artefact lier à l'encodage JSON
      function sanitize ($data) {
        for (let i = 0; i < $data.length; i++) {
          $data = $data.replace('&quot;', ' ')
        }
        return $data
      }
      // stockage des données dans les variables pour affichage dans le DOM
        this.titre = $id['nomRules']
        this.titre = sanitize (this.titre)
        this.type = this.typeRSp[$id['typeRules']]
        this.type = sanitize (this.type)
        this.texteRS = $id['descriptionRules']
        this.texteRS = sanitize (this.texteRS)
        this.cleW = true
    }
  }
})
  RS.mount('#RS')
</script>
