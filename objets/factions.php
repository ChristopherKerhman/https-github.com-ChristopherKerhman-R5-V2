<?php
class Factions {
  private $idUser;
  private $idNav;

  public function __construct($idUser, $idNav) {
    $this->idUser = $idUser;
    $this->idNav = $idNav;
  }
  public function adminFaction () {
    $triUnivers = "SELECT `idUnivers`, `nomUnivers`, `NTUnivers` FROM `univers` WHERE `idProprietaire` = :idUser AND `valide` = 1";
    $preparation = [['prep' => ':idUser', 'variable' => $this->idUser]];
    $listUniversUser = new readDB($triUnivers, $preparation);
    $dataListe = $listUniversUser->read();
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
            <input type="hidden" name="idNav" value="'.$this->idNav.'">
            <button type="submit" name="button">Modifier</button>
          </form>
            <form  action="CUD/Delette/factions.php" method="post">
              <input type="hidden" name="idNav" value="'.$this->idNav.'">
              <input type="hidden" name="idFaction" value="'.$key['idFaction'].'" />
            <button class="buttonDescription" type="submit" name="button">Effacer '.$key['nomFaction'].'</button>
            </form>
        </li>';
      }
      echo '</ul>';
    }
  }
}
