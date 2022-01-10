<?php
class Vehicules {
  private $idUser;
  private $idNav;
  public function __construct($idUser, $idNav) {
    $this->idUser = $idUser;
    $this->idNav = $idNav;
    $this->typeVehicule = [['type'=>'Civile', 'valeur'=>2], ['type'=>'Militaire', 'valeur'=>4]];
    $this->roleVehicule = [['role'=>'transport', 'valeur'=>2, 'PC'=>0.25],
                          ['role'=>'Soutient tactique', 'valeur'=>4, 'PC'=>0.35],
                          ['role'=>'Attaque rapide', 'valeur'=>3, 'PC'=>0.45],
                          ['role'=>'Véhicule de commandement', 'valeur'=>6, 'PC'=>2],
                          ['role'=>'Artillerie', 'valeur'=>4, 'PC'=>0.12]];
    $this->dice =[['type' => 'D6', 'valeur' => 2],
                  ['type' => 'D8', 'valeur' => 4],
                  ['type' => 'D10', 'valeur' => 6],
                  ['type' => 'D12', 'valeur' => 8]];
    $this->tailleVehicule = [ ['taille' => 'Petit', 'valeur' => 2],
                              ['taille' => 'Standard', 'valeur' => 4],
                              ['taille' => 'Grand', 'valeur' => 8],
                              ['taille' => 'Géant', 'valeur' => 16]];
    $this->pds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
    $this->equipage = [['nbre'=>0, 'valeur'=>1],
                      ['nbre'=> 1, 'valeur'=>2],
                      ['nbre'=> 2, 'valeur'=>4],
                      ['nbre'=> 3, 'valeur'=>6],
                      ['nbre'=> 4, 'valeur'=>8],
                      ['nbre'=> 5, 'valeur'=>10],
                      ['nbre'=> 6, 'valeur'=>14]];
    $this->passager = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    $this->svgVehicule = [['armure' => 'Aucune', 'valeur' => 0.3],
                          ['armure' => '6+', 'valeur' => 0.4],
                          ['armure' => '5+', 'valeur' => 0.5],
                          ['armure' => '4+', 'valeur' => 1],
                          ['armure' => '4++', 'valeur' => 1.25],
                          ['armure' => '3+', 'valeur' => 1.5],
                          ['armure' => '3++', 'valeur' => 2],
                          ['armure' => '2+', 'valeur' => 4]];
    $this->yes = ['Non', 'Oui'];
    // A présiser lors de la mise en service des fiches.
    // Fiche véhicule
    $this->navFV = 67;
    // Modif véhicule
    $this->navMV = 68;
  }
  public function readVehicule($idVehicule) {
    $vehicule = "SELECT `idVehicule`, `nomVehicule`, `description`, `typeVehicule`, `roleVehicule`, `tailleVehicule`,
    `equipage`, `passage`, `vol`, `stationnaire`, `DQM`, `DC`, `pds`, `svgVehicule`, `deplacement`, `id_univers`,
    `id_faction`, `valide`, `fixer`, `service`, `partager`
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
    //print_r($dataListeFU);
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
    echo '<li><div class="line">
    <form action="CUD/Create/cloneVehicule.php" method="post">
      <input type="hidden" name="idNav" value="'.$this->idNav.'">
      <input type="hidden" name="idVehicule" value="'.$value['idVehicule'].'">
      <button id="clone" type="submit" name="button">Cloner</button>
    </form>
   <strong class="gras">'.$value['nomVehicule'].' / '.$prix.' points</strong> <form action="CUD/Update/affectationVehicule.php" method="post">
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
    </form>
    </div></li>';
      }
    echo '</ul>';
  }
  public function listeVehicule() {
    $param = [['prep'=> ':idUser', 'variable'=> $this->idUser]];
    $triVehicule = "SELECT `idVehicule`, `nomVehicule`, `nomUnivers`, `nomFaction`
    FROM `transport`
    INNER JOIN `univers` ON `idUnivers` = `id_Univers`
    INNER JOIN `factions` ON `idFaction` = `id_Faction`
    WHERE `idUser` = :idUser AND `id_univers` > 0
    ORDER BY `nomUnivers`, `nomFaction`, `nomVehicule`";
    $listeVehicule = new readDB($triVehicule, $param);
    $dataListeVehicule = $listeVehicule->read();
    echo '<ul>';
    foreach ($dataListeVehicule as $key => $value) {
      $vehicule = new Vehicules ($this->idNav, $this->idUser);
      $prix = $vehicule->prixBrute($value['idVehicule']);
      echo '<li>'.$value['nomUnivers'].' '.$value['nomFaction'].' <strong class="gras">'.$value['nomVehicule'].' / '.$prix.' points</strong></li>';
    }
    echo '</ul>';
  }
  public function prixBrute($idVehicule) {
    //Donner nécessaire au calcul du prix :
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
    $mouvement = $mouvement + $vol * 2 + $station * 4;
    $DQM = $this->dice[$data[0]['DQM']]['valeur'];
    $DC = $this->dice[$data[0]['DC']]['valeur'];
    $pds = $this->pds[$data[0]['pds']];
    $svg = $this->svgVehicule[$data[0]['svgVehicule']]['valeur'];
    // Calcul sans les règles spéciales.
    $prixFigurine = ((($equipage + ($passager/2))+($DQM + $DC*2) + ($type + $role + $taille + $mouvement + $pds) ) * ($svg + ($pds / 8)));
    //Intégration de la règles spéciales
    //$prixFigurine = ((($equipage + ($passager/2))($DQM + $DC*2) + ($type + $taille + $mouvement + $pds) ) * ($svg + ($pds / 8)))* $modificateur;
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
    echo '<li>Passager : '.$this->passager[$data[0]['passage']].' personne</li>';
  } else {
    echo '<li>Passager : '.$this->passager[$data[0]['passage']].' personne</li>';
  }
  $mouv = $data[0]['deplacement'];
    echo '<li>Mouvement : '.$mouv.' " / '.round($mouv *1.75).' " + 1d6 " Vol : '.$this->yes[$data[0]['vol']].' / Vol stationnaire : '.$this->yes[$data[0]['stationnaire']].'</li>';
    echo '<li>Dé de Qualité Martial : '.$this->dice[$data[0]['DQM']]['type'].' / Dé de combat : '.$this->dice[$data[0]['DC']]['type'].'</li>';
    echo '<li>Point de structure : '.$this->pds[$data[0]['pds']].' / Sauvegarde : '.$this->svgVehicule[$data[0]['svgVehicule']]['armure'].'</li>';
    echo '<li>Prix brute : '.round($prix, 0).' points</li>';
    echo '</ul>';
  }
}

 ?>
