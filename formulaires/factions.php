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
<?php
$triUnivers = "SELECT `idUnivers`, `nomUnivers`, `NTUnivers` FROM `univers` WHERE `idProprietaire` = :idUser AND `valide` = 1";
$preparation = [['prep' => ':idUser', 'variable' => $_SESSION['idUser']]];
$listUniversUser = new readDB($triUnivers, $preparation);
$dataListe = $listUniversUser->read();

 ?>
<article class="centrage">
  <h4 class="sousTitre">Les factions existantes</h4>
  <?php
  foreach ($dataListe as $index) {
    $idUnivers = $index['idUnivers'];
    $triFaction = "SELECT `idFaction`, `nomFaction`, `valide`, `partager` FROM `factions` WHERE `idUnivers` = :idUnivers";
    $preparationFaction = [['prep' => ':idUnivers', 'variable' => $idUnivers]];
    $listeFaction = new readDB($triFaction, $preparationFaction);
    $dataFaction = $listeFaction->read();
    echo '<h4>Univers : '.$index['nomUnivers'].'</h4><ul>';
    foreach ($dataFaction as $key) {
      echo '
      <li>
        <form action="CUD/Update/factions.php" method="post">
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
    echo '</ul>';
  }
   ?>
</article>
