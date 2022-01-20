<?php
class Vehicules {
  private $idUser;
  private $idNav;
  public function __construct($idUser, $idNav) {
    $this->idUser = $idUser;
    $this->idNav = $idNav;
    $this->typeVehicule = [['type'=>'Civile', 'valeur'=>0.5], ['type'=>'Militaire', 'valeur'=>2]];
    $this->roleVehicule = [['role'=>'transport', 'valeur'=>1, 'PC'=>0.05],
                          ['role'=>'Soutient tactique', 'valeur'=>2, 'PC'=>1],
                          ['role'=>'Attaque rapide', 'valeur'=>3, 'PC'=>0.5],
                          ['role'=>'Véhicule de commandement', 'valeur'=>5, 'PC'=>2],
                          ['role'=>'Artillerie', 'valeur'=>1, 'PC'=>0.05]];
    $this->dice =[['type' => 'D6', 'valeur' => 1],
                  ['type' => 'D8', 'valeur' => 2],
                  ['type' => 'D10', 'valeur' => 3],
                  ['type' => 'D12', 'valeur' => 4]];
    $this->tailleVehicule = [ ['taille' => 'Petit', 'valeur' => 0.75],
                              ['taille' => 'Standard', 'valeur' => 0.5],
                              ['taille' => 'Grand', 'valeur' => 0.45],
                              ['taille' => 'Géant', 'valeur' => 0.4]];
    $this->pds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
    $this->equipage = [['nbre'=>0, 'valeur'=>0],
                      ['nbre'=> 1, 'valeur'=>0.5],
                      ['nbre'=> 2, 'valeur'=>1],
                      ['nbre'=> 3, 'valeur'=>1.5],
                      ['nbre'=> 4, 'valeur'=>2],
                      ['nbre'=> 5, 'valeur'=>3],
                      ['nbre'=> 6, 'valeur'=>4]];
    $this->passager = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    $this->svgVehicule = [['armure' => 'Aucune', 'valeur' => 0.1],
                          ['armure' => '6+', 'valeur' => 0.12],
                          ['armure' => '5+', 'valeur' => 0.24],
                          ['armure' => '4+', 'valeur' => 0.48],
                          ['armure' => '4++', 'valeur' => 0.75],
                          ['armure' => '3+', 'valeur' => 0.9],
                          ['armure' => '3++', 'valeur' => 1],
                          ['armure' => '2+', 'valeur' => 2]];
    $this->yes = ['Non', 'Oui'];
    // A présiser lors de la mise en service des fiches.
    // Fiche véhicule + ajoute de règles spéciales
    $this->navFV = 67;
    // Fiche véhicule + ajoute de armes
    $this->navFW = 69;
    // Modif véhicule
    $this->navMV = 68;
    //Affichage fiche Véhicule sans modification
    $this->navFVsite = 70;
  }
  public function readVehicule($idVehicule) {
    $vehicule = "SELECT `idVehicule`, `nomVehicule`, `description`, `typeVehicule`, `roleVehicule`, `tailleVehicule`,
    `equipage`, `passage`, `vol`, `stationnaire`, `DQM`, `DC`, `pds`, `svgVehicule`, `deplacement`, `id_univers`,
    `id_faction`, `valide`, `fixer`, `service`, `partager`, `prixVehicule`
    FROM `transport`
    WHERE `idVehicule` = :idVehicule";
    $param = [['prep'=>':idVehicule', 'variable'=>$idVehicule]];
    $readVehicule = new readDB($vehicule, $param);
    $dataVehicule = $readVehicule->read();
    return $dataVehicule;
  }

