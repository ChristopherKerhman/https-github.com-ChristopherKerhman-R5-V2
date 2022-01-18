<?php
class Listes {
  private $idUser;
  private $idNav;
  public function __construct($idUser, $idNav) {
    $this->idUser = $idUser;
    $this->idNav = $idNav;
    // Element pour calculer les points de commandement de la liste.
    $this->typeFigurine = [['type' => 'Civile', 'Valeur'=> 1, 'PC' => 0.05],
      ['type' => 'Conscrit', 'Valeur'=> 2.8, 'PC' => 0.1],
      ['type' => 'Soldat régulier', 'Valeur'=> 3.6, 'PC' => 0.1667],
      ['type' => 'Soutient Tactique', 'Valeur'=> 5, 'PC' => 0.25],
      ['type' => 'Elite', 'Valeur'=> 9, 'PC' => 0.45],
      ['type' => 'Vétéran', 'Valeur'=> 10, 'PC' => 0.5],
      ['type' => 'Officier', 'Valeur'=> 20, 'PC' => 1],
      ['type' => 'Officier suppérieur', 'Valeur'=> 26, 'PC' => 1.3]];
    $this->roleVehicule = [['role'=>'transport', 'valeur'=>1, 'PC'=>0.05],
      ['role'=>'Soutient tactique', 'valeur'=>2, 'PC'=>1],
      ['role'=>'Attaque rapide', 'valeur'=>2.5, 'PC'=>0.5],
      ['role'=>'Véhicule de commandement', 'valeur'=>5, 'PC'=>2],
      ['role'=>'Artillerie', 'valeur'=>2, 'PC'=>0.05]];
      //Navigation
      $this->AL = 73;
      //Fiche figurine sans modification
      $this->navG = 63;
      //Affichage fiche Véhicule sans modification
      $this->navFV = 70;
      //Aller vers fiche d'armée :
      $this->liste = 74;
  }
  public function readListesUser ($ok, $fixer) {
    $triListe = "SELECT `idListe`, `id_Univers`, `id_Faction`, `nomListe`, `nomUnivers`, `nomFaction`, `listeArmee`.`partager`
    FROM `listeArmee`
    INNER JOIN `univers` ON `idUnivers` = `id_Univers`
    INNER JOIN `factions` ON `idFaction`= `id_Faction`
    WHERE `listeArmee`.`valide` = :valide AND `idUser` = :idUser AND `fixer` = :fixer";
    $param = [['prep'=>':idUser', 'variable'=>$this->idUser], ['prep'=>':valide', 'variable'=>$ok], ['prep'=>':fixer', 'variable'=>$fixer]];
    $readListe = new readDB($triListe, $param);
    $dataListe = $readListe->read();
    return $dataListe;
  }
  public function affichageListe($data) {
    echo '<ul>';
    foreach ($data as $key => $value) {
      if ($value['partager'] > 0) {
        $share = 'Oui';
      } else {
        $share = 'Non';
      }
        echo '<li class="line">
        <form class="formulaire" action="CUD/Delette/liste.php" method="post">
        <input type="hidden" name="idListe" value="'.$value['idListe'].'">
        <input type="hidden" name="idNav" value="'.$this->idNav.'">
        <button type="submit" name="button">Effacer</button>
        </form>
          <a class="lienBoutton" href="index.php?idNav='.$this->AL.'&idListe='.$value['idListe'].'">Affecter</a>
        Nom liste :'.$value['nomListe'].' Univers :'.$value['nomUnivers'].' Faction '.$value['nomFaction'].' Liste partager : '.$share.'
        </li>';
    }
    echo '</ul>';
  }
  public function triFigurineListe ($idListe) {
    // Recherche de l'idFaction de la liste et stokage
    $listeIdFaction = "SELECT  `id_Figurine`
    FROM `listeArmee`
    INNER JOIN `AffecterFigurineUF` ON `AffecterFigurineUF`.`id_Faction` = `listeArmee`.`id_Faction`
    WHERE `idListe` = :idListe";
    $param = [['prep'=>':idListe', 'variable'=>$idListe]];
    $readlisteIdFigurine = new readDB($listeIdFaction, $param);
    $dataIdFigurine = $readlisteIdFigurine->read();
    return $dataIdFigurine;
  }
  public function nameListe($idListe) {
    $getName = "SELECT `nomListe` FROM `listeArmee` WHERE  `idListe` = :id";
    $param = [['prep'=> ':id', 'variable' => $idListe]];
    $name = new readDB($getName, $param);
    $nameListe = $name->read();
    return $nameListe;
  }
  public function factionListe($idListe) {
    $SQLidListe = "SELECT `id_Faction` FROM `listeArmee` WHERE `idListe` = :idListe";
    $param =[['prep'=> ':idListe', 'variable'=>$idListe]];
    $GetidFaction = new readDB(  $SQLidListe, $param);
    $idFaction = $GetidFaction->read();
    return $idFaction[0]['id_Faction'];
  }
  public function resumeListe($idListe) {
    //Nom figurine + nbr + prix total dans la liste
    $param = [['prep'=> ':id_Liste', 'variable'=>$idListe]];
    $sqlFigurine = "SELECT `nomFigurine`, `nbr`, `prixTotal`, `idComposition`, `id_Figurine`
    FROM `compositionListe`
    INNER JOIN `figurines` ON `idFigurine` = `id_Figurine`
    WHERE `id_Liste` = :id_Liste";
    $getFigurine = new readDB($sqlFigurine, $param);
    $dataFigurine = $getFigurine->read();
    // Nom véhicule
    $sqlVehicule = "SELECT  `nomVehicule`,`nbr`, `prixTotal`, `idComposition`, `id_Vehicule`
    FROM `compositionListe`
    INNER JOIN `transport` ON `idVehicule` = `id_Vehicule`
    WHERE `id_Liste` = :id_Liste";
    $getVehicule = new readDB($sqlVehicule, $param);
    $dataVehicule = $getVehicule->read();
    echo '<h4 class="sousTitreArticle">Figurines</h4>';
    echo '<ul>';
    foreach ($dataFigurine as $key => $value) {
      echo '<li class="line">  <form action="CUD/Delette/affectationListe.php" method="post">
          <input type="hidden" name="idComposition" value="'.$value['idComposition'].'">
          <input type="hidden" name="id_Liste" value="'.$idListe.'">
          <input type="hidden" name="idNav" value="'.$this->idNav.'">
          <button type="submit" name="button">Effacer</button>
        </form>
        <a class="lienBoutton" href="index.php?idNav='.$this->navG.'&idFigurine='.$value['id_Figurine'].'">Fiche</a>
        '.$value['nbr'].' '.$value['nomFigurine'].' - Prix : '.round($value['prixTotal'], 0).' points
    </li>';
    }
    echo '</ul>';
    echo '<h4 class="sousTitreArticle">Véhicules</h4>';
    echo '<ul>';
    foreach ($dataVehicule as $key => $value) {
      echo '<li class="line"><form action="CUD/Delette/affectationListe.php" method="post">
          <input type="hidden" name="idComposition" value="'.$value['idComposition'].'">
          <input type="hidden" name="id_Liste" value="'.$idListe.'">
          <input type="hidden" name="idNav" value="'.$this->idNav.'">
          <button type="submit" name="button">Effacer</button>
        </form>
        <a class="lienBoutton" href="index.php?idNav='.$this->navFV.'&idVehicule='.$value['id_Vehicule'].'">Fiche</a>
        '.$value['nbr'].' '.$value['nomVehicule'].' - Prix : '.round($value['prixTotal'], 0).' points</li>';
    }
    echo '</ul>';
  }
  public function sommeListe($idListe) {
    $sommeListe = "SELECT SUM(`prixTotal`) AS `totalListe` FROM `compositionListe` WHERE `id_Liste` = :idListe";
    $param = [['prep'=> ':idListe', 'variable'=>$idListe]];
    $getSomme = new readDB($sommeListe, $param);
    $total = $getSomme->read();
    return $total[0]['totalListe'];
  }
  public function pointCommandement($idListe) {
    $param = [['prep'=> ':id_Liste', 'variable'=>$idListe]];
    $sqlFigurine = "SELECT  `id_Figurine`, `typeFigurine`, `nbr`
    FROM `compositionListe`
    INNER JOIN `figurines` ON `idFigurine` = `id_Figurine`
    WHERE `id_Liste` = :id_Liste";
    $getFigurine = new readDB($sqlFigurine, $param);
    $dataFigurine = $getFigurine->read();
    // Nom véhicule
    $sqlVehicule = "SELECT  `id_Vehicule`, `roleVehicule`, `nbr`
    FROM `compositionListe`
    INNER JOIN `transport` ON `idVehicule` = `id_Vehicule`
    WHERE `id_Liste` = :id_Liste";
    $getVehicule = new readDB($sqlVehicule, $param);
    $dataVehicule = $getVehicule->read();
    $sumPC = 0;
    foreach ($dataFigurine as $key => $value) {
      $sumPC = $this->typeFigurine[$value['typeFigurine']]['PC'] * $value['nbr']  + $sumPC;
    }
    foreach ($dataVehicule as $key => $value) {
      $sumPC = $this->typeFigurine[$value['roleVehicule']]['PC'] * $value['nbr'] + $sumPC;
    }
    return $sumPC;
  }
  public function detailListeFigurine($idListe) {
    $param = [['prep'=> ':id_Liste', 'variable'=>$idListe]];
    $sqlFigurine = "SELECT `nomFigurine`,`nbr`, `prixTotal`, `idComposition`, `id_Figurine`
    FROM `compositionListe`
    INNER JOIN `figurines` ON `idFigurine` = `id_Figurine`
    WHERE `id_Liste` = :id_Liste";
    $getFigurine = new readDB($sqlFigurine, $param);
    $dataFigurine = $getFigurine->read();
    return $dataFigurine;
  }
  public function detailListeVehicule($idListe) {
    $param = [['prep'=> ':id_Liste', 'variable'=>$idListe]];
    // Nom véhicule
    $sqlVehicule = "SELECT  `nomVehicule`, `nbr`, `prixTotal`, `idComposition`, `id_Vehicule`
    FROM `compositionListe`
    INNER JOIN `transport` ON `idVehicule` = `id_Vehicule`
    WHERE `id_Liste` = :id_Liste";
    $getVehicule = new readDB($sqlVehicule, $param);
    $dataVehicule = $getVehicule->read();
    return $dataVehicule;
  }
}