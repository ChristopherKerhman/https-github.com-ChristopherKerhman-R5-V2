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
    // Vers affichage fiche simple affichages/ficheFigurine.php
    $this->navG = 59;
  }
  public function ListeNouvelleFigurine () {
    $selectListeNF = "SELECT `idFigurine`, `nomFigurine`
    FROM `figurines` WHERE `id_User` = :idUser AND `figurineAffecter` = 0 AND `valide` = 1";
    $prep = [['prep'=>':idUser', 'variable' => $this->idUser]];
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
        <button type="submit" name="button">Cloner</button>
      </form>
      <strong class="gras">'.$key['nomFigurine'].'</strong>
      <a class="lienBoutton" href="index.php?idNav='.$this->navG.'&idFigurine='.$key['idFigurine'].'">Fiche</a>
      <form action="CUD/Delette/figurine.php" method="post">
        <input type="hidden" name="idNav" value="'.$this->idNav.'">
        <input type="hidden" name="idFigurine" value="'.$key['idFigurine'].'">
        <button type="submit" name="button">Effacer</button>
      </form>
      <a class="lienBoutton" href="index.php?idNav='.$this->navF.'&idFigurine='.$key['idFigurine'].'">Modifier</a>';
      echo '<form action="CUD/Create/affecterFigurine.php" method="post">
      <label for="faction">Factions :</label>
      <select name="id_Faction">';
      foreach ($factionsListe as $index) {
        echo '<option value="'.$index['idFaction'].'">'.$index['nomUnivers'].' - '.$index['nomFaction'].'</option>';
      }
      echo '</select>
      <input type="hidden" name="idFigurine" value="'.$key['idFigurine'].'">
      <input type="hidden" name="idNav" value="'.$this->idNav.'">
      <button type="submit" name="button">Affecter</button></form>';
      echo '</li>';
    }
    echo '</ul>';
  }
  public function readFiche($idFigurine) {
    $fiche = "SELECT `idFigurine`, `id_User`, `nomFigurine`, `description`, `typeFigurine`, `tailleFigurine`, `DQM`, `DC`,
    `svg`, `pdv`, `mouvement`, `valide`, `partager`, `figurineFixer`, `figurineAffecter`
    FROM `figurines` WHERE `idFigurine` = :id AND `valide` = 1";
    $preparation = [['prep' => ':id', 'variable'=> $idFigurine]];
    $ficheFigurine = new readDB ($fiche, $preparation);
    return $ficheFigurine->read();
  }
  public function ficheFigurine($data){
    // Liste des éléments pour déterminer le prix d'une figurine :
    $DQM = $this->dice[$data[0]['DQM']]['Valeur'];
    $DC = $this->dice[$data[0]['DC']]['Valeur'];
    $type = $this->typeFigurine[$data[0]['typeFigurine']]['Valeur'];
    $taille = $this->tailleFigurine[$data[0]['tailleFigurine']]['Valeur'];
    $mouvement = $data[0]['mouvement'];
    $sav = $this->svg[$data[0]['svg']]['Valeur'];
    $pointDeVie = $this->pointDeVie[$data[0]['pdv']];
    // Calcul des points de figurine :
    $prixFigurine = (($DQM + $DC*2) + ($type + $taille + $mouvement + $pointDeVie)) * ($sav + ($pointDeVie / 8));
    echo '<h4>'.$data[0]['nomFigurine'].'</h4>
          <ul class="ficheFigurine">';
    echo '<li>Dé Qualité Martial : '.$this->dice[$data[0]['DQM']]['type'].'</li>';
    echo '<li>Dé de Combat : '.$this->dice[$data[0]['DC']]['type'].'</li>';
    echo '<li>Mouvement : '.$data[0]['mouvement'].' "/ '.round($data[0]['mouvement'] * 1.5, 0).'" + 1D4"</li>';
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
  }
}
