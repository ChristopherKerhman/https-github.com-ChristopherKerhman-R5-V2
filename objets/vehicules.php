<?php
class Vehicules {
  private $idUser;
  private $idNav;
  public function __construct($idUser, $idNav) {
    $this->idUser = $idUser;
    $this->idNav = $idNav;
    $this->typeVehicule = [['type'=>'civile', 'Valeur'=>2], ['type'=>'militaire', 'Valeur'=>4]];
    $this->roleVehicule = [['role'=>'transport', 'valeur'=>2, 'PC'=>0.25],
                          ['role'=>'Soutient tactique', 'valeur'=>4, 'PC'=>0.35],
                          ['role'=>'Attaque rapide', 'valeur'=>3, 'PC'=>0.45],
                          ['role'=>'Véhicule de commandement', 'valeur'=>6, 'PC'=>2],
                          ['role'=>'Artillerie', 'valeur'=>4, 'PC'=>0.12]];
    $this->dice =[['type' => 'D6', 'Valeur' => 2],
                  ['type' => 'D8', 'Valeur' => 4],
                  ['type' => 'D10', 'Valeur' => 6],
                  ['type' => 'D12', 'Valeur' => 8]];
    $this->tailleVehicule = [ ['taille' => 'Petit', 'Valeur' => 2],
                              ['taille' => 'Standard', 'Valeur' => 4],
                              ['taille' => 'Grand', 'Valeur' => 8],
                              ['taille' => 'Géant', 'Valeur' => 16]];
    $this->pds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
    $this->equipage = [['nbre'=>0, 'Valeur'=>1],
                      ['nbre'=> 1, 'Valeur'=>2],
                      ['nbre'=> 2, 'Valeur'=>4],
                      ['nbre'=> 4, 'Valeur'=>5],
                      ['nbre'=> 5, 'Valeur'=>8],
                      ['nbre'=> 6, 'Valeur'=>12],];
    $this->passager = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    $this->svgVehicule = [['armure' => 'Aucune', 'Valeur' => 0.3],
                          ['armure' => '6+', 'Valeur' => 0.4],
                          ['armure' => '5+', 'Valeur' => 0.5],
                          ['armure' => '4+', 'Valeur' => 1],
                          ['armure' => '4++', 'Valeur' => 1.25],
                          ['armure' => '3+', 'Valeur' => 1.5],
                          ['armure' => '3++', 'Valeur' => 2],
                          ['armure' => '2+', 'Valeur' => 4]];
    $this->yes = ['Non', 'Oui'];
    // A présiser lors de la mise en service des fiches.
    $this->navFV = 90;
    $this->navMV = 91;
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

    echo '<li><div class="line">
    <form action="CUD/Create/cloneVehicule.php" method="post">
      <input type="hidden" name="idNav" value="'.$this->idNav.'">
      <input type="hidden" name="idVehicule" value="'.$value['idVehicule'].'">
      <button id="clone" type="submit" name="button">Cloner</button>
    </form>
   '.$value['nomVehicule'].' <form action="CUD/Update/affectationVehicule.php" method="post">
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
      echo '<li>'.$value['nomUnivers'].' '.$value['nomFaction'].' '.$value['nomVehicule'].'</li>';
    }
    echo '</ul>';
  }
}

 ?>
