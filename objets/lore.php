<?php
class Lore {
  private $idLore;
  public function __construct($idLore) {
    $this->idLore = $idLore;
    $this->yes = ['Non', 'Oui'];
  }
  public function readLore() {
    $SQL = "SELECT `idLore`, `titreLore`, `texteLore`, `lore`.`valide`, `lore`.`partager`, `nomUnivers`
    FROM `lore`
    INNER JOIN `univers` ON `univers`.`idUnivers` = `lore`.`idUnivers`
    WHERE `idLore` = :idLore";
    $prepare = [['prep' => ':idLore', 'variable'=> $this->idLore]];
    $readLore = new readDB($SQL, $prepare);
    $article = $readLore->read();
    echo '<h4 class="sousTitre">'.$article[0]['titreLore'].' - Univers '.$article[0]['nomUnivers'].'</h4>
          <p class="articleContexte">'.$article[0]['texteLore'].'</p>
          <p class="gras">Artcile valide : '.$this->yes[$article[0]['valide']].'</p>
          <p class="gras">Article partager : '.$this->yes[$article[0]['partager']].'</p>';
  }
  public function modLore($data) {
    $SQL = "SELECT `idLore`, `titreLore`, `texteLore`, `lore`.`valide`, `lore`.`partager`, `nomUnivers`
    FROM `lore`
    INNER JOIN `univers` ON `univers`.`idUnivers` = `lore`.`idUnivers`
    WHERE `idLore` = :idLore";
    $prepare = [['prep' => ':idLore', 'variable'=> $this->idLore]];
    $readLore = new readDB($SQL, $prepare);
    $article = $readLore->read();
    echo '
    <form class="formulaire" action="CUD/Update/lore.php" method="post">
      <label for="titre">Titre</label>
      <input id="titre" type="text" name="titreLore" value="'.$article[0]['titreLore'].'" required>
      <label for="texte">Texte de Lore</label>
      <textarea id="texte" name="texteLore" rows="24" cols="200" required>
        '.$article[0]['texteLore'].'
      </textarea>
      <label for="partager">Partager votre texte</label>
      <select id="partager" name="partager">
        <option value="0">Non</option>
        <option value="1" selected>Oui</option>
      </select>
      <label for="valide">Valider texte</label>
      <select id="valide" name="valide">
        <option value="0">Non</option>
        <option value="1" selected>Oui</option>
      </select>
      <input type="hidden" name="idLore" value="'.$article[0]['idLore'].'">
      <input type="hidden" name="idNav" value="'.$data.'">
    <button type="submit" name="button">Modifier</button>
    </form>
        <form class="formulaire" action="CUD/Delette/lore.php" method="post">
        <input type="hidden" name="idLore" value="'.$article[0]['idLore'].'">
        <input type="hidden" name="idNav" value="'.$data.'">
        <button type="submit" name="button">Effacer</button>
        </form>
    ';
  }
}
