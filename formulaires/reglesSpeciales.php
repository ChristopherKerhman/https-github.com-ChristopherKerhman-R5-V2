<?php
include 'securite/securiterCreateur.php';
 ?>
<article class="">
  <h3 class="sousTitre">Ajouter une règle spéciales</h3>
  <form class="formulaire" action="CUD/Create/regleSpecial.php" method="post">
    <label for="nom">Nom de la règle spéciale</label>
    <input id="nom" type="text" name="nomRules">
    <label for="description">Description rules</label>
    <textarea id="description" name="descriptionRules" rows="8" cols="80">
    </textarea>
    <label for="mod">Modificateur % de la valeur de l'objet</label>
    <input id="mod" type="number" name="modification" min="0" max="100">
    <label for="type">Application de la règle spéciales</label>
    <select  id="type" class="" name="typeRules">
      <?php
        include 'stockageData/typeRules.php';
        for ($i=0; $i < count($typeRules) ; $i++) {
          echo '<option value="'.$i.'">'.$typeRules[$i].'</option>';
        }
       ?>
    </select>
    <input type="hidden" name="idNav" value="<?=$idNav?>">
  <button type="submit" name="button">Enregistrer</button>
  </form>
</article>
<article>
  <?php
  // Recherche des règles spécial déjà créer.
  $searchRules = "SELECT `idRules`, `nomRules`, `descriptionRules`, `modification`, `typeRules` FROM `rules` ORDER BY `typeRules`";
  $prepare = [];
  $listeRules = new readDB($searchRules, $prepare);
  $dataListe = $listeRules->read();
  if (empty($dataListe)) {
    echo 'Il n\'y a pas de règles spéciales';
  } else {
    echo '<ul>';
    foreach ($dataListe as $key) {
      echo '<li>Nom : '.$key['nomRules'].' Modificateur : '.$key['modification'].' % Type : '.$typeRules[$key['typeRules']].'
      <br />
      <p>
      '.$key['descriptionRules'].'
      </p>
      </li>
      <li>
      <form  action="CUD/Delette/regleSpecial.php" method="post">
        <input type="hidden" name="idNav" value="'.$idNav.'">
        <input type="hidden" name="idRules" value="'.$key['idRules'].'">
        <button type="submit" name="button">Effacer</button>
      </form>
      </li>
      ';
    }
    echo '</ul>';
  }
   ?>

</article>
