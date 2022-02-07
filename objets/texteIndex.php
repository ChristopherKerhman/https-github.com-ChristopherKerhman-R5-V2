<?php
class TexteIndex {
  public function readTitre($valide) {
    $triTitre = "SELECT `idTexte`, `id_User`, `titre`, `valide`, `date`
    FROM `texteIndex` WHERE `valide` = :valide";
    $param = [['prep'=>'valide', 'variable'=> $valide]];
    $action = new readDB($triTitre, $param);
    $dataTitre = $action->read();
    return $dataTitre;
  }
  private function readOne($idTexte) {
    $sql = "SELECT `idTexte`, `login`, `titre`, `texte`, `texteIndex`.`valide`, `date`
    FROM `texteIndex`
    INNER JOIN `users` ON `idUser` = `id_User`
    WHERE `idTexte` = :idTexte";
    $param =[['prep'=>':idTexte', 'variable'=>$idTexte]];
    $action = new readDB($sql, $param);
    $dataTexte = $action->read();
    return $dataTexte;
  }
  public function presentationTexte($idTexte, $type) {
    // $type = 0 => Administration / 1 => public
    $yes = ['Non', 'Oui'];
    function brassageDate($data) {
      $date = $data;
      $year = substr($date,0,4);
      $month = substr($date,5,2);
      $day = substr($date,8,2);
      $date = $day.'/'.$month.'/'.$year;
      return $date;
    }
    $var = new TexteIndex();
    $dataTexte = $var->readOne($idTexte);
    echo '<h3 class="sousTitre">'.$dataTexte[0]['titre'].'</h3>';
    echo $dataTexte[0]['texte'];
    if($type == 0) {
echo '<ul>
      <strong>
        <li>Caractéristique :</li>
        <li>Texte valide : '.$yes[$dataTexte[0]['valide']].'</li>
        <li>Auteur : '.$dataTexte[0]['login'].'</li>
        <li>Date enregistrement : '.brassageDate($dataTexte[0]['date']).'</li>
      </strong>
      </ul>';
    } else {
        echo 'Auteur : '.$dataTexte[0]['login'];
        echo '<br />Date :'.brassageDate($dataTexte[0]['date']);
    }

  }
  public function modifierTexte ($idTexte, $idNav) {
    $var = new TexteIndex();
    $dataTexte = $var->readOne($idTexte);
    echo '<form class="formulaire" action="CUD/Update/texteIndex.php" method="post">
    <div class="ligne">
      <label for="titre">Titre générale</label>
      <input id="titre" type="text" name="titre" value="'.$dataTexte[0]['titre'].'">
      <label for="valide">Publier ?</label>
      <select id="valide" name="valide">
        <option value="0">Non</option>
        <option value="1">Oui</option>
      </select>
    </div>
      <label for="texte">Texte a publier</label>
      <textarea id="texte" name="texte" rows="16" cols="40" placeholder="Texte à publier">
      '.$dataTexte[0]['texte'].'
      </textarea>
        <input type="hidden" name="idTexte" value="'.$dataTexte[0]['idTexte'].'">
        <input type="hidden" name="idNav" value="'.$idNav.'">
      <button type="submit" name="button">Modifier</button>
    </form>';
  }
  public function readLastIdTexte() {
    $sql = "SELECT `idTexte` FROM `texteIndex` ORDER BY `idTexte` DESC LIMIT 1";
    $param = [];
    $action = new readDB($sql, $param);
    $dataTexte = $action->read();
    return $dataTexte;
  }
}

 ?>
