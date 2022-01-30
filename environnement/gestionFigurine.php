<?php
include 'securite/securiterUtilisateur.php';
require 'objets/lienCentrale.php';
$role = $_SESSION['role'];
$centrale = 4;
$LienCentrale = new LienCentrale($role, $centrale, $idNav);
$dataNav = $LienCentrale->NavCentrale();
 ?>
   <div class="flex-menuCentrale">
  <ul>
    <li><h3 class="sousTitre">Gestion Figurines</h3></li>
    <?php
    $LienCentrale->affichageLien($dataNav);
     ?>
  </ul>
       <aside id="VERROU" class="simpleColonne">
         <button v-if="!cle" type="button" class="lienBoutton" name="button" v-on:click="cle = true">Ouvrir l'aide</button>
        <button v-if="cle" type="button" class="lienBoutton" name="button" v-on:click="cle = false">Fermer l'aide</button>
         <ul v-if="cle" class="arial">
           <li>Créer une figurine (nom, description, type etc...)</li>
           <li>Liste des nouvelles figurines, permet d'affecter la figurine a une faction.</li>
           <li>Les figurines dans "Liste des figurines affecter"</li>
           <ul>
             <li>Fiche => Permet d'aller dans le menus pour affecter des règles spéciales aux figurines.
               <br /> Valide la figurine avec "Ok pour dotation" qui permet d'affecter les armes de vos figurines.
             </li>
             <li>Effacer permet d'effacer la figurine.</li>
           </ul>
           <li>La liste des figurines en service montre toute les figurines fixer et près pour être ajouter dans les listes.</li>
         </ul>
      </aside>
</div>
<?php include 'javascript/verrou.php' ?>
