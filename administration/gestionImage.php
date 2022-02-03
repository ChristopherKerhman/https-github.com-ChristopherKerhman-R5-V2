<h3 class="sousTitre">Ajouter des images</h3>
<form class="formulaire" action="CUD/Create/recordImage.php" method="post" enctype="multipart/form-data">
  <label for="image">Nom de l'image</label>
  <input type="file" name="nomImage" accept="image/png, image/jpeg">
  <label for="description">Legende</label>
  <input id="description" type="text" name="description">
  <label for="alt">Texte alternatif</label>
  <input type="alt" name="alt">
  <input type="hidden" name="idNav" value="<?=$idNav?>">
  <button class="classique marge" type="submit" name="button">Envoyer</button>
</form>
<?php
$lireImage = "SELECT `idImage`, `nomImage`, `description`, `alt`, `valide` FROM `images`";
$param = [];
$lireImage = new readDB($lireImage, $param);
$dataImage = $lireImage->read();
 ?>
<section>
  <div class="SPGRID">
    <?php
      foreach ($dataImage as $key => $value) {
        echo '  <figure class="Galeritem">';
        echo '<img src="images/galerieFront/'.$value['nomImage'].'" alt="'.$value['alt'].'"  width="400px" />';
        echo '<figcaption>'.$value['description'].'</figcaption>';
        echo '<form class="formulaire" action="CUD/Update/image.php" method="post">';
        echo '<label for="image">Image valide ?</label>
        <select name="valide">';
        if($value['valide'] == 1) {
          echo '<option value="0">Non</option><option value="1" selected>Oui</option>';
        } else {
          echo '<option value="0"  selected>Non</option><option value="1">Oui</option>';
        }
        echo '  </select>
        <input type="hidden" name="idImage" value="'.$value['idImage'].'">
        <input type="hidden" name="idNav" value="'.$idNav.'">
          <button class="classique marge" type="submit" name="button">Modifier</button>
        </form>';
        echo '</figure>';
      }
     ?>
  </div>

</section>
