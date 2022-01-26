<div id="ADJ">
  <nav>
    <div class="mosaique">
      <a class="lienRS" v-for="cle in menu" v-bind:key="cle" v-on:click="cle.param = true">{{cle.data}}</a>
    </div>
</nav>
<div class="dialogueADJ" v-if="menu[0]['param']" class="overlay">
  <h4 class="sousTitre">{{menu[0]['data']}}</h4>
  <ul>
    <li><strong>Début du tour</strong></li>
    <li><strong>Phase d'initiative :</strong> Le plus haut de jet de DQM entre les deux camps obtient l'initiative.</li>
    <li><strong>Phase de contact :</strong> Résolution de tous les statuts "contact".</li>
    <li><strong>Phase d'ordre :</strong> Chaque camps active ces unités les unes après les autres en alternance.</li>
    <li><strong>Phase de regroupement :</strong> Une fois toute les unités activées, on test si les unités en statut "Tête baissée" le reste, un jet de DQM difficulté 4 permet d'éliminer le statut "tête baissée".</li>
    <li><strong>Fin du tour</strong></li>
  </ul>
    <button id="placeButton" type="button" name="button" v-on:click="menu[0]['param'] = false">X</button>
</div>
<div class="dialogueADJ" v-if="menu[1]['param']" class="overlay">
    <h4 class="sousTitre">{{menu[1]['data']}}</h4>
    <ul>
      <li>1 : Vérifier la ligne de vue.</li>
      <li>2 : Si 3 couverts sont entre le tireur et la cible, celle-ci est invisible. Aucun tir n'est possible.</li>
      <li>3 : Vérifier la portée de l'arme, si elle ne peut pas atteindre la cible, le tir est impossible. (voir règles optionnel)</li>
      <li>4 : Si la cible est dans la zone de portée l'arme, elle peut toucher.</li>
      <li>5 : Caclucler la difficulté de tir.</li>
      <li>6 : La cible effectue le jet de sauvegard, si il réussi, la cible n'est pas hors combat. Sinon, perte de 1 point de vie. Les cible à 0 point de vie sont retiré du jeu immédiatement. Elles sont hors combat.</li>
      <li>7 : Plus de trois touches sans être hors combat passe la cible automatiquement en "tête baissée".</li>
    </ul>
  <button id="placeButton" type="button" name="button" v-on:click="menu[1]['param'] = false">X</button>
</div>
<div class="dialogueADJ" v-if="menu[2]['param']" class="overlay">
  <h3 class="sousTitre">{{menu[2]['data']}}</h4>
    <ul>
      <li>Les unités sous le statut contact à moins de 2 pouces l'une de l'autre peuvent combattre.</li>
      <li>Les combats sont simultannées. Retirer les pertes en même temps.</li>
      <li>Calculer la difficulté de manière habituel.</li>
      <li>On retire les unités qui ont 0 point de vie à la fin des combats.</li>
    </ul>
  <button id="placeButton" type="button" name="button" v-on:click="menu[2]['param'] = false">X</button>
</div>
<div class="dialogueADJ" v-if="menu[3]['param']" class="overlay">
  <h3 class="sousTitre">{{menu[3]['data']}}</h4>
    <ul>
      <li>
        <img class="ordre_simple" src="images/CourseOrdres.png" alt="Ordre Course" v-on:click="affichage(0)" />
        <strong v-if="ordre[0]"><br /> Ordre qui permet de franchir le maximum de son mouvement,
        sans le bonus de 1d4 pouces.</strong></li>
      <li><img class="ordre_simple" src="images/ChargeOrdre.png" alt="Ordre charge" v-on:click="affichage(1)" />
        <strong v-if="ordre[1]"><br /> Ordre qui permet de vous déplacer du maximum de son mouvement
        et ajoute un bonus de +1d4. Vous êtes pris pour cible par l'unité que vous chargez.</strong></li>
      <li><img class="ordre_simple" src="images/MouvementTactiqueOrdre.png" alt="Status Contact" v-on:click="affichage(2)" />
        <strong v-if="ordre[2]"><br /> Ordre qui permet de se déplacer de son mouvement tactique et tirer.</strong></li>
      <li><img class="ordre_simple" src="images/CouvertureOrdre.png" alt="Status tête baissée"v-on:click="affichage(3)" />
        <strong v-if="ordre[3]"><br /> Ordre qui permet de tirer sur des unités qui passent dans le champs de vision de
          l'unité sous l'ordre couverture.
      L'unité est immobile, chaque nouveau tir ajoute +1 à la difficulté.</strong></li>
      <li><img  class="ordre_simple" src="images/TirAjusteOrdre.png" alt="Status attente" v-on:click="affichage(4)" />
        <strong v-if="ordre[4]"><br /> Ordre qui permet de prendre pour cible une unité de maniére précise, -1 à la difficulté de tir.
          L'unité est immobile.</strong></li>
    </ul>
  <button id="placeButton" type="button" name="button" v-on:click="menu[3]['param'] = false">X</button>
