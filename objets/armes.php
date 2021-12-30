<?php
class Armes {
  private $idUser;
  private $idNav;
  public function __construct($idUser, $idNav) {
    $this->idUser = $idUser;
    $this->idNav = $idNav;
    $this->typeArme = ['mêlée', 'tir', 'explosive'];
    $this->yes = ['Non', 'Oui'];
    $this->dice = ['D6', 'D8', 'D10', 'D12'];
    $this->gabarit = ['pas de gabarit', 'petit', 'moyen', 'grand', 'cône'];
    $this->adressFiche = 53;
  }
  public function listeArmes ($fixer) {
    // Paramètre pour fixer, 0 -> Non fixer, 1 -> fixer
    $SQL = "SELECT `idArmes`, `id_Univers`, `nomUnivers`, `nom`, `typeArme`  FROM `armes`
    INNER JOIN `univers` ON `id_Univers` = `idUnivers`
    WHERE `idCreateur` = :idUser AND `fixer` = $fixer ORDER BY `nomUnivers`, `nom`";
    $prepare = [['prep' => ':idUser', 'variable' => $this->idUser]];
    $liste = new readDB($SQL, $prepare);
    $dataListe = $liste->read();
    foreach ($dataListe as $key) {
        echo
        '<li class="line">
          '.$key['nomUnivers'].' - '.$key['nom'].' - Type : '.$this->typeArme[$key['typeArme']].'
          <form action="CUD/Delette/armes.php" method="post">
            <input type="hidden" name="idArmes" value="'.$key['idArmes'].'">
            <input type="hidden" name="idNav" value="'.$this->idNav.'">
            <button type="submit" name="button">Effacer</button>
          </form>
          <form action="CUD/Update/fixer.php" method="post">
            <input type="hidden" name="fixer" value="'.$fixer.'">
            <input type="hidden" name="idArmes" value="'.$key['idArmes'].'">
            <input type="hidden" name="idNav" value="'.$this->idNav.'">';
            if ($fixer == 1) {
            echo '<button type="submit" name="button">Non fixer</button>';
          } else {
            echo '<button type="submit" name="button">Fixer</button>';
          }
        echo '</form></li>';
      }
    }
    public function sansFactions() {
      $SQL = "SELECT `idArmes`, `id_Faction`, `id_Univers`, `nom`, `typeArme`, `nomUnivers`
      FROM `armes`
      INNER JOIN `univers` ON `id_Univers` = `idUnivers`
      WHERE `armes`.`valide` = 1 AND `fixer` = 0 AND `id_Faction`= 0 AND `idCreateur` = :idUser
      ORDER BY `nomUnivers`, `typeArme`, `nom`ASC";
      $prepare = [['prep' => ':idUser', 'variable' => $this->idUser]];
      $liste = new readDB($SQL, $prepare);
      $dataListe = $liste->read();
      foreach ($dataListe as $key) {
        $requetteSQL = "SELECT `idFaction`, `nomFaction`
        FROM `factions`
        WHERE `valide` = 1 AND `idUnivers` = :idUnivers";
        $pre = [['prep' => ':idUnivers', 'variable' => $key['id_Univers']]];
        $action = new readDB($requetteSQL, $pre);
        $listeFaction = $action->read();
        echo
        '<li class="line">
          '.$key['nomUnivers'].' - '.$key['nom'].' - Type : '.$this->typeArme[$key['typeArme']].'
          <form action="CUD/Update/armeFaction.php" method="post">
          <label for="faction">Factions</label>
            <select name="id_Faction">';
            foreach ($listeFaction as $index) {
              echo '<option value="'.$index['idFaction'].'">'.$index['nomFaction'].'</option>';
            }
          echo
            '</select>
            <input type="hidden" name="idArmes" value="'.$key['idArmes'].'" />
            <input type="hidden" name="idNav" value="'.$this->idNav.'">
            <button type="submit" name="button">Affecter</button>
          </form>
          <form action="CUD/Delette/armes.php" method="post">
            <input type="hidden" name="idArmes" value="'.$key['idArmes'].'">
            <input type="hidden" name="idNav" value="'.$this->idNav.'">
            <button type="submit" name="button">Effacer</button>
          </form>
          </li>';
      }
    }
    public function avecFactions() {
      $SQL = "SELECT `idArmes`, `nom`, `nomUnivers`, `nomFaction`, `typeArme`
      FROM `armes`
      INNER JOIN `univers` ON `id_Univers` = `idUnivers`
      INNER JOIN `factions` ON `id_Faction` = `idFaction`
      WHERE `armes`.`valide` = 1 AND `fixer` = 0 AND `id_Faction`> 0 AND `armes`.`idCreateur` = :idUser
        ORDER BY `nomUnivers`, `nomFaction`, `typeArme`, `nom`ASC";
      $prepare = [['prep' => ':idUser', 'variable' => $this->idUser]];
      $liste = new readDB($SQL, $prepare);
      $dataListe = $liste->read();
      foreach ($dataListe as $key) {
        echo '<li class="line"> '.$key['nomUnivers'].' Faction : '.$key['nomFaction'].' - '.$key['nom'].' - Type : '.$this->typeArme[$key['typeArme']].'
        <form action="CUD/Delette/armes.php" method="post">
          <input type="hidden" name="idArmes" value="'.$key['idArmes'].'">
          <input type="hidden" name="idNav" value="'.$this->idNav.'">
          <button type="submit" name="button">Effacer</button>
          <a class="lienBoutton" href="index.php?idNav='.$this->adressFiche.'&idArmes='.$key['idArmes'].'">Fiche</a>
        </form>
        </li>';
      }
    }
    public function ficheArme ($idArmes) {
      $SQL = "SELECT `idArmes`, `id_Univers`, `id_Faction`, `nom`, `description`, `typeArme`, `puissance`, `maxRange`,
      `surPuissance`, `sort`, `assaut`, `couverture`, `cadenceTir`, `lourd`, `puissanceExplosif`, `gabarit`, `fixer`, `prix`, `nomUnivers`,
      `nomFaction`
      FROM `armes`
      INNER JOIN `univers` ON `id_Univers` = `idUnivers`
      INNER JOIN `factions` ON `id_Faction` = `idFaction`
      WHERE `idArmes` = :idArmes";
      $prepare = [['prep' => ':idArmes', 'variable' => $idArmes]];
      $fiche = new readDB($SQL, $prepare);
      $dataArme = $fiche->read();
      if($dataArme[0]['surPuissance'] == 1) {
        $plus = '++';
      } else {
        $plus = '';
      }
      echo
      '<ul>
        <li>Fiche : <strong>'.$dataArme[0]['nom'].'</strong></li>
        <li>'.$dataArme[0]['description'].'</li>
        <li>Type d\'arme : '.$this->typeArme[$dataArme[0]['typeArme']].'</li>
        <li>Puissance '.$dataArme[0]['puissance'].'D'.$plus.'</li>';
        if($dataArme[0]['typeArme'] != 0) {
          echo '<strong><li>Portée tactique : '.$dataArme[0]['maxRange'].' pouces ou '.round($dataArme[0]['maxRange']*2.54, 0).' cm</li>
          <li>Arme lourde : '.$this->yes[$dataArme[0]['lourd']].' - Arme d\'assaut : '.$this->yes[$dataArme[0]['assaut']].'</li>';
          if ($dataArme[0]['couverture'] != 0) {
            echo '<li>Couverture : '.$this->yes[$dataArme[0]['couverture']].' Cadence de tir : '.$dataArme[0]['cadenceTir'].' par tour </li></strong>';
          } else {
            echo '</strong>';
          }
        }
        if ($dataArme[0]['puissanceExplosif'] != 0) {
          echo '<li>Puissance : '.$this->dice[$dataArme[0]['puissanceExplosif']].' - Gabarit : '.$this->gabarit[$dataArme[0]['gabarit']].'</li>';
        }
      echo
      '<li><strong>Options</strong></li>
      <li>Sort '.$this->yes[$dataArme[0]['sort']].'</li>';
      echo '</ul>';
    }
    public function specialRulesFicheArmes ($idArmes) {
      $SQL = "SELECT `id_Rules`, `nomRules`
      FROM `armesRules`
      INNER JOIN `rules` ON `idRules` = `id_Rules`
      WHERE `id_Armes` = :idArmes";
      $parametre = [['prep' => ':idArmes', 'variable' => $idArmes]];
      $listeRules = new readDB($SQL, $parametre);
      $dataRules = $listeRules->read();
      if (!empty($dataRules)) {
        echo '<strong>Règles spéciales : ';
        foreach ($dataRules as $key) {
          echo $key['nomRules'].' ';
        }
        echo '</strong>';
      }

    }
}
//<li>'.$dataArme[0][''].'</li>
