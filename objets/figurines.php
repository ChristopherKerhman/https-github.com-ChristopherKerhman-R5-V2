<?php
class Figurines {
  public $idUser;
  public $idNav;
  public function __construct($idUser, $idNav) {
    $this->idUser = $idUser;
    $this->idNav = $idNav;
    $this->typeFigurine = [['type' => 'Civile', 'Valeur'=> 1, 'PC' => 0.05],
      ['type' => 'Conscrit', 'Valeur'=> 2.8, 'PC' => 0.14],
      ['type' => 'Soldat régulier', 'Valeur'=> 3.6, 'PC' => 0.18],
      ['type' => 'Soutient Tactique', 'Valeur'=> 5, 'PC' => 0.25],
      ['type' => 'Elite', 'Valeur'=> 9, 'PC' => 0.45],
      ['type' => 'Vétéran', 'Valeur'=> 10, 'PC' => 0.5],
      ['type' => 'Officier', 'Valeur'=> 20, 'PC' => 1],
      ['type' => 'Officier suppérieur', 'Valeur'=> 26, 'PC' => 1.3],
      ['type' => 'Mage', 'Valeur'=> 30, 'PC' => 1.5]];
    $this->tailleFigurine = [['taille' => 'Petite', 'Valeur' => 1.5],
      ['taille' => 'Standard', 'Valeur' => 1],
      ['taille' => 'Grande', 'Valeur' => 0.9],
      ['taille' => 'Géante', 'Valeur' => 0.8]];
    $this->dice =[['type' => 'D6', 'Valeur' => 2],
            ['type' => 'D8', 'Valeur' => 4],
            ['type' => 'D10', 'Valeur' => 6],
            ['type' => 'D12', 'Valeur' => 8]];
    $this->pointDeVie = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
    $this->svg = [['armure' => 'Aucune', 'Valeur' => 0.3],
      ['armure' => '6+', 'Valeur' => 0.4],
      ['armure' => '5+', 'Valeur' => 0.5],
      ['armure' => '4+', 'Valeur' => 1],
      ['armure' => '4++', 'Valeur' => 1.25],
      ['armure' => '3+', 'Valeur' => 1.5],
      ['armure' => '3++', 'Valeur' => 2],
      ['armure' => '2+', 'Valeur' => 4]];
    $this->niveauMage = [0, 1, 2, 3];
    $this->yes = ['Non', 'Oui'];
    // Navigation
    // vers formulaires/modifierFigurine.php
    $this->navF = 58;
    // Vers affichage fiche  affichages/ficheFigurine.php
    $this->navG = 59;
    // Vers affichage fiche Dotation arme affichage/ficheDotation.php
    $this->navH = 60;
    // Vers affichafe fiche figurine bonne pour le service
    $this->navI = 63;
  }
  public function ListeNouvelleFigurine ($param, $param1) {
    if($param1 >0) {
      $selectListeNF = "SELECT `idFigurine`, `nomFigurine`
      FROM `figurines`
      INNER JOIN `AffecterFigurineUF` ON `id_Figurine` = `idFigurine`
      WHERE `id_User` = :idUser AND `figurineAffecter` = :param AND `valide` = 1 AND `figurineFixer` = :figurineFixer AND `liste` = 0
      ORDER BY `id_Faction`,`nomFigurine`";
    } else {
      $selectListeNF = "SELECT `idFigurine`, `nomFigurine`
      FROM `figurines`
      WHERE `id_User` = :idUser AND `figurineAffecter` = :param AND `valide` = 1 AND `figurineFixer` = :figurineFixer AND `liste` = 0
      ORDER BY `nomFigurine`";
    }
    $prep = [['prep'=>':idUser', 'variable' => $this->idUser],
            ['prep'=>':param', 'variable' => $param],
            ['prep'=>':figurineFixer', 'variable' => $param1]];
    $liste = new readDB ($selectListeNF, $prep);
    $dataListe = $liste->read();
    return $dataListe;
  }
  public function affichageListe ($data) {
    // Création des éléments pour affecter les figurines à un univers + 1 factions
    $listeFactionUser = "SELECT `idFaction`, `nomFaction`, `nomUnivers`
    FROM `factions`
    INNER JOIN `univers` ON `univers`.`idUnivers` = `factions`.`idUnivers`
    WHERE `idCreateur` = :idUser AND `factions`.`valide` = 1";
    $PreUser = [['prep'=>':idUser', 'variable' => $this->idUser]];
    $factions = new readDB ($listeFactionUser, $PreUser);
    $factionsListe = $factions->read();
    echo '<ul>';
    foreach ($data as $key) {
      echo '<li class="line">
      <form action="CUD/Create/cloneFigurine.php" method="post">
        <input type="hidden" name="idNav" value="'.$this->idNav.'">
        <input type="hidden" name="idFigurine" value="'.$key['idFigurine'].'">
        <button id="clone" type="submit" name="button">Cloner</button>
      </form>
      <strong class="gras">'.$key['nomFigurine'].'</strong>
      <form action="CUD/Create/affecterFigurine.php" method="post">
      <label for="faction">Factions :</label>
      <select name="id_Faction">';
      foreach ($factionsListe as $index) {
        echo '<option value="'.$index['idFaction'].'">'.$index['nomUnivers'].' - '.$index['nomFaction'].'</option>';
      }
      echo '</select>
      <input type="hidden" name="idFigurine" value="'.$key['idFigurine'].'">
      <input type="hidden" name="idNav" value="'.$this->idNav.'">
      <button type="submit" name="button">Affecter</button></form>
      <a class="lienBoutton" href="index.php?idNav='.$this->navG.'&idFigurine='.$key['idFigurine'].'">Fiche</a>
      <a class="lienBoutton" href="index.php?idNav='.$this->navF.'&idFigurine='.$key['idFigurine'].'">Modifier</a>
      <form action="CUD/Delette/figurine.php" method="post">
        <input type="hidden" name="idNav" value="'.$this->idNav.'">
        <input type="hidden" name="idFigurine" value="'.$key['idFigurine'].'">
        <button type="submit" name="button">Effacer</button>
      </form></li>';
    }
    echo '</ul>';
  }
  public function affichageListeAffecter ($data) {
    // Création des éléments pour affecter les figurines à un univers + 1 factions
    $listeFactionUser = "SELECT `idFaction`, `nomFaction`, `nomUnivers`
    FROM `factions`
    INNER JOIN `univers` ON `univers`.`idUnivers` = `factions`.`idUnivers`
    WHERE `idCreateur` = :idUser AND `factions`.`valide` = 1";
    $PreUser = [['prep'=>':idUser', 'variable' => $this->idUser]];
    $factions = new readDB ($listeFactionUser, $PreUser);
    $factionsListe = $factions->read();
    echo '<ul>';
    foreach ($data as $key) {
      $FU = "SELECT `nomUnivers`, `nomFaction`
      FROM `AffecterFigurineUF`
      INNER JOIN `univers` ON `id_Univers` = `idUnivers`
      INNER JOIN `factions` ON `id_Faction` = `idFaction`
      WHERE `id_Figurine` = :idFigurine";
      $prepFU = [['prep'=>':idFigurine', 'variable' => $key['idFigurine']]];
      $readFU = new readDB ($FU, $prepFU);
      $dataFU = $readFU->read();
      echo '<li class="line">
      <strong class="gras">'.$dataFU[0]['nomUnivers'].' '.$dataFU[0]['nomFaction'].' - '.$key['nomFigurine'].'</strong>
      <a class="lienBoutton" href="index.php?idNav='.$this->navG.'&idFigurine='.$key['idFigurine'].'">Fiche</a>
      <form action="CUD/Delette/figurine.php" method="post">
        <input type="hidden" name="idNav" value="'.$this->idNav.'">
        <input type="hidden" name="idFigurine" value="'.$key['idFigurine'].'">
        <button type="submit" name="button">Effacer</button>
      </form>';
  }
}
public function affichageListeEnService ($data) {
  // Création des éléments pour affecter les figurines à un univers + 1 factions
  $listeFactionUser = "SELECT `idFaction`, `nomFaction`, `nomUnivers`
  FROM `factions`
  INNER JOIN `univers` ON `univers`.`idUnivers` = `factions`.`idUnivers`
  WHERE `idCreateur` = :idUser AND `factions`.`valide` = 1";
  $PreUser = [['prep'=>':idUser', 'variable' => $this->idUser]];
  $factions = new readDB ($listeFactionUser, $PreUser);
  $factionsListe = $factions->read();
  echo '<ul>';
  foreach ($data as $key) {
    $FU = "SELECT `nomUnivers`, `nomFaction`
    FROM `AffecterFigurineUF`
    INNER JOIN `univers` ON `id_Univers` = `idUnivers`
    INNER JOIN `factions` ON `id_Faction` = `idFaction`
    WHERE `id_Figurine` = :idFigurine";
    $prepFU = [['prep'=>':idFigurine', 'variable' => $key['idFigurine']]];
    $readFU = new readDB ($FU, $prepFU);
    $dataFU = $readFU->read();
    echo '<li class="line">
    <strong class="gras">'.$dataFU[0]['nomUnivers'].' '.$dataFU[0]['nomFaction'].' - '.$key['nomFigurine'].'</strong>
    <a class="lienBoutton" href="index.php?idNav='.$this->navH.'&idFigurine='.$key['idFigurine'].'">Fiche</a>
    <form action="CUD/Delette/figurine.php" method="post">
      <input type="hidden" name="idNav" value="'.$this->idNav.'">
      <input type="hidden" name="idFigurine" value="'.$key['idFigurine'].'">
      <button type="submit" name="button">Effacer</button>
    </form>';
}
}
  public function readFiche($idFigurine) {
    $fiche = "SELECT `idFigurine`, `id_User`, `nomFigurine`, `description`, `typeFigurine`, `tailleFigurine`, `DQM`, `DC`,
    `svg`, `pdv`, `mouvement`, `valide`, `partager`, `figurineFixer`, `figurineAffecter`, `prix`, `prixFinal`, `vol`, `stationnaire`
    FROM `figurines` WHERE `idFigurine` = :id AND `valide` = 1";
    $preparation = [['prep' => ':id', 'variable'=> $idFigurine]];
    $ficheFigurine = new readDB ($fiche, $preparation);
    return $ficheFigurine->read();
  }
  public function ficheFigurine($data, $idNav){
    // Liste des éléments pour déterminer le prix d'une figurine :
    $DQM = $this->dice[$data[0]['DQM']]['Valeur'];
    $DC = $this->dice[$data[0]['DC']]['Valeur'];
    $type = $this->typeFigurine[$data[0]['typeFigurine']]['Valeur'];
    $taille = $this->tailleFigurine[$data[0]['tailleFigurine']]['Valeur'];
    $mouvement = $data[0]['mouvement']; $vol = $data[0]['vol']; $station = $data[0]['stationnaire'];
    $mouvement = $mouvement + $vol * 2 + $station * 4;
    $sav = $this->svg[$data[0]['svg']]['Valeur'];
    $pointDeVie = $this->pointDeVie[$data[0]['pdv']];
    // Calcul des points de figurine :
    // Intégration des Règles spécial :
    $Modificateurs = "SELECT SUM(`modificateur`) AS `total` FROM `figurinesRules` WHERE `id_Figurine` = :id_Figurine";
    $preparation = [['prep'=>'id_Figurine', 'variable'=> $data[0]['idFigurine']]];
    $action = new readDB($Modificateurs, $preparation);
    $dataMod = $action->read();
    $Modificateurs = "SELECT COUNT(`modificateur`) AS `nbr` FROM `figurinesRules` WHERE `id_Figurine` = :id_Figurine";
    $preparation = [['prep'=>'id_Figurine', 'variable'=> $data[0]['idFigurine']]];
    $action = new readDB($Modificateurs, $preparation);
    $datanbr = $action->read();
    $modificateur = $dataMod[0]['total'] - $datanbr[0]['nbr'] + 1;

    // Fin du calcul du modificateur
    $prixFigurine = ((($DQM + $DC*2) + ($type + $taille + $mouvement + $pointDeVie)) * ($sav + ($pointDeVie / 8))) * $modificateur;
    // Fin calcul
    echo '<h4>'.$data[0]['nomFigurine'].'</h4>
          <ul class="ficheFigurine">';
    echo '<li>Dé Qualité Martial : '.$this->dice[$data[0]['DQM']]['type'].'</li>';
    echo '<li>Dé de Combat : '.$this->dice[$data[0]['DC']]['type'].'</li>';
    echo '<li>Mouvement : '.$data[0]['mouvement'].' "/ '.round($data[0]['mouvement'] * 1.5, 0).'" + 1D4"</li>';
    echo '<li>Vol : '.$this->yes[$data[0]['vol']].' Vol stationnaire : '.$this->yes[$data[0]['stationnaire']].'</li>';
    echo '<li>Type de figurine : '.$this->typeFigurine[$data[0]['typeFigurine']]['type'].'</li>';
    echo '<li>Taille figurine : '.$this->tailleFigurine[$data[0]['tailleFigurine']]['taille'].'</li>';
    echo '<li><strong>Description</strong><p>'.$data[0]['description'].'</p></li>';
    echo '<li>Armure : '.$this->svg[$data[0]['svg']]['armure'].' - Point de vie : '.$this->pointDeVie[$data[0]['pdv']].'</li>';
    echo '<li>Figurine Valide : '.$this->yes[$data[0]['valide']].'</li>';
    echo '<li>Figurine partagée : '.$this->yes[$data[0]['partager']].'</li>';
    echo '<li>Figurine fixée : '.$this->yes[$data[0]['figurineFixer']].'</li>';
    echo '<li>Figurine affectée : '.$this->yes[$data[0]['figurineAffecter']].' </li>';
    echo '<li>Prix figurine brute : '.round($prixFigurine, 0).' points</li>';
    echo '</ul>';
    if($data[0]['figurineAffecter'] > 0) {
      echo '<form action="CUD/Update/serviceFigurine.php" method="post">
          <input type="hidden" name="idFigurine" value="'.$data[0]['idFigurine'].'">
          <input type="hidden" name="prix" value="'.$prixFigurine.'">
          <input type="hidden" name="idNav" value="'.$idNav.'">
          <button class="lienCentrale" type="submit" name="button">Mettre en service</button>
        </form>';
    }
  }
  // Lecteur de fiche simple présentation web.
  public function ficheSimple($data) {
    echo '<h4>Nom figurine : '.$data[0]['nomFigurine'].'</h4>
          <ul class="ficheFigurine">';
    echo '<li>Dé Qualité Martial : '.$this->dice[$data[0]['DQM']]['type'].'</li>';
    echo '<li>Dé de Combat : '.$this->dice[$data[0]['DC']]['type'].'</li>';
    echo '<li>Mouvement : '.$data[0]['mouvement'].' "/ '.round($data[0]['mouvement'] * 1.5, 0).'" + 1D4"</li>';
    echo '<li>Vol : '.$this->yes[$data[0]['vol']].' Vol stationnaire : '.$this->yes[$data[0]['stationnaire']].'</li>';
    echo '<li>Type de figurine : '.$this->typeFigurine[$data[0]['typeFigurine']]['type'].'</li>';
    echo '<li>Taille figurine : '.$this->tailleFigurine[$data[0]['tailleFigurine']]['taille'].'</li>';
    echo '<li><strong>Description</strong><p>'.$data[0]['description'].'</p></li>';
    echo '<li>Armure : '.$this->svg[$data[0]['svg']]['armure'].' - Point de vie : '.$this->pointDeVie[$data[0]['pdv']].'</li>';
    echo '<li>Figurine Valide : '.$this->yes[$data[0]['valide']].'</li>';
    echo '<li>Figurine partagée : '.$this->yes[$data[0]['partager']].'</li>';
    echo '<li>Figurine fixée : '.$this->yes[$data[0]['figurineFixer']].'</li>';
    echo '<li>Figurine affectée : '.$this->yes[$data[0]['figurineAffecter']].' </li>';
    echo '<li>Prix de référence : '.$data[0]['prix'].' points</li>';
    if($data[0]['prixFinal'] > 0) {
      echo '<li>Prix figurine : '.round($data[0]['prixFinal'], 0).' points</li>';
    }
    echo '</ul>';
  }
public function UniversFaction ($idFigurine) {
  $UF = "SELECT `nomUnivers`, `nomFaction`, `id_Faction`
        FROM `AffecterFigurineUF`
        INNER JOIN `factions` ON `idFaction` = `id_Faction`
        INNER JOIN `univers` ON `univers`.`idUnivers` = `id_Univers`
        WHERE `id_Figurine` = :idFigurine";
  $param = [['prep'=>':idFigurine', 'variable'=> $idFigurine]];
  $action = new readDB( $UF, $param);
  $data = $action->read();
  echo '<h3 class="sousTitre">'.$data[0]['nomUnivers'].' - '.$data[0]['nomFaction'].'</h3>';
  return $data;
}

