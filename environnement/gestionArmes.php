<?php
include 'securite/securiterUtilisateur.php';
require 'objets/lienCentrale.php';
$role = $_SESSION['role'];
$centrale = 3;
$LienCentrale = new LienCentrale($role, $centrale, $idNav);
$dataNav = $LienCentrale->NavCentrale();
 ?>
  <div class="flex-menuCentrale">
  <ul>
    <li><h3 class="sousTitre">Gestion armes</h3></li>
    <?php
    $LienCentrale->affichageLien($dataNav);
     ?>
  </ul>
     <aside id="VERROU" class="simpleColonne">
       <button v-if="!cle" type="button" class="lienBoutton" name="button" v-on:click="cle = true">Ouvrir l'aide</button>
      <button v-if="cle" type="button" class="lienBoutton" name="button" v-on:click="cle = false">Fermer l'aide</button>
       <ul v-if="cle" class="arial">
         <li>Les grandes étapes de la création d'une arme.</li>
         <li>Créer une armes (mêlée, tir ou de zone).</li>
         <li>Affecter une faction dans "Factions & Fiches".</li>
         <li>Ajouter des règles spéciales avec Add RSS et fixer l'arme.</li>
         <li>Une fois une arme fixer, il est impossible de la modifier.</li>
         <li>Votre arme est disponible pour sa faction pour vos figurines.</li>
       </ul>
     </aside>
</div>
<?php include 'javascript/verrou.php' ?>
