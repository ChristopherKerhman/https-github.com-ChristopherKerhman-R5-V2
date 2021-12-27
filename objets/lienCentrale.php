<?php
class LienCentrale {
  private $role;
  private $centrale;
  private $idNav;
 public function __construct($role, $centrale, $idNav) {
   $this->role = $role;
   $this->centrale = $centrale;
   $this->idNav = $idNav;
 }
 public function NavCentrale() {
   $requetteSQL = "SELECT `idNav`, `nomLien`, `cheminNav`, `valide`, `levelAdmi`, `ordre`, `centrale`, `classement`
   FROM `nav`
  WHERE `levelAdmi` = :role AND `centrale`= :centrale AND `valide` = 1
  ORDER BY `classement` ASC";
  $prepare = [['prep'=> ':role', 'variable' => $this->role],
  ['prep'=> ':centrale', 'variable' => $this->centrale]];
  $nav = new readDB($requetteSQL, $prepare);
  $dataLien = $nav->read();
  return $dataLien;
 }
 public function affichageLien($data) {
   foreach ($data as $key) {
     echo '<li><a class="lienCentrale" href="index.php?idNav='.$key['idNav'].'">'.$key['nomLien'].'</a></li>';
   }
 }
}
