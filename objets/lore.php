<?php
class Lore {
  private $idLore;
  public function __construct($idLore) {
    $this->idLore = $idLore;
    $this->yes = ['Non', 'Oui'];
  }
  public function readLore() {
    $SQL = "SELECT `idLore`, `titreLore`, `texteLore`, `lore`.`valide`, `lore`.`partager`, `nomUnivers`, `login`
    FROM `lore`
    INNER JOIN `users` ON `idCreateur` = `idUser`
    INNER JOIN `univers` ON `univers`.`idUnivers` = `lore`.`idUnivers`
    WHERE `idLore` = :idLore";
    $prepare = [['prep' => ':idLore', 'variable'=> $this->idLore]];
    $readLore = new readDB($SQL, $prepare);
    $article = $readLore->read();
    if (empty($article)) {
      echo '<h4 class="sousTitre">Aucun article à cette référence.</h4>';
    } else {
      echo '<h4 class="sousTitre">'.$article[0]['titreLore'].' - Univers '.$article[0]['nomUnivers'].'</h4>
            <p class="articleLore">'.$article[0]['texteLore'].'
            <br /><br /><strong>Par l\'auteur '.$article[0]['login'].'</strong></p>';
    }

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
      <select id="partager" name="partager">';
      for ($i=0; $i <count($this->yes) ; $i++) {
        if($article[0]['partager'] == $i) {
          echo '<option value="'.$i.'" selected>
          '.$this->yes[$i].'</option>';
        } else {
          echo '<option value="'.$i.'">
          '.$this->yes[$i].'</option>';
        }
      }
      echo'<input type="hidden" name="idLore" value="'.$article[0]['idLore'].'">
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