  public function spRules($idFigurine) {
    $triRules = "SELECT `nomRules`
    FROM `figurinesRules`
    INNER JOIN `rules` ON `idRules` = `id_Rules`
    WHERE `id_Figurine` = :idFigurine
    ORDER by `nomRules`";
    $prep = [['prep' => 'idFigurine', 'variable'=> $idFigurine]];
    $listeRules = new readDB($triRules, $prep);
    $dataRules = $listeRules->read();
    if (!empty($dataRules)) {
      echo '<p><strong>Règles spécial :</strong> ';
      foreach ($dataRules as $key) {
        echo '<strong class="affichageSP">'.$key['nomRules'].'</strong>';
      }
      echo '</p>';
    } else {
      echo '<p>Aucune règles spéciales pour cette figurine.</p>';
    }
  }
  public function DelSpecialRules ($iFigurine, $idNav) {
    $SQL = "SELECT `idFigurineRules`, `nomRules`
    FROM `figurinesRules`
    INNER JOIN `rules` ON `idRules` = `id_Rules`
    WHERE `id_Figurine` = :idFigurine
    ORDER BY `nomRules`";
    $parametre = [['prep' => ':idFigurine', 'variable' => $iFigurine]];
    $listeRules = new readDB($SQL, $parametre);
    $dataRules = $listeRules->read();
    if (!empty($dataRules)) {
      echo '<h4 class="sousTitre">Effacer règles spéciales</h4>  <div class="mosaique">';
      foreach ($dataRules as $key) {
        echo '<form class="item" action="CUD/Delette/specialeRulesFigurine.php" method="post">
          <input type="hidden" name="idFigurineRules" value="'.$key['idFigurineRules'].'">
          <input type="hidden" name="id_Figurine" value="'.$iFigurine.'">
          <input type="hidden" name="idNav" value="'.$idNav.'">
          <button type="submit" name="button">'.$key['nomRules'].'</button>
        </form>';
      }
      echo '</div>';
    }
  }
  public function dotationArme($idFigurine) {
    $dotationSQL = "SELECT`id_Armes`, `coef` FROM `dotationFigurine` WHERE `id_Figurine` = :idFigurine";
    $param = [['prep'=> ':idFigurine', 'variable'=>$idFigurine]];
    $listeDotation = new readDB($dotationSQL, $param);
    return $dotation = $listeDotation->read();
  }
  public function calculPrixFigurine($idFigurine) {
    // Calcul du coef de la figurine et du prix de la figurine
    $dotationSQL = "SELECT SUM(`coef`) AS `total`
    FROM `dotationFigurine` WHERE `id_Figurine` = :idFigurine
    UNION SELECT `prix` FROM `figurines` WHERE `idFigurine` = :idFigurine";
    $param = [['prep'=> ':idFigurine', 'variable'=>$idFigurine]];
    $sum = new readDB($dotationSQL, $param);
    $dotation = $sum->read();
    $prix = $dotation[1]['total'];
    $coef = $dotation[0]['total'];
    // Calcul du prix de la figurine
    $prixFinal = $prix * $coef;
    return $prixFinal;
  }
  public function delArmeAffecter ($idFigurine, $idNav) {
    $triArmes = "SELECT `idDotation`, `nom`
    FROM `dotationFigurine`
    INNER JOIN `armes` ON `idArmes` = `id_Armes`
    WHERE `id_Figurine` = :idFigurine";
    $param = [['prep'=> ':idFigurine', 'variable'=>$idFigurine]];
    $armesAffecter = new readDB($triArmes, $param);
    $listeArmes = $armesAffecter->read();
    echo '
    <h4 class="sousTitre">Armes affecter</h4>
    <div class="mosaique">';
    foreach ($listeArmes as $key) {
            echo '
            <form class="item" action="CUD/Delette/affectationArme.php" method="post">
              <input type="hidden" name="idDotation" value="'.$key['idDotation'].'">
              <input type="hidden" name="idFigurine" value="'.$idFigurine.'">
              <input type="hidden" name="idNav" value="'.$idNav.'">
              <button type="submit" name="button">'.$key['nom'].'</button>
            </form>';
          }
      echo '</div>';
    }
    public function listeFigOk() {
      $triOk = "SELECT `idFigurine`, `nomFigurine`, `typeFigurine`, `nomFaction`, `nomUnivers`
      FROM `figurines`
      INNER JOIN `AffecterFigurineUF` ON `id_Figurine` = `idFigurine`
      INNER JOIN `factions` ON `idFaction` = `AffecterFigurineUF`.`id_Faction`
      INNER JOIN `univers` ON `univers`.`idUnivers` = `AffecterFigurineUF`.`id_Univers`
      WHERE `id_User` = :idUser AND `liste` = 1
      ORDER BY `id_Faction`,`nomFigurine`";
      $prep = [['prep'=>'idUser', 'variable'=>$this->idUser]];

      $liste = new readDB ($triOk, $prep);
      $dataListe = $liste->read();
      echo '<h3 class="sousTitre">Liste des figurines près pour le combat</h3><ul>';
      foreach ($dataListe as $key) {
        echo '<li>'.$key['nomUnivers'].' '.$key['nomFaction'].'
        '.$key['nomFigurine'].' '.$this->typeFigurine[$key['typeFigurine']]['type'].'
          <a class="lienBoutton" href="index.php?idNav='.$this->navI.'&idFigurine='.$key['idFigurine'].'">Fiche</a></li>';
      }
      echo '</ul>';
    }
  }
