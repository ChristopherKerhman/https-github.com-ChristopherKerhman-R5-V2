<?php
function filter($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function haschage($data) {
  $option = ['cost' => 10];
  $data = password_hash($data, PASSWORD_BCRYPT, $option);
  return $data;
}
function doublePOP($data, $idNav) {
  array_pop($data);
  array_pop($data);
  foreach ($data as $key => $value) {
    if(empty($value)) {
      header('location:../../index.php?idNav='.$idNav.'&message=Un champs est vide.');
    }
  }
  return $data;
}

 ?>
