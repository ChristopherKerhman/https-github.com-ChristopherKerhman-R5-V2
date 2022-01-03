<?php
class Preparation {
  public function creationPrep ($data) {
    foreach ($data as $key => $value) {
      $prepare = array();
      foreach ($data as $key => $value) {
        $value = filter($value);
        array_push($prepare, ['prep' => ':'.$key, 'variable' => $value]);
      }
    }
    return $prepare;
  }
  public function creationPrepIdUser ($data) {
    foreach ($data as $key => $value) {
      $prepare = array();
      foreach ($data as $key => $value) {
        $value = filter($value);
        array_push($prepare, ['prep' => ':'.$key, 'variable' => $value]);
      }
    }
      array_push($prepare, ['prep' => ':idUser', 'variable' => $_SESSION['idUser']]);
      return $prepare;
  }
}
