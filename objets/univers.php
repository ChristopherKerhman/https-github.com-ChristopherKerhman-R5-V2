<?php
class Univers {
  private $idUser;
  public function __construct() {
    $this->idUser = $_SESSION['idUser'];
  }
  public function listeUniversUser() {
    $triUnivers = "SELECT  `nomUnivers`, `NTUnivers` FROM `univers` WHERE `idProprietaire` = :idUser ORDER BY `nomUnivers`";
    $param = [['prep'=>':idUser', 'variable'=>$this->idUser]];
    $liste = new readDB($triUnivers, $param);
    return $data = $liste->read();
  }
  public function readUniversUser() {
    $sql = "SELECT `idUnivers`, `nomUnivers`, `NTUnivers` FROM `univers` WHERE `idProprietaire` = :idUser AND `valide` = 1";
    $prepare = [['prep'=> ':idUser', 'variable' => $this->idUser]];
    $data = new readDB($sql, $prepare);
    $dataUnivers = $data->read();
    foreach ($dataUnivers as $key) {
      echo '<option value="'.$key['idUnivers'].'">'.$key['nomUnivers'].' - NT : '.$key['NTUnivers'].'</option>';
    }
  }
  public function listeUnivers() {
    $sql = "SELECT `idUnivers`, `nomUnivers`, `NTUnivers` FROM `univers` WHERE `idProprietaire` = :idUser AND `valide` = 1";
    $prepare = [['prep'=> ':idUser', 'variable' => $this->idUser]];
    $data = new readDB($sql, $prepare);
    $dataUnivers = $data->read();

    foreach ($dataUnivers as $index) {
        $requette = "SELECT `idLore`, `titreLore`, `texteLore`, `nomUnivers`
          FROM `lore`
          INNER JOIN `univers` ON   `lore`.`idUnivers` =`univers`.`idUnivers`
          WHERE `lore`.`idUnivers` = :idUnivers AND  `lore`.`valide` = 1 ORDER BY `titreLore`";
          $pre = [['prep'=> ':idUnivers', 'variable' => $index['idUnivers']]];
          $data = new readDB($requette, $pre);
          $dataLore = $data->read();
          foreach ($dataLore as $cle) {
            echo '<li><a class="lienBoutton" href="index.php?idNav=44&idLore='.$cle['idLore'].'">'.$cle['nomUnivers'].' - '.$cle['titreLore'].'</a></li>';
          }
    }

  }
}