</div>
<div class="dialogueADJ" v-if="menu[4]['param']" class="overlay">
  <h3 class="sousTitre">{{menu[4]['data']}}</h4>
<ul>
<li><img class="ordre_simple" src="images/ContactStatuts.png" alt="Status Contact" /><br />L'unité est en combat de mêlée.</li>
<li><img class="ordre_simple" src="images/AttenteOrdre.png" alt="Status attente" /><br /> L'unité est en attente d'ordre, elle pourra agir en même temps qu'une autre de vos unités, en coordination.</li>
<li><img class="ordre_simple" src="images/TeteBaisseeStatuts.png" alt="Status tête baissée" /><br /> Votre unité est immobile, sous le feu enemis ou choqué par les dommages qu'elle subit.</li>
</ul>
  <button id="placeButton" type="button" name="button" v-on:click="menu[4]['param'] = false">X</button>
</div>

<div class="dialogueADJ" v-if="menu[5]['param']" class="overlay">
  <h3 class="sousTitre">{{menu[5]['data']}}</h4>
  <ul>
    <li>Réactivé une unité qui a le status "tête baissée".</li>
    <li>Relancer un jet de dé jugé raté.</li>
    <li>Gagner automatiquement l'initiative pour le tour</li>
  <li><h4>Officier</h4></li>
  <ul>
    <li>Rendre invisible durant un tour son unité (formé de 1 à 12 figurines espacé entre elle de 2 pouces maximum). L’unité « invisible » ne pourra pas être prise pour cible par des tirs durant le reste du tour. </li>
    <li>Dépense 1 pions de commandement pour retirer immédiatement un statut « tête baissée » à son unité.</li>
    <li>Réclamer un tir d’artillerie en support tactique, une fois par partie. L’emplacement est décider durant le tour secrétement par le joueur et noter (les coordonnées x et y sur la carte exprimer en pouces). Le tour suivant, l’artillerie se déclenche, sur un 4+ sur 1D10, l’impact à lieu à l’endroit prévus. En cas d’échec, le tir va dévier de 1d6 pouces et 1 dé de dispersion. Le gabarit d’explosion est grand avec une puissance de D8 et perce armure.*</li>
  </ul>
  <li>
    <h4>Officier suppérieur</h4>
  </li>
  <ul>
    <li>En plus de tous ce que fait un officier</li>
      <li>Pour 2 pions de commandement, il peuvent réclamer un tir d’artillerie une fois par partie selon les mêmes modalité que l’officier.*</li>
        <li>Ils peuvent retirer sans être dans une unité, un statut « tête baissée » à n’importe qu’elle unité sur la zone de combat.</li>
        <li>Ils peuvent une fois par partie générer un pion de commandement supplémentaire sur un 3+ sur 1D6.</li>
  </ul>
  </ul>
  <button id="placeButton" type="button" name="button" v-on:click="menu[5]['param'] = false">X</button>
</div>
</div>
<script>
  const ADJ = Vue.createApp({
    data () {
      return {
        menu: [{param: false, data: 'Tour de jeu'},
              {param: false, data: 'Procédure de tir'},
              {param: false, data: 'Procédure de combat de mêlée'},
              {param: false, data: 'Les Ordre'},
              {param: false, data: 'Les statuts'},
              {param: false, data: 'Les pions de commandement'}],
        ordre: [false, false, false,false,false]
      }
    },
    methods: {
      affichage($bascule) {
        $voyant = this.ordre[$bascule]
        /*if($voyant) {
          this.ordre[$bascule] = false
        } else {
          this.ordre[$bascule] = true
        }*/
        for (var i = 0; i < this.ordre.length; i++) {
          if ($bascule != i) {
                this.ordre[i] = false
          } else {
            this.ordre[i] = true
          }
        }
      }
    }
  })
  ADJ.mount('#ADJ')
</script>
