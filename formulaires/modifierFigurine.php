<?php
include 'stockageData/figurine.php';
include 'securite/securiterUtilisateur.php';
require 'objets/figurines.php';
$idFigurine = filter($_GET['idFigurine']);
$figurine = new Figurines ($_SESSION['idUser'], $idNav);
$dataFiche = $figurine->readFiche($idFigurine); ?>
<section class="flex-presentation">
  <article class="box">
  <?php
  $figurine->ficheFigurine($dataFiche, $idNav);
   ?>
    <h3 class="sousTitre">Modifier la fiche : <?=$dataFiche[0]['nomFigurine']?></h3>
    <form class="formulaire" action="CUD/Update/statFigurine.php" method="post">
      <label for="nomFigurine">Nom</label>
      <input id="nomFigurine" type="text" name="nomFigurine" value="<?=$dataFiche[0]['nomFigurine']?>" required>
      <label for="description">Description</label>
      <textarea id="description" name="description" rows="8" cols="80" required><?=$dataFiche[0]['description']?></textarea>
      <div class="flex-ligne">
      <label for="typeF">Type de votre figurine</label>
      <select id="typeF" name="typeFigurine">
        <?php
        foreach ($typeFigurine as $key => $value) {
            if($dataFiche[0]['typeFigurine'] == $key) {
            echo '<option value="'.$key.'" selected>'.$value['type'].'</option>';
          } else {
            echo '<option value="'.$key.'">'.$value['type'].'</option>';
          }
        }
         ?>
      </select>
      <label for="taille">Taille de votre figurine</label>
      <select id="taille" name="tailleFigurine">
        <?php
        foreach ($tailleFigurine as $key => $value) {
          if($dataFiche[0]['tailleFigurine'] == $key) {
            echo '<option value="'.$key.'" selected>'.$value['taille'].'</option>';
          } else {
          echo '<option value="'.$key.'">'.$value['taille'].'</option>';
          }

        }
         ?>
      </select>
      </div>
      <div class="flex-ligne">
        <label for="DQM">Dé de Qualité Martial</label>
        <select id="DQM" name="DQM">
          <?php
          foreach ($dice as $key => $value) {
            if($dataFiche[0]['DQM'] == $key) {
            echo '<option value="'.$key.'" selected>'.$value['type'].'</option>';
            } else {
            echo '<option value="'.$key.'">'.$value['type'].'</option>';
            }

          }
           ?>
        </select>
        <label for="DC">Dé de Combat</label>
        <select id="DC" name="DC">
          <?php
          foreach ($dice as $key => $value) {
            if($dataFiche[0]['DC'] == $key) {
            echo '<option value="'.$key.'" selected>'.$value['type'].'</option>';
            } else {
            echo '<option value="'.$key.'">'.$value['type'].'</option>';
            }

          }
           ?>
        </select>
        <label for="pdv">Point de vie ou de structure</label>
        <select id="pdv" name="pdv">
          <?php
          for ($i=0; $i < count($pointDeVie) ; $i++) {
            if($dataFiche[0]['pdv'] == $i) {
              echo '<option value="'.$i.'" selected>'.$pointDeVie[$i].' PdV / PdS</option>';
            } else {
            echo '<option value="'.$i.'">'.$pointDeVie[$i].' PdV / PdS</option>';
            }

          }
           ?>
        </select>
        <label for="armure">Valeur de sauvegarde</label>
        <select id="armure" name="svg">
          <?php
            foreach ($svg as $key => $value) {
              if($dataFiche[0]['svg'] == $key) {
              echo '<option value="'.$key.'" selected>'.$value['armure'].'</option>';
              } else {
              echo '<option value="'.$key.'">'.$value['armure'].'</option>';
              }

            }
           ?>
        </select>
      </div>
      <div id="COURSE" class="flex-ligne">
        <label for="deplacement">Déplacement tactique : {{mouvement}}" / Course {{course}}" + 1D4" </label>
          <input type="range" name="mouvement" v-model="mouvement" min="0" max="12" />
      </div>
      <div class="flex-ligne">
        <label for="vol">Vol :</label>
        <select id="vol" name="vol">
            <?php
            for ($i=0; $i < count($yes) ; $i++) {
              if($dataFiche[0]['vol'] == $i) {
                echo '<option value="'.$i.'" selected>'.$yes[$i].'</option>';
              } else {
              echo '<option value="'.$i.'">'.$yes[$i].'</option>';
              }
            }
             ?>
        </select>
        <label for="station">Vol stationnaire :</label>
        <select id="station" name="stationnaire">
            <?php
            for ($i=0; $i < count($yes) ; $i++) {
              if($dataFiche[0]['stationnaire'] == $i) {
                echo '<option value="'.$i.'" selected>'.$yes[$i].'</option>';
              } else {
              echo '<option value="'.$i.'">'.$yes[$i].'</option>';
              }
            }
            ?>
        </select>
      </div>
      <input type="hidden" name="idFigurine" value="<?=$dataFiche[0]['idFigurine']?>">
        <input type="hidden" name="idNav" value="<?=$idNav?>">
    <button type="submit" name="button">Modifier</button>
    </form>
</section>
 <?php include 'javascript/mouvement.php' ?>
