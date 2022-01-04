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
    $this->adressFicheFixer = 54;
  }
  public function listeArmes ($fixer) {
    // Paramètre pour fixer, 0 -> Non fixer, 1 -> fixer
    $SQL = "SELECT `idArmes`, `id_Univers`, `nomUnivers`, `nomFaction`, `nom`, `typeArme`  FROM `armes`
    INNER JOIN `univers` ON `id_Univers` = `idUnivers`
      INNER JOIN `factions` ON `id_Faction` = `idFaction`
    WHERE `armes`.`idCreateur` = :idUser AND `fixer` = $fixer ORDER BY `nomUnivers`, `nom`";
    $prepare = [['prep' => ':idUser', 'variable' => $this->idUser]];
    $liste = new readDB($SQL, $prepare);
    $dataListe = $liste->read();
    foreach ($dataListe as $key) {
        echo
        '<li class="line">
          Univers '.$key['nomUnivers'].' Faction '.$key['nomFaction'].' - '.$key['nom'].' - Type : '.$this->typeArme[$key['typeArme']].'
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
            echo '<button type="submit" name="button">Non fixer</button>
            <a class="lienBoutton" href="index.php?idNav='.$this->adressFicheFixer.'&idArmes='.$key['idArmes'].'">Fiche</a>';
          } else {
            echo '<button type="submit" name="button">Fixer</button>
            <a class="lienBoutton" href="index.php?idNav='.$this->adressFicheFixer.'&idArmes='.$key['idArmes'].'">Fiche</a>';
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
    public function ficheArme ($idArmes, $puissanceArme) {
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
        <li>Coefficient : '.round($puissanceArme, 3).' points</li>
        <li>Puissance '.$dataArme[0]['puissance'].'D'.$plus.'</li>';
        if($dataArme[0]['typeArme'] != 0) {
          echo '<strong><li>Portée tactique : '.$dataArme[0]['maxRange'].' pouces ou '.round($dataArme[0]['maxRange']*2.54, 0).' cm</li>
          <li>Arme lourde : '.$this->yes[$dataArme[0]['lourd']].' - Arme d\'assaut : '.$this->yes[$dataArme[0]['assaut']].'</li>';
          if ($dataArme[0]['couverture'] != 0) {
            echo '<li>Couverture : '.$this->yes[$dataArme[0]['couverture']].' - Cadence de tir : '.$dataArme[0]['cadenceTir'].' par tour </li></strong>';
          } else {
            echo '</strong>';
          }
        }
        if ($dataArme[0]['puissanceExplosif'] != 0) {
          echo '<li><strong>Puissance : '.$this->dice[$dataArme[0]['puissanceExplosif']].' - Gabarit : '.$this->gabarit[$dataArme[0]['gabarit']].'</strong></li>';
        }
        if ($dataArme[0]['sort'] > 0) {
          echo'<strong><li>Sort '.$this->yes[$dataArme[0]['sort']].'</li></strong>';
        }
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
    public function DelSpecialRules ($idArmes, $idNav) {
      $SQL = "SELECT `idAffectation`, `id_Rules`, `nomRules`
      FROM `armesRules`
      INNER JOIN `rules` ON `idRules` = `id_Rules`
      WHERE `id_Armes` = :idArmes";
      $parametre = [['prep' => ':idArmes', 'variable' => $idArmes]];
      $listeRules = new readDB($SQL, $parametre);
      $dataRules = $listeRules->read();
      if (!empty($dataRules)) {
        echo '<h4 class="sousTitre">Effacer règles spéciales</h4>  <div class="mosaique">';
        foreach ($dataRules as $key) {
          echo '<form class="item" action="CUD/Delette/specialeRules.php" method="post">
            <input type="hidden" name="idAffectation" value="'.$key['idAffectation'].'">
            <input type="hidden" name="idArmes" value="'.$idArmes.'">
            <input type="hidden" name="idNav" value="'.$idNav.'">
            <button type="submit" name="button">'.$key['nomRules'].'</button>
          </form>';
        }
        echo '</div>';
      }
    }
    public function valeurArmes ($idArmes) {
      $SQLarme = "SELECT `idArmes`, `typeArme`, `puissance`, `maxRange`, `surPuissance`, `sort`, `assaut`, `couverture`, `cadenceTir`,
      `lourd`, `puissanceExplosif`, `gabarit`
      FROM `armes`
      WHERE `idArmes` = :idArmes";
      $parametre = [['prep' => ':idArmes', 'variable' => $idArmes]];
      $readArme = new readDB($SQLarme, $parametre);
      $dataArmes = $readArme->read();
      $SQLrules = "SELECT SUM(`tauxRules`) AS `taux` FROM `armesRules` WHERE `id_Armes` = :idArmes";
      $readRules = new readDB($SQLrules, $parametre);
      $tauxRules = $readRules->read();
      // Formule de calcul de la valeur de l'arme :
      $puissance = $dataArmes[0]['typeArme'] + 2;
      $puissance = (($dataArmes[0]['puissance'] +1) * 2) + $puissance;
      $puissance = (log($dataArmes[0]['maxRange'] + 1)) + $puissance;
      if ($dataArmes[0]['surPuissance'] != 0){
        $puissance = $puissance * 2;
      }
      if ($dataArmes[0]['sort'] != 0){
        $puissance = ($puissance * 1.2) + $puissance;
      }
      if ($dataArmes[0]['assaut'] != 0){
        $puissance = ($puissance * 1.1) + $puissance;
      }
      if ($dataArmes[0]['couverture'] != 0){
        $puissance = (($dataArmes[0]['couverture'] + $dataArmes[0]['cadenceTir'])/2) + $puissance;
      }
      if ($dataArmes[0]['lourd'] != 0) {
        $puissance = ($puissance * 1.3) + $puissance;
      }
      if ($dataArmes[0]['typeArme'] == 2) {
        $puissance = (($dataArmes[0]['gabarit'] * 3) + $dataArmes[0]['puissanceExplosif'] + 2) + $puissance;
      }
      // On sort la valeur de l'arme
      if (empty($tauxRules[0]['taux'])) {
          return $puissance;
      } else {
        $taux = $tauxRules[0]['taux'];
        $puissance = (($taux * $puissance)/100)+1;
        return $puissance;
      }
    }
}
//<li>'.$dataArme[0][''].'</li>
