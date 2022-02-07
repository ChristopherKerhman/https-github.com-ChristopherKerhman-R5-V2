<?php include 'securite/securiterCreateur.php';
$idNav = $idNav - 1;
 ?>
 <script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript">bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });</script>
<form class="formulaire" action="CUD/Create/texteIndex.php" method="post">
<div class="ligne">
  <label for="titre">Titre générale</label>
  <input id="titre" type="text" name="titre" placeholder="Votre titre ici">
  <label for="valide">Publier ?</label>
  <select id="valide" name="valide">
    <option value="0" selected>Non</option>
    <option value="1">Oui</option>
  </select>
</div>

  <label for="texte">Texte a publier</label>
  <textarea id="texte" name="texte" rows="8" cols="80" placeholder="Texte à publier"></textarea>

    <input type="hidden" name="idNav" value="<?=$idNav?>">
  <button type="submit" name="button">Créer</button>
</form>
