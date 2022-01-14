<?php
include 'securite/securiterUtilisateur.php';
include 'stockageData/vehicules.php';
?>
<h3 class="sousTitre">Création de véhicule</h3>
<form class="formulaire" action="CUD/Create/vehicule.php" method="post">
<label for="nom">Nom du vehicule</label>
<input id="nom" type="text" name="nomVehicule" required placeholder="nom du véhicule">
<label for="description">Description</label>
<textarea id="description" name="description" rows="8" cols="80" required>Quelques éléments sur votre nouveau véhicule ?</textarea>
<div class="flex-ligne">
<label for="type">Type de véhicule</label>
<select id="type" name="typeVehicule">
  <?php foreach ($typeVehicule as $key => $value) { echo '<option value="'.$key.'">'.$value['type'].'</option>';} ?>
</select>

<label for="role">Role du vehicule</label>
<select id="role" name="roleVehicule">
  <?php foreach ($roleVehicule as $key => $value) { echo '<option value="'.$key.'">'.$value['role'].'</option>'; } ?>
</select>
<label for="taille">Taille du vehicule</label>
<select id="taille" name="tailleVehicule">
  <?php foreach ($tailleVehicule as $key => $value) { echo '<option value="'.$key.'">'.$value['taille'].'</option>'; } ?>
</select>
</div>
<div class="flex-ligne">
  <label for="crew">Nombre de membre d'équipage</label>
  <select id="crew" name="equipage">
      <?php foreach ($equipage as $key => $value) { echo '<option value="'.$key.'">'.$value['nbre'].'</option>'; } ?>
  </select>
  <label for="passager">Nombre de passager</label>
  <select id="passager" name="passage">
      <?php for ($i=0; $i <count($passager) ; $i++) { echo '<option value="'.$i.'">'.$passager[$i].'</option>';} ?>
  </select>
  </div>
<div class="flex-ligne">
<label for="DQM">Dé de qualité martial</label>
<select id="DQM" name="DQM">
  <?php foreach ($dice as $key => $value) { echo '<option value="'.$key.'">'.$value['type'].'</option>'; } ?>
</select>
<label for="DC">Dé de combat</label>
<select id="DC" name="DC">
  <?php foreach ($dice as $key => $value) { echo '<option value="'.$key.'">'.$value['type'].'</option>'; } ?>
</select>
</div>
<div class="flex-ligne">
  <label for="pds">Point de structure</label>
  <select id="pds" name="pds">
    <?php for ($i=0; $i <count($pds) ; $i++) {
      echo '<option value="'.$i.'">'.$pds[$i].' point de structure</option>';
    } ?>
  </select>
  <label for="svg">Sauvegarde</label>
  <select id="svg" name="svgVehicule">
    <?php foreach ($svgVehicule as $key => $value) {echo '<option value="'.$key.'">'.$value['armure'].'</option>';} ?>
  </select>
</div>
<div id="COURSE" class="flex-ligne">
  <label for="deplacement">Déplacement tactique : {{mouvement}}" / Course {{course}}" + 1D4" </label>
    <input id="deplacement" type="range" name="deplacement" v-model="mouvement" min="0" max="28" />
</div>
<div class="flex-ligne">
  <label for="vol">Vol :</label>
  <select id="vol" name="vol">
      <?php for ($i=0; $i <count($yes) ; $i++) {
        echo '<option value="'.$i.'">'.$yes[$i].'</option>';
      } ?>
  </select>
  <label for="station">Vol stationnaire :</label>
  <select id="station" name="stationnaire">
      <?php for ($i=0; $i <count($yes) ; $i++) {
        echo '<option value="'.$i.'">'.$yes[$i].'</option>';
      } ?>
  </select>
</div>
<input type="hidden" name="idNav" value="<?=$idNav?>">
<button type="submit" name="button">Enregistrer</button>
</form>
<?php include 'javascript/mouvementVehicule.php' ?>
