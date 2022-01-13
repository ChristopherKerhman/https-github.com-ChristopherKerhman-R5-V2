<?php
class Rules {
  public function readRules ($type) {
    $SQL = "SELECT `idRules`, `nomRules`, `descriptionRules`, `modification`, `typeRules`
    FROM `rules` WHERE `typeRules` = :type
    ORDER BY `nomRules`";
    $pre = [['prep' => ':type', 'variable' => $type]];
    $read = new readDB ($SQL, $pre);
    $listeRules = $read->read();
    return $listeRules;
  }
  public function affectation ($data, $id, $idNav, $type) {
    echo '
    <h4 class="sousTitre">Affectation des règles spéciales</h4>
    <div class="mosaique">';
        foreach ($data as $key) {
          echo '
          <form class="item" action="CUD/Create/affectationRegSep.php" method="post">
            <input type="hidden" name="id" value="'.$id.'">
            <input type="hidden" name="type" value="'.$type.'">
            <input type="hidden" name="idRules" value="'.$key['idRules'].'">
            <input type="hidden" name="idNav" value="'.$idNav.'">
            <button type="submit" name="button">'.$key['nomRules'].'</button>
          </form>';
    }
    echo '</div>';
  }

}
