<?php
include 'securite/securiterCreateur.php';
include 'stockageData/typeRules.php';
 ?>
<article class="">
  <h3 class="sousTitre">Ajouter une règle spéciales</h3>
  <form class="formulaire" action="CUD/Create/regleSpecial.php" method="post">
    <label for="nom">Nom de la règle spéciale</label>
    <input id="nom" type="text" name="nomRules">
    <label for="description">Description rules</label>
    <textarea id="description" name="descriptionRules" rows="8" cols="80">
    </textarea>
    <label for="mod">Modificateur</label>
    <input id="mod" type="number" name="modification" min="1" step="0.01" max="2" placeholder="1">
    <label for="type">Application de la règle spéciales</label>
    <select  id="type" class="" name="typeRules">
      <?php

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
  $searchRules = "SELECT `idRules`, `nomRules`, `descriptionRules`, `modification`, `typeRules` FROM `rules` ORDER BY `typeRules`, `nomRules`";
  $prepare = [];
  $listeRules = new readDB($searchRules, $prepare);
  $dataListe = $listeRules->read();
  if (empty($dataListe)) { echo 'Il n\'y a pas de règles spéciales';}
  function regles($dataListe, $param, $idNav) {
    include 'stockageData/typeRules.php';
    foreach ($dataListe as $key) {
      if ($key['typeRules'] == $param) {
        echo '<li>Nom : '.$key['nomRules'].' Modificateur : '.$key['modification'].' Type : '.$typeRules[$key['typeRules']].'
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
        </li>';
      }
  }
  }

?>
<h3 class="sousTitre">Armes</h3>
<ul>
<?php
  regles($dataListe, 0, $idNav);
 ?>
</ul>
<h3 class="sousTitre">Figurines</h3>
<ul>
<?php
  regles($dataListe, 1, $idNav);
 ?>
</ul>
<h3 class="sousTitre">Véicules</h3>
<ul>
<?php
  regles($dataListe, 2, $idNav);
 ?>
</ul>
<h3 class="sousTitre">Listes</h3>
<ul>
<?php
  regles($dataListe, 3, $idNav);
 ?>
</ul>
</article>
