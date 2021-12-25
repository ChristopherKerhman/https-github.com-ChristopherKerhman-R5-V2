<?php include 'securite/securiterUtilisateur.php';
// tri univers de l'Utilisateur
$requetteSQL = "SELECT `idUnivers`, `nomUnivers`, `NTUnivers`, `partager`
FROM `univers`
WHERE `idProprietaire` = :idUser AND `valide` = 1 ORDER BY `NTUnivers` AND `nomUnivers` ASC";
$prepare = [['prep'=> ':idUser', 'variable' => $_SESSION['idUser']]];
$readUnivers = new readDB($requetteSQL, $prepare);
$dataUnivers = $readUnivers->read();
?>
<h4 class="sousTitre">Creation d'une nouvelle faction</h4>
<form class="formulaire" action="CUD/Create/faction.php" method="post">
  <label for="Univers">Univers de la faction</label>
  <select class="inputFormulaire" name="idUnivers">
    <?php foreach ($dataUnivers as $key) {
    echo '<option value="'.$key['idUnivers'].'">'.$key['nomUnivers'].' NT '.$key['NTUnivers'].'</option>';
    }
      ?>
  </select>
  <label for="share">Partager cette faction</label>
  <select class="inputFormulaire" name="partager">
      <option value="0" selected>Non</option>
      <option value="1">Oui</option>
  </select>
  <label for="nom">Nom de la nouvelle faction</label>
  <input class="inputFormulaire" type="text" name="nomFaction">
  <input type="hidden" name="idNav" value="<?=$idNav?>">
  <?php
  if(empty($dataUnivers)) {
    echo 'Aucun univers créé';
  } else {
    echo '<button type="submit" name="button">Enregistrer</button>';
  }
   ?>

</form>
<article class="centrage">
  <h4 class="sousTitre">Les factions existantes</h4>
  <ul class="flex-center">
  <?php
  $requetteSQL = "SELECT `idFaction`, `idCreateur`, `nomUnivers`, `nomFaction`, `factions`.`partager`
  FROM `factions`
  INNER JOIN `univers` ON `factions`.`idUnivers` = `univers`.`idUnivers`
  WHERE `idCreateur` = :idUser AND `factions`.`valide` = 1 ORDER BY `factions`.`idUnivers` AND `nomFaction`";
  $prepare = [['prep'=> ':idUser', 'variable' => $_SESSION['idUser']]];
  $readFactions = new readDB($requetteSQL, $prepare);
  $dataFactions = $readFactions->read();

  if (empty($dataFactions)) {
    echo '<li>Aucune faction créé actuellement.</li>';
  } else {

    foreach ($dataFactions as $key) {
      echo '
      <li>
        <form action="CUD/Update/factions.php" method="post">
          <h4>Univers : '.$key['nomUnivers'].'</h4>
          <label for="nom">Nom Faction :</label>
          <input id="nom" type="text" name="nomFaction" value="'.$key['nomFaction'].'">
          <label for="share">Partager cette faction</label>
          <select id="share" name="partager">
              <option value="0" selected>Non</option>
              <option value="1">Oui</option>
          </select>
          <input type="hidden" name="idFaction" value="'.$key['idFaction'].'" />
          <input type="hidden" name="idNav" value="'.$idNav.'">
          <button type="submit" name="button">Modifier</button>
        </form>
          <form  action="CUD/Delette/factions.php" method="post">
            <input type="hidden" name="idNav" value="'.$idNav.'">
            <input type="hidden" name="idFaction" value="'.$key['idFaction'].'" />
          <button class="buttonDescription" type="submit" name="button">Effacer '.$key['nomFaction'].'</button>
          </form>
      </li>';
    }

  }
  ?>
  </ul>
</article>
