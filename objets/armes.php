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
  public function securiteID ($idArmes) {
    $SQL = "SELECT `idArmes`, `fixer` FROM `armes` WHERE `idArmes` = :id";
    $param = [['prep'=>':id', 'variable'=> $idArmes]];
    $verifID = new readDB($SQL, $param);
    $dataID = $verifID->read();
    return $dataID;
  }
  public function listeArmesHS () {
    // On selectionne les armes HS
    $SQL = "SELECT `idArmes`, `id_Univers`, `nomUnivers`, `nomFaction`, `nom`, `typeArme`  FROM `armes`
    INNER JOIN `univers` ON `id_Univers` = `idUnivers`
      INNER JOIN `factions` ON `id_Faction` = `idFaction`
    WHERE `armes`.`idCreateur` = :idUser AND `armes`.`valide` = 0 ORDER BY `nomUnivers`, `nomFaction`, `nom`";
    $prepare = [['prep' => ':idUser', 'variable' => $this->idUser]];
    $liste = new readDB($SQL, $prepare);
    $dataListe = $liste->read();
    echo '<h3 class="sousTitre">Les armes mise hors dotation futur</h3><ul>';
    foreach ($dataListe as $key) {
      echo '<li>Univers '.$key['nomUnivers'].' Faction '.$key['nomFaction'].' - '.$key['nom'].' - Type : '.$this->typeArme[$key['typeArme']].'
        <a class="lienBoutton" href="index.php?idNav='.$this->adressFicheFixer.'&idArmes='.$key['idArmes'].'">Fiche</a></li>';
    }
    echo '</ul>';
  }
  public function listeArmes ($fixer) {
    // Paramètre pour fixer, 0 -> Non fixer, 1 -> fixer
    $SQL = "SELECT `idArmes`, `id_Univers`, `nomUnivers`, `nomFaction`, `nom`, `typeArme`, `prix`  FROM `armes`
    INNER JOIN `univers` ON `id_Univers` = `idUnivers`
      INNER JOIN `factions` ON `id_Faction` = `idFaction`
    WHERE `armes`.`idCreateur` = :idUser AND `fixer` = $fixer AND `armes`.`valide` = 1 ORDER BY `nomUnivers`, `nomFaction`, `nom`";
    $prepare = [['prep' => ':idUser', 'variable' => $this->idUser]];
    $liste = new readDB($SQL, $prepare);
    $dataListe = $liste->read();
    foreach ($dataListe as $key) {
        echo'<li class="line">';
        if ($fixer == 1) {
        echo '<form action="CUD/Update/HSarmes.php" method="post">
          <input type="hidden" name="idArmes" value="'.$key['idArmes'].'">
          <input type="hidden" name="idNav" value="'.$this->idNav.'">
          <button type="submit" name="button">Mettre hors service</button>
        </form>
        <a class="lienBoutton" href="index.php?idNav='.$this->adressFicheFixer.'&idArmes='.$key['idArmes'].'">Fiche</a>';
      } else {
      echo '
      <form action="CUD/Update/fixer.php" method="post">
        <input type="hidden" name="fixer" value="'.$fixer.'">
        <input type="hidden" name="idArmes" value="'.$key['idArmes'].'">
        <input type="hidden" name="idNav" value="'.$this->idNav.'">
        <button type="submit" name="button">Fixer</button>
        </form>
      <form action="CUD/Delette/armes.php" method="post">
        <input type="hidden" name="idArmes" value="'.$key['idArmes'].'">
        <input type="hidden" name="idNav" value="'.$this->idNav.'">
        <button type="submit" name="button">Effacer</button>
      </form>
      <a class="lienBoutton" href="index.php?idNav='.$this->adressFicheFixer.'&idArmes='.$key['idArmes'].'">Fiche</a>';
    }
        echo 'Univers '.$key['nomUnivers'].' Faction '.$key['nomFaction'].' - '.$key['nom'].' - Type : '.$this->typeArme[$key['typeArme']];
          if ($fixer == 1) {
            echo ' / Coef ='.round($key['prix'],3);
          }
        echo'</li>';
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
      echo '<table>';
      echo '<tr>
            <th>Cloner</th>
            <th>Nom arme</th>

            <th>Affecter</th>
            <th>effacer</th>
            </tr>';


      foreach ($dataListe as $key) {
        $prix = new Armes ($this->idUser, $this->idNav);
        $prixArme = $prix->valeurArmes($key['idArmes']);
        $requetteSQL = "SELECT `idFaction`, `nomFaction`
        FROM `factions`
        WHERE `valide` = 1 AND `idUnivers` = :idUnivers";
        $pre = [['prep' => ':idUnivers', 'variable' => $key['id_Univers']]];
        $action = new readDB($requetteSQL, $pre);
        $listeFaction = $action->read();

        echo
        '<tr>
          <td>
          <form action="CUD/Create/cloneArmes.php" method="post">
          <input type="hidden" name="idArmes" value="'.$key['idArmes'].'">
          <input type="hidden" name="idNav" value="'.$this->idNav.'">
          <button id="clone" type="submit" name="button">Cloner</button>
          </form>
          </td>
          <td>
            '.$key['nomUnivers'].' - '.$key['nom'].' - Type : '.$this->typeArme[$key['typeArme']].' Coef : '.round($prixArme, 3).'
            <form action="CUD/Update/nomArmes.php" method="post">
            <label for="nom">Nom arme</label>
            <input type="text" name="nom" value="'.$key['nom'].'" />
            <input type="hidden" name="idArmes" value="'.$key['idArmes'].'">
            <input type="hidden" name="idNav" value="'.$this->idNav.'">
            <button class="lienBoutton" type="submit" name="button">Modifier</button>
            </form>
          </td>
          <td>
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
          </td>
          <td>
          <form action="CUD/Delette/armes.php" method="post">
            <input type="hidden" name="idArmes" value="'.$key['idArmes'].'">
            <input type="hidden" name="idNav" value="'.$this->idNav.'">
            <button type="submit" name="button">Effacer</button>
          </form>
          </td>



        </tr>';
      }
      echo '</table>';
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
        $prix = new Armes ($this->idUser, $this->idNav);
        $prixArme = $prix->valeurArmes($key['idArmes']);
        echo '<li class="line"> '.$key['nomUnivers'].' Faction : '.$key['nomFaction'].' - '.$key['nom'].' - Type : '.$this->typeArme[$key['typeArme']].'
        Coef : '.round($prixArme, 3).'
        <form action="CUD/Delette/armes.php" method="post">
          <input type="hidden" name="idArmes" value="'.$key['idArmes'].'">
          <input type="hidden" name="idNav" value="'.$this->idNav.'">
          <button type="submit" name="button">Effacer</button>
          <a class="lienBoutton" href="index.php?idNav='.$this->adressFiche.'&idArmes='.$key['idArmes'].'">Add RS</a>
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
      echo '<li>Coefficient : '.round($puissanceArme, 3).'</li></ul>';
    }
    public function ficheArmeListe($idArmes, $puissanceArme) {
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
      '<ul class="resume">
        <li>'.$dataArme[0]['nom'].' | Type d\'arme : '.$this->typeArme[$dataArme[0]['typeArme']].' |
        Puissance '.$dataArme[0]['puissance'].'D'.$plus.' ';
        if($dataArme[0]['typeArme'] != 0) {
          echo 'Portée tactique : '.$dataArme[0]['maxRange'].'" Arme lourde : '.$this->yes[$dataArme[0]['lourd']].' - Arme d\'assaut : '.$this->yes[$dataArme[0]['assaut']].'';
          if ($dataArme[0]['couverture'] != 0) {
            echo ' - Couverture : '.$this->yes[$dataArme[0]['couverture']].' - Cadence de tir : '.$dataArme[0]['cadenceTir'].' par tour ';
          }
        }
        if ($dataArme[0]['puissanceExplosif'] != 0) {
          echo 'Puissance : '.$this->dice[$dataArme[0]['puissanceExplosif']].' - Gabarit : '.$this->gabarit[$dataArme[0]['gabarit']].'';
        }
        if ($dataArme[0]['sort'] > 0) {
          echo'Sort '.$this->yes[$dataArme[0]['sort']].'';
        }
        echo '</li>';
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
            echo $key['nomRules'].' . ';
          }
          echo '</strong>';
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
          echo $key['nomRules'].' . ';
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
      //Nombre de règles spéciales
      $SQLnbrRules = "SELECT COUNT(`idAffectation`) AS `nbr` FROM `armesRules` WHERE `id_Armes` = :idArmes";
      $nbr = new readDB($SQLnbrRules, $parametre);
      $nbrRules = $nbr->read();
      $nbr = $nbrRules[0]['nbr'];
      // Formule de calcul de la valeur de l'arme :
      $puissance = $dataArmes[0]['typeArme'] + 1;
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
          return $puissance/50;
      } else {
        $taux = $tauxRules[0]['taux'];
        $puissance;
        return (($puissance * ($taux-$nbr+1))/50);
      }
    }
    public function readArmes ($idFaction) {
      $tri = "SELECT `idArmes`,`nom`, `description`, `typeArme`, `puissance`, `maxRange`, `surPuissance`, `sort`,
      `assaut`, `couverture`, `cadenceTir`, `lourd`, `puissanceExplosif`, `gabarit`,
      `fixer`, `valide`, `prix` FROM `armes` WHERE `id_Faction` = :idFaction AND
      `valide` = 1 AND `fixer` = 1
      ORDER BY `typeArme`, `nom`";
      $param = [['prep'=> ':idFaction', 'variable'=>$idFaction]];
      $readArme = new readDB($tri, $param);
      $data = $readArme->read();
      return $data;
    }
    public function readOneArmes ($idArmes) {
      $tri = "SELECT `idArmes`,`nom`, `description`, `typeArme`, `puissance`, `maxRange`, `surPuissance`, `sort`,
      `assaut`, `couverture`, `cadenceTir`, `lourd`, `puissanceExplosif`, `gabarit`,
      `fixer`, `valide`, `prix` FROM `armes` WHERE `idArmes` = :idArmes AND
      `valide` = 1 AND `fixer` = 1
      ORDER BY `typeArme`, `nom`";
      $param = [['prep'=> ':idArmes', 'variable'=>$idArmes]];
      $readArme = new readDB($tri, $param);
      $data = $readArme->read();
      return $data;
    }
    public function resumeArme($data, $DC){
      echo '<lu class="resume">';
      foreach ($data as $key) {
        if($key['surPuissance'] >0) {
          $SP = '++';
        } else {
          $SP = '';
        }
        if($key['typeArme'] > 0) {
          $range = 'Portée :'.$key['maxRange'].'"';
        } else {
          $range = 'NA';
        }
        if ($key['sort'] == 1) {
          $sort = ' | Sort : Oui';
        } else {
            $sort = '';
        }
        if ($key['couverture'] == 1) {
          $couverture = '| Couverture :'.$this->yes[$key['couverture']].'| Cadence de tir :'.$key['cadenceTir'].' tir/tour';
        } else {
          $couverture = '';
        }
        if ($key['typeArme'] == 0) {
          echo '<li> '.$key['nom'].' | Type :'.$this->typeArme[$key['typeArme']].' | Puissance '.$key['puissance'].$this->dice[$DC].$SP.$sort.'</li>';
        }
        if($key['typeArme'] == 1) {
          echo '<li>'.$key['nom'].' | Type :'.$this->typeArme[$key['typeArme']].' | '.$key['puissance'].$this->dice[$DC].$SP.' |
           '.$range.$sort.' | Assaut : '.$this->yes[$key['assaut']].$couverture.' | Arme lourde : '.$this->yes[$key['lourd']].'</li>';
        }
        if($key['typeArme'] == 2) {
        echo '<li>'.$key['nom'].' | Type :'.$this->typeArme[$key['typeArme']].' | '.$key['puissance'].$this->dice[$DC].$SP.' |
         '.$range.$sort.' | Assaut : '.$this->yes[$key['assaut']].$couverture.' | Arme lourde : '.$this->yes[$key['lourd']].' | Type de gabarit : '.$this->gabarit[$key['gabarit']].'
         | Puissance explosif '.$this->dice[$key['puissanceExplosif']].'</li>';
       }
        //Recherche RS armes :
        $SQLRS = "SELECT `nomRules`
        FROM `armesRules`
        INNER JOIN `rules` ON `idRules` = `id_Rules`
        WHERE `id_Armes` = :idArmes";
        $param = [['prep'=>':idArmes', 'variable'=> $key['idArmes']]];
        $readRules = new readDB($SQLRS, $param);
        $ListeRules = $readRules->read();

        if (!empty($ListeRules[0]['nomRules'])) {
          echo '<li>Régles spéciales : ';
          foreach ($ListeRules as $key) {
            echo '<strong class="affichageSP">'.$key['nomRules'].'</strong>';
          }
          echo '</li>';
        }
        // Fin recherche des RS armes

      }
      echo '</lu>';
    }
    public function resumeArmeListe($data, $DC){
      echo '<lu class="resume">';
      foreach ($data as $key) {
        if($key['surPuissance'] >0) {
          $SP = '++';
        } else {
          $SP = '';
        }
        if($key['typeArme'] > 0) {
          $range = 'Portée :'.$key['maxRange'].'"';
        } else {
          $range = 'NA';
        }
        if ($key['sort'] == 1) {
          $sort = ' | Sort : Oui';
        } else {
            $sort = '';
        }
        if ($key['couverture'] == 1) {
          $couverture = '| Couverture :'.$this->yes[$key['couverture']].'| Cadence de tir :'.$key['cadenceTir'].' tir/tour |';
        } else {
          $couverture = '';
        }
        if ($key['typeArme'] == 0) {
          echo '<li>'.$key['nom'].' | Type :'.$this->typeArme[$key['typeArme']].' | Puissance '.$key['puissance'].$this->dice[$DC].$SP.$sort.'</li>';
        }
        if($key['typeArme'] == 1) {
          echo '<li>'.$key['nom'].' | Type :'.$this->typeArme[$key['typeArme']].' | '.$key['puissance'].$this->dice[$DC].$SP.' |
           '.$range.$sort.' | Assaut : '.$this->yes[$key['assaut']].$couverture.' | Arme lourde : '.$this->yes[$key['lourd']].'</li>';
        }
        if($key['typeArme'] == 2) {
        echo '<li>'.$key['nom'].' | Type :'.$this->typeArme[$key['typeArme']].' | '.$key['puissance'].$this->dice[$DC].$SP.' |
         '.$range.$sort.' | Assaut : '.$this->yes[$key['assaut']].$couverture.' | Arme lourde : '.$this->yes[$key['lourd']].' | Type de gabarit : '.$this->gabarit[$key['gabarit']].'
         | Puissance explosif '.$this->dice[$key['puissanceExplosif']].'</li>';
       }
        //Recherche RS armes :
        $SQLRS = "SELECT `nomRules`
        FROM `armesRules`
        INNER JOIN `rules` ON `idRules` = `id_Rules`
        WHERE `id_Armes` = :idArmes";
        $param = [['prep'=>':idArmes', 'variable'=> $key['idArmes']]];
        $readRules = new readDB($SQLRS, $param);
        $ListeRules = $readRules->read();

        if (!empty($ListeRules[0]['nomRules'])) {
          echo '<li class="RSFiche">Régles spéciales '.$key['nom'].' : ';
          foreach ($ListeRules as $key) {
            echo '<strong id="listeFiche">'.$key['nomRules'].'</strong> . ';
          }
          echo '</li>';
        }
        // Fin recherche des RS armes

      }
      echo '</lu>';
    }
  public function mosaiqueArmes($data, $id, $idNav, $type) {
    echo '
    <h4 class="sousTitre">Affectation des armes</h4>';
    if ($type == 0) {
      echo ' <div class="mosaique">';
      foreach ($data as $key) {
        echo '
        <form class="item" action="CUD/Create/affectationArme.php" method="post">
          <input type="hidden" name="idArmes" value="'.$key['idArmes'].'">
          <input type="hidden" name="idFigurine" value="'.$id.'">
          <input type="hidden" name="idNav" value="'.$idNav.'">
          <button type="submit" name="button">'.$key['nom'].'</button>
        </form>';
  }
    echo '</div>';
    } else {
      echo ' <div class="mosaique">';
      foreach ($data as $key) {
        echo '
        <form class="item" action="CUD/Create/affectationArmeVehicule.php" method="post">
          <input type="hidden" name="id_Armes" value="'.$key['idArmes'].'">
          <input type="hidden" name="id_Vehicule" value="'.$id.'">
          <input type="hidden" name="idNav" value="'.$idNav.'">
          <button type="submit" name="button">'.$key['nom'].'</button>
        </form>';
  }
    echo '</div>';
    }
  }
  public function listeAdministrationArmes ($data, $page) {
    echo '<table>
      <caption>Table des armes page : '.$page.'</caption>
      <tr>
        <th>Id</th>
        <th>Createur</th>
        <th>Univers</th>
        <th>Faction</th>
        <th>Nom</th>
        <th>Prix</th>
        <th>Fixer</th>
        <th>Valide</th>
        <th>Fiche</th>
        <th>Effacer</th>
      </tr>';
      foreach ($data as $key => $value) {
    echo '<tr>
          <td>'.$value['idArmes'].'</td>
          <td>'.$value['login'].'</td>
          <td>'.$value['nomUnivers'].'</td>
          <td>'.$value['nomFaction'].'</td>
          <td>'.$value['nom'].'</td>
          <td>'.$value['prix'].'</td>
          <td>'.$this->yes[$value['fixer']].'</td>
          <td>'.$this->yes[$value['valide']].'</td>
          <td><a class="lienBoutton" href="index.php?idNav='.$this->adressFicheFixer.'&idArmes='.$value['idArmes'].'">Fiche</a></td>
          <td><form action="administration/armes.php" method="post">
                  <input type="hidden" name="idArmes" value="'.$value['idArmes'].'">
                  <input type="hidden" name="idNav" value="'.$this->idNav.'">
                  <button type="submit" name="button">Effacer</button>
                </form>
            </td>
        </tr>';
      }
      echo '</table>';
  }
  public function listeArmesPagination($data, $pages) {
    echo '<table>
      <caption>Table des armes fixées page : '.$pages.'</caption>
      <tr>
        <th>Univers</th>
        <th>Faction</th>
        <th>Nom</th>
        <th>Coef</th>
        <th>Fiche</th>
      </tr>';
      foreach ($data as $key => $value) {
    echo '<tr>
          <td>'.$value['nomUnivers'].'</td>
          <td>'.$value['nomFaction'].'</td>
          <td>'.$value['nom'].'</td>
          <td>'.round($value['prix'], 3).'</td>
          <td><a class="lienBoutton" href="index.php?idNav='.$this->adressFicheFixer.'&idArmes='.$value['idArmes'].'">Fiche</a></td>
        </tr>';
      }
      echo '</table>';
  }

}
