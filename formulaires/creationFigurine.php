<?php include 'stockageData/figurine.php'; ?>
<h3 class="sousTitre">Créer une nouvelle figurine</h3>
<form class="formulaire" action="CUD/Create/figurine.php" method="post">
  <label for="nomFigurine">Nom</label>
  <input id="nomFigurine" type="text" name="nomFigurine">
  <label for="description">Description</label>
  <textarea id="description" name="description" rows="8" cols="80">Quelques éléments sur votre nouvelle figurine ?</textarea>
  <div class="flex-ligne">
  <label for="typeF">Type de votre figurine</label>
  <select id="typeF" name="typeFigurine">
    <?php
    foreach ($typeFigurine as $key => $value) {
      echo '<option value="'.$key.'">'.$value['type'].'</option>';
    }
     ?>
  </select>
  <label for="taille">Taille de votre figurine</label>
  <select id="taille" name="tailleFigurine">
    <?php
    foreach ($tailleFigurine as $key => $value) {
      echo '<option value="'.$key.'">'.$value['taille'].'</option>';
    }
     ?>
  </select>
  </div>
  <div class="flex-ligne">
    <label for="DQM">Dé de Qualité Martial</label>
    <select id="DQM" name="DQM">
      <?php
      foreach ($dice as $key => $value) {
        echo '<option value="'.$key.'">'.$value['type'].'</option>';
      }
       ?>
    </select>
    <label for="DC">Dé de Combat</label>
    <select id="DC" name="DC">
      <?php
      foreach ($dice as $key => $value) {
        echo '<option value="'.$key.'">'.$value['type'].'</option>';
      }
       ?>
    </select>
    <label for="pdv">Point de vie ou de structure</label>
    <select id="pdv" name="pdv">
      <?php
      for ($i=0; $i < count($pointDeVie) ; $i++) {
        echo '<option value="'.$i.'">
        '.$pointDeVie[$i].' PdV / PdS
        </option>';
      }
       ?>
    </select>
    <label for="armure">Valeur de sauvegarde</label>
    <select id="armure" name="svg">
      <?php
        foreach ($svg as $key => $value) {
          echo '<option value="'.$key.'">'.$value['armure'].'</option>';
        }
       ?>
    </select>
  </div>
  <div id="COURSE" class="flex-ligne">
    <label for="deplacement">Déplacement tactique : {{mouvement}}" / Course {{course}}" + 1D4" </label>
      <input type="range" name="mouvement" v-model="mouvement" min="0" max="12" />
  </div>
  <input type="hidden" name="idNav" value="<?=$idNav?>">
<button type="submit" name="button">Enregistrer</button>
</form>
<?php include 'javascript/mouvement.php' ?>
