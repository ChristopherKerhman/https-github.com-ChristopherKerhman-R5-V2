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
  }
  public function readListesUser ($ok) {
    $triListe = "SELECT `idListe`, `id_Univers`, `id_Faction`, `nomListe`, `nomUnivers`, `nomFaction`, `listeArmee`.`partager`
    FROM `listeArmee`
    INNER JOIN `univers` ON `idUnivers` = `id_Univers`
    INNER JOIN `factions` ON `idFaction`= `id_Faction`
    WHERE `listeArmee`.`valide` = :valide AND `idUser` = :idUser";
    $param = [['prep'=>':idUser', 'variable'=>$this->idUser], ['prep'=>':valide', 'variable'=>$ok]];
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
        Nom liste :'.$value['nomListe'].' Univers :'.$value['nomUnivers'].' Faction '.$value['nomFaction'].' Liste partager : '.$share.'
        </li>';
    }
    echo '</ul>';

  }
}
