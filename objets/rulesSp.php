<?php
class Rules {
  public function readRules ($type) {
    $SQL = "SELECT `idRules`, `nomRules`, `descriptionRules`, `modification`, `typeRules`
    FROM `rules` WHERE `typeRules` = :type";
    $pre = [['prep' => ':type', 'variable' => $type]];
    $read = new readDB ($SQL, $pre);
    $listeRules = $read->read();
    return $listeRules;
  }
  public function affectation ($data, $idArmes, $idNav) {
    echo '
    <h4 class="sousTitre">Affectation des règles spéciales</h4>
    <div class="mosaique">';
        foreach ($data as $key) {
          echo '
          <form class="item" action="CUD/Create/affectationRS.php" method="post">
            <input type="hidden" name="idArmes" value="'.$idArmes.'">
            <input type="hidden" name="idRules" value="'.$key['idRules'].'">
            <input type="hidden" name="modification" value="'.$key['modification'].'">
            <input type="hidden" name="idNav" value="'.$idNav.'">
            <button type="submit" name="button">'.$key['nomRules'].'</button>
          </form>';
    }
    echo '</div>';
  }
  public function affectationFigurine ($data, $idFigurine, $idNav) {
    echo '
    <h4 class="sousTitre">Affectation des règles spéciales</h4>
    <div class="mosaique">';
        foreach ($data as $key) {
          echo '
          <form class="item" action="CUD/Create/affectationRSF.php" method="post">
            <input type="hidden" name="id_Figurine" value="'.$idFigurine.'">
            <input type="hidden" name="id_Rules" value="'.$key['idRules'].'">
            <input type="hidden" name="modificateur" value="'.$key['modification'].'">
            <input type="hidden" name="idNav" value="'.$idNav.'">
            <button type="submit" name="button">'.$key['nomRules'].'</button>
          </form>';
    }
    echo '</div>';
  }
}
