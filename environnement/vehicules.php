<?php
include 'securite/securiterUtilisateur.php';
require 'objets/lienCentrale.php';
$role = $_SESSION['role'];
$centrale = 5;
$LienCentrale = new LienCentrale($role, $centrale, $idNav);
$dataNav = $LienCentrale->NavCentrale();
 ?>
    <div class="flex-menuCentrale">

  <ul>
    <li><h3 class="sousTitre">Gestion véhicules</h3></li>
    <?php
    $LienCentrale->affichageLien($dataNav);
     ?>
  </ul>
  <aside id="VERROU" class="simpleColonne">
    <button v-if="!cle" type="button" class="lienBoutton" name="button" v-on:click="cle = true">Ouvrir l'aide</button>
   <button v-if="cle" type="button" class="lienBoutton" name="button" v-on:click="cle = false">Fermer l'aide</button>
    <ul v-if="cle" class="arial">
      <li>Créer un véhicule (nom, description, type etc...)</li>
      <li>Equipement et dotation</li>
      <ul>
        <li>Permet d'affecter un nouveau véhicule à une faction.</li>
        <li>Affecter des règles spéciales à un véhicule.</li>
        <li>Doter un véhicule de ces armes.</li>
        <li>Le mettre en serice.</li>
      </ul>
      <li>Liste des véhicules fixés rassemble l'ensemble des véhicules disponible pour être ajouter dans une liste.</li>
    </ul>
 </aside>
</div>
<?php include 'javascript/verrou.php' ?>
