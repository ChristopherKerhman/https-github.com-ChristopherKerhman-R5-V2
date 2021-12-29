<form class="formulaire" action="CUD/Create/lore.php" method="post">
  <label for="Univers">Univers</label>
  <select id="Univers" name="id_Univers">
    <?php
    require 'objets/univers.php';
    $univers = new Univers ($_SESSION['idUser']);
    $dataUnivers = $univers->readUniversUser();
    ?>
  </select>

  <label for="titre">Titre</label>
  <input id="titre" type="text" name="titreLore" required>
  <label for="texte">Texte de Lore</label>
  <textarea id="texte" name="texteLore" rows="8" cols="80" required>
    Votre texte ici...
  </textarea>
  <label for="partager">Partager votre texte</label>
  <select id="partager" name="partager">
    <option value="0">Non</option>
    <option value="1" selected>Oui</option>
  </select>
  <input type="hidden" name="idNav" value="<?=$idNav?>">
<button type="submit" name="button">Enregistrer</button>
</form>
