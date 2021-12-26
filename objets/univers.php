<?php
class Univers {
  private $idUser;
  public function __construct() {
    $this->idUser = $_SESSION['idUser'];
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
}