  public function attribution() {
    // Liste des univers et des faction associé.
    $triFU = "SELECT `idFaction`, `factions`.`idUnivers`, `nomFaction`, `nomUnivers`
    FROM `factions`
    INNER JOIN `univers` ON `univers`.`idUnivers` = `factions`.`idUnivers`
    WHERE `idCreateur` = :idUser
    ORDER BY `nomUnivers`";
    $param = [['prep'=> ':idUser', 'variable'=> $this->idUser]];
    $liste = new readDB($triFU, $param);
    $dataListeFU = $liste->read();
    // Trie des véhicules
    $triVehicule = "SELECT `idVehicule`, `nomVehicule`
    FROM `transport` WHERE `idUser` = :idUser AND `id_univers` = 0";
    $listeVehicule = new readDB($triVehicule, $param);
    $dataListeVehicule = $listeVehicule->read();
    //print_r($dataListeVehicule);
    echo '<ul>';
    foreach ($dataListeVehicule as $key => $value) {
      $vehicule = new Vehicules ($this->idNav, $this->idUser);
      $prix = $vehicule->prixBrute($value['idVehicule']);
    echo '<li class="line">
    <form action="CUD/Create/cloneVehicule.php" method="post">
      <input type="hidden" name="idNav" value="'.$this->idNav.'">
      <input type="hidden" name="idVehicule" value="'.$value['idVehicule'].'">
      <button id="clone" type="submit" name="button">Cloner</button>
    </form>
   <strong class="gras">'.$value['nomVehicule'].' / '.round($prix,0).' points</strong> <form action="CUD/Update/affectationVehicule.php" method="post">
    <select name="FU">
    ';
      foreach ($dataListeFU as $index => $valeur) {
        echo '<option value="'.$valeur['idUnivers'].','.$valeur['idFaction'].'">'.$valeur['nomUnivers'].'- '.$valeur['nomFaction'].'</option>';
      }
    echo'</select>
    <input type="hidden" name="idVehicule" value="'.$value['idVehicule'].'">
    <input type="hidden" name="idNav" value="'.$this->idNav.'">
    <button type="submit" name="button">Affecter</button>
    </form>
    <a class="lienBoutton" href="index.php?idNav='.$this->navFV.'&idVehicule='.$value['idVehicule'].'">Fiche</a>
    <a class="lienBoutton" href="index.php?idNav='.$this->navMV.'&idVehicule='.$value['idVehicule'].'">Modifier</a>
    <form action="CUD/Delette/vehicule.php" method="post">
      <input type="hidden" name="idNav" value="'.$this->idNav.'">
      <input type="hidden" name="id" value="'.$value['idVehicule'].'">
      <button type="submit" name="button">Effacer</button>
    </form></li>';
      }
    echo '</ul>';
  }
  public function listeVehicule($service) {
    $param = [['prep'=> ':idUser', 'variable'=> $this->idUser], ['prep'=>':service', 'variable'=>$service]];
    $triVehicule = "SELECT `idVehicule`, `nomVehicule`, `nomUnivers`, `nomFaction`, `service`
    FROM `transport`
    INNER JOIN `univers` ON `idUnivers` = `id_Univers`
    INNER JOIN `factions` ON `idFaction` = `id_Faction`
    WHERE `idUser` = :idUser AND `id_univers` > 0 AND `service` = :service
    ORDER BY `nomUnivers`, `nomFaction`, `nomVehicule`";
    $listeVehicule = new readDB($triVehicule, $param);
    $dataListeVehicule = $listeVehicule->read();
    echo '<ul>';
    foreach ($dataListeVehicule as $key => $value) {
      if ($value['service'] == 0) {
        $vehicule = new Vehicules ($this->idNav, $this->idUser);
        $prix = $vehicule->prixBrute($value['idVehicule']);
        echo '<li class="line">'.$value['nomUnivers'].' '.$value['nomFaction'].' <strong class="gras">'.$value['nomVehicule'].' / '.round($prix,0).' points</strong>
        <a class="lienBoutton" href="index.php?idNav='.$this->navFV.'&idVehicule='.$value['idVehicule'].'">Add RS</a>
        <a class="lienBoutton" href="index.php?idNav='.$this->navFW.'&idVehicule='.$value['idVehicule'].'">Add Arme</a>
        <form action="CUD/Delette/vehicule.php" method="post">
          <input type="hidden" name="idNav" value="'.$this->idNav.'">
          <input type="hidden" name="id" value="'.$value['idVehicule'].'">
          <button type="submit" name="button">Effacer</button>
        </form>
        </li>';
      } else {
        $vehicule = new Vehicules ($this->idNav, $this->idUser);
        $prix = $vehicule->prixBrute($value['idVehicule']);
        echo '<li class="line">'.$value['nomUnivers'].' '.$value['nomFaction'].' <strong class="gras">'.$value['nomVehicule'].' / '.round($prix,0).' points</strong>
        <a class="lienBoutton" href="index.php?idNav='.  $this->navFVsite.'&idVehicule='.$value['idVehicule'].'">Fiche véhicule</a>
        <form action="CUD/Delette/vehicule.php" method="post">
          <input type="hidden" name="idNav" value="'.$this->idNav.'">
          <input type="hidden" name="id" value="'.$value['idVehicule'].'">
          <button type="submit" name="button">Effacer</button>
        </form>
        </li>';
      }

    }
    echo '</ul>';
  }
  public function prixBrute($idVehicule) {
    //Données nécessaire au calcul du prix :
    $vehicule = "SELECT `idVehicule`, `typeVehicule`, `roleVehicule`, `tailleVehicule`,
    `equipage`, `passage`, `vol`, `stationnaire`, `DQM`, `DC`, `pds`, `svgVehicule`, `deplacement`
    FROM `transport`
    WHERE `idVehicule` = :idVehicule";
    $param = [['prep'=>':idVehicule', 'variable'=>$idVehicule]];
    $readVehicule = new readDB($vehicule, $param);
    $data = $readVehicule->read();
    $type = $this->typeVehicule[$data[0]['typeVehicule']]['valeur'];
    $role = $this->roleVehicule[$data[0]['roleVehicule']]['valeur'];
    $taille = $this->tailleVehicule[$data[0]['tailleVehicule']]['valeur'];
    $equipage = $this->equipage[$data[0]['equipage']]['valeur'];
    $passager = $data[0]['passage'];
    $mouvement = $data[0]['deplacement'];
    $vol = $data[0]['vol'];
    $station = $data[0]['stationnaire'];
    $mouvement = $mouvement + $vol * 2 + $station * 2;
    $DQM = $this->dice[$data[0]['DQM']]['valeur'];
    $DC = $this->dice[$data[0]['DC']]['valeur'];
    $pds = $this->pds[$data[0]['pds']];
    $svg = $this->svgVehicule[$data[0]['svgVehicule']]['valeur'];
    // Calcul sans les règles spéciales.
    $sum = "SELECT SUM(`modificateur`) AS `total` FROM `vehiculeRules` WHERE `id_Vehicule`=:id
            UNION
            SELECT COUNT(`modificateur`)FROM `vehiculeRules` WHERE `id_Vehicule`=:id";
    $paramSum = [['prep'=>':id', 'variable'=> $idVehicule]];
    $sum = new readDB($sum, $paramSum);
    $dataTotal = $sum->read();
    $modificateur =   $dataTotal[0]['total'] - ($dataTotal[1]['total']);
    // Fin calcul de l'influence des règles spéciales.
    // Calcul de l'impact des armes sur le prix de la figurine
      $sqlArmes = "SELECT SUM(`coef`) AS `totalCoef` FROM `dotationVehicule` WHERE `id_Vehicule` = :id";
      $armes = new readDB($sqlArmes, $paramSum);
      $dataArmes = $armes->read();
      $armes = $dataArmes[0]['totalCoef'];
    // Calcul de l'impact des armes sur le prix de la figurine

    $prixFigurineBrute = (((($equipage) + ($passager/2))+($DQM + $DC*2) + ($type + $role + $taille + $mouvement + $pds) ) * ($svg + ($pds / 8)));
    $prixFigurine = ($prixFigurineBrute * $modificateur) + $prixFigurineBrute;
    $prixFigurine = $prixFigurine + ($prixFigurine * $armes);
    //$prixFigurine = ((($equipage + ($passager/2))+($DQM + $DC*2) + ($type + $role + $taille + $mouvement + $pds) ) * ($svg + ($pds / 8)));
    //Intégration de la règles spéciales
    return $prixFigurine;
  }
  public function fiche($data) {
    $idV = $data[0]['idVehicule'];
    $price = new Vehicules($_SESSION['idUser'], $this->idNav);
    $prix = $price->prixBrute($idV);
    echo '<h4>'.$data[0]['nomVehicule'].'</h4>
          <ul class="ficheFigurine">';
    echo '<li>Description : '.$data[0]['description'].'</li>';
    echo '<li>Type de véhicule : '.$this->typeVehicule[$data[0]['typeVehicule']]['type'].'</li>';
    echo '<li>Rôle du véhicule : '.$this->roleVehicule[$data[0]['roleVehicule']]['role'].'</li>';
    echo '<li>Taille : '.$this->tailleVehicule[$data[0]['tailleVehicule']]['taille'].'</li>';
    if ($data[0]['equipage'] > 0) {
    echo '<li>Equipage : '.$this->equipage[$data[0]['equipage']]['nbre'].' personnes</li>';
  } else {
    echo '<li>Equipage : '.$this->equipage[$data[0]['equipage']]['nbre'].' personne</li>';
  }
  if ($data[0]['passage'] > 0) {
    echo '<li>Passager : '.$this->passager[$data[0]['passage']].' personnes</li>';
  } else {
    echo '<li>Passager : '.$this->passager[$data[0]['passage']].' personne</li>';
  }
  $mouv = $data[0]['deplacement'];
    echo '<li>Mouvement : '.$mouv.' " / '.round($mouv * 2).' " + 1d6 " Vol : '.$this->yes[$data[0]['vol']].' / Vol stationnaire : '.$this->yes[$data[0]['stationnaire']].'</li>';
    echo '<li>Dé de Qualité Martial : '.$this->dice[$data[0]['DQM']]['type'].' / Dé de combat : '.$this->dice[$data[0]['DC']]['type'].'</li>';
    echo '<li>Point de structure : '.$this->pds[$data[0]['pds']].' / Sauvegarde : '.$this->svgVehicule[$data[0]['svgVehicule']]['armure'].'</li>';
    echo '<li>Prix brute : '.round($prix, 0).' points</li>';
    echo '</ul>';
  }
  public function ficheListe($data) {
    $idV = $data[0]['idVehicule'];
    echo '<ul class="ficheFigurine">';
    echo '<li>'.$data[0]['nomVehicule'].' Prix : '.round($data[0]['prixVehicule'], 0).' points</li>';
    echo '<li>Type de véhicule : '.$this->typeVehicule[$data[0]['typeVehicule']]['type'].' - Rôle du véhicule :
    '.$this->roleVehicule[$data[0]['roleVehicule']]['role'].' - Taille : '.$this->tailleVehicule[$data[0]['tailleVehicule']]['taille'].'</li>';
    echo '<li>Equipage : '.$this->equipage[$data[0]['equipage']]['nbre'].' - Passager : '.$this->passager[$data[0]['passage']].'</li>';
  $mouv = $data[0]['deplacement'];
    echo '<li>Mouvement : '.$mouv.' " / '.round($mouv * 2).' " + 1d6 " Vol : '.$this->yes[$data[0]['vol']].' / Vol stationnaire : '.$this->yes[$data[0]['stationnaire']].'</li>';
    echo '<li>Dé de Qualité Martial : '.$this->dice[$data[0]['DQM']]['type'].' / Dé de combat : '.$this->dice[$data[0]['DC']]['type'].'</li>';
    echo '<li>Point de structure : '.$this->pds[$data[0]['pds']].' / Sauvegarde : '.$this->svgVehicule[$data[0]['svgVehicule']]['armure'].'</li>';
    echo '</ul>';
  }
  public function UniversFaction($idVehicule) {
    $sql = "SELECT `nomFaction`, `nomUnivers`, `id_faction`
    FROM `transport`
    INNER JOIN `factions` ON `idFaction` = `id_faction`
    INNER JOIN `univers` ON `univers`.`idUnivers` = `id_univers`
    WHERE `idVehicule` = :idVehicule";
    $param = [['prep'=>'idVehicule', 'variable'=>$idVehicule]];
    $UF = new readDB($sql, $param);
    $dataUF = $UF->read();
    echo '<h3 class="sousTitre">'.$dataUF[0]['nomUnivers'].' '.$dataUF[0]['nomFaction'].' </h3>';
    return $dataUF;
  }
  public function spRules($idVehicule) {
    $triRules = "SELECT `nomRules`
    FROM `vehiculeRules`
    INNER JOIN `rules` ON `idRules` = `id_Rules`
    WHERE `id_Vehicule` = :id
    ORDER by `nomRules`";
    $prep = [['prep' => ':id', 'variable'=> $idVehicule]];
    $listeRules = new readDB($triRules, $prep);
    $dataRules = $listeRules->read();
    if (!empty($dataRules)) {
      echo '<p><strong>Règles spécial :</strong> ';
      foreach ($dataRules as $key) {
        echo '<strong class="affichageSP">'.$key['nomRules'].'</strong>';
      }
      echo '</p>';
    } else {
      echo '<p>Aucune règles spéciales pour ce véhicule.</p>';
    }
  }
  public function DelSpecialRules ($idVehicule, $idNav) {
    $triRules = "SELECT `nomRules`, `idVehiculeRules`
    FROM `vehiculeRules`
    INNER JOIN `rules` ON `idRules` = `id_Rules`
    WHERE `id_Vehicule` = :id
    ORDER by `nomRules`";
    $prep = [['prep' => ':id', 'variable'=> $idVehicule]];
    $listeRules = new readDB($triRules, $prep);
    $dataRules = $listeRules->read();

    if (!empty($dataRules)) {
echo '<h4 class="sousTitre">Effacer règles spéciales</h4><div class="mosaique">';
      foreach ($dataRules as $key) {
        echo '<form class="item" action="CUD/Delette/specialeRulesVehicule.php" method="post">
          <input type="hidden" name="idVehiculeRules" value="'.$key['idVehiculeRules'].'">
          <input type="hidden" name="id_Vehicule" value="'.$idVehicule.'">
          <input type="hidden" name="idNav" value="'.$this->idNav.'">
          <button type="submit" name="button">'.$key['nomRules'].'</button>
        </form>';
      }
          echo '</div>';
    }
  }
  public function delArmesVehicule($idVehicule) {
    $triArme = "SELECT `idDotation`,`nom`
    FROM `dotationVehicule`
    INNER JOIN `armes` ON `idArmes` = `id_Arme`
    WHERE `id_Vehicule` = :id";
    $prep = [['prep' => ':id', 'variable'=> $idVehicule]];
    $armes = new readDB($triArme, $prep);
    $dataArmes = $armes->read();
        echo '<h4 class="sousTitre">Effacer les armes</h4>';
    if(empty($dataArmes)) {
      echo '<h4 class="sousTitre">Pas encore d\'armes disponible</h4>';
    } else {
      echo '<div class="mosaique">';
      foreach ($dataArmes as $key => $value) {
        echo '<form class="item" action="CUD/Delette/armeVehicule.php" method="post">
          <input type="hidden" name="idDotation" value="'.$value['idDotation'].'">
          <input type="hidden" name="idVehicule" value="'.$idVehicule.'">
          <input type="hidden" name="idNav" value="'.$this->idNav.'">
          <button type="submit" name="button">'.$value['nom'].'</button>
        </form>';
      }
      echo '</div>';
    }
  }
  public function dotationArme($idVehicule) {
    $triArmes= "SELECT `id_Arme`
    FROM `dotationVehicule`
    INNER JOIN `armes` ON `idArmes` = `id_Arme`
    WHERE `id_Vehicule` = :idVehicule";
    $param = [['prep'=> 'idVehicule', 'variable'=>$idVehicule]];
    $listeArmes = new readDB($triArmes, $param);
    $dataListe = $listeArmes->read();
    return $dataListe;
  }
  public function triListeVehicule ($idFaction) {
    $SQLtri = "SELECT `idVehicule`, `nomVehicule`
    FROM `transport`
    WHERE `id_faction` = :id_Faction AND `fixer` = 1 AND `service` = 1";
    $param = [['prep'=> ':id_Faction', 'variable'=>$idFaction]];
    $liste =new readDB($SQLtri, $param);
    $dataListeVehicule = $liste->read();
    return   $dataListeVehicule;
  }
}
 ?>
