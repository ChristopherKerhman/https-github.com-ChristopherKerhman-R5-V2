<?php
include 'securite/securiterUtilisateur.php';
require 'objets/factions.php';
include 'stockageData/armes.php';
include 'stockageData/yes.php';
 ?>
<article>
  <h3 class="sousTitre">Création arme de explosive ou de zone</h3>
  <form class="formulaire" action="CUD/Create/armes.php" method="post">
    <label for="Univers">Univers</label>
    <select id="Univers" name="id_Univers">
      <?php
      require 'objets/univers.php';
      $univers = new Univers ($_SESSION['idUser']);
      $dataUnivers = $univers->readUniversUser();
      ?>
    </select>
    <label for="nom">Nom de l'arme :</label>
    <input id="nom" type="text" name="nom" required>
    <label for="des">Description</label>
    <textarea id="des" name="description" rows="8" cols="80">
    Quelques mots sur votre nouvelle arme ?
    </textarea>
    <input type="hidden" name="typeArme" value="2">
    <div class="flex-ligne">
    <label for="P">Puissance :</label>
    <input id="O" type="number" name="puissance" min="1" max="5" value="1" required>
    <div id="RANGE">
      <label for="range">Portée maximal de votre armes :</label>
        <input type="range" name="maxRange" v-bind:value="rangeActuel" v-model="rangeActuel" min="0" max="50">
        {{rangeActuel}} pouces {{Math.floor(rangeActuel * 2.54)}} cm
    </div>
      <label for="SP">Sur-puissance :</label>
      <select id="SP" name="surPuissance">
        <?php
          for ($i=0; $i < count($yes) ; $i++) {
            echo '<option value="'.$i.'">
            '.$yes[$i].'
            </option>';
          }
         ?>
      </select>
      <label for="Sort">Sort :</label>
      <select id="Sort" name="sort">
        <?php
          for ($i=0; $i < count($yes) ; $i++) {
            echo '<option value="'.$i.'">
            '.$yes[$i].'
            </option>';
          }
         ?>
      </select>
    </div>
    <div class="flex-ligne">
      <label for="assaut">Arme d'assaut</label>
      <select id="assaut" name="assaut">
        <?php
          for ($i=0; $i < count($yes) ; $i++) {
            echo '<option value="'.$i.'">
            '.$yes[$i].'
            </option>';
          }
         ?>
      </select>
      <label for="couverture">Arme de couverture</label>
      <select id="couverture" name="couverture">
        <?php
          for ($i=0; $i < count($yes) ; $i++) {
            echo '<option value="'.$i.'">
            '.$yes[$i].'
            </option>';
          }
         ?>
      </select>
      <label for="cadence">Cadence de tir max (si arme de couverture)</label>
      <input type="number" name="cadenceTir" min="1" max="12" value="1">
      <label for="lourd">Arme lourde</label>
      <select id="lourd" name="lourd">
        <?php
          for ($i=0; $i < count($yes) ; $i++) {
            echo '<option value="'.$i.'">
            '.$yes[$i].'
            </option>';
          }
         ?>
      </select>
    </div>
    <div class="flex-ligne">
    <label for="gab">Gabarit</label>
    <select id="gab" name="gabarit">
      <?php
        for ($i=0; $i < count($gabarit) ; $i++) {
          echo '<option value="'.$i.'">
          '.$gabarit[$i].'
          </option>';
        }
       ?>
    </select>
    <label for="PE">Puissance explosif</label>
    <select id="PE" name="puissanceExplosif">
      <?php
        for ($i=0; $i < count($dice) ; $i++) {
          echo '<option value="'.$i.'">
          '.$dice[$i].'
          </option>';
        }
       ?>
    </select>
</div>
        <input type="hidden" name="idNav" value="<?=$idNav?>">
  <button type="submit" name="button">Enregistrer</button>
  </form>
</article>
<?php include 'javascript/range.php'; ?>
