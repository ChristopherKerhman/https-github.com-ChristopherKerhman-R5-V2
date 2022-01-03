<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/readDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $id = filter($_POST['idFigurine']);
  $prepare = [['prep'=> ':id', 'variable' => $id]];
  $requetteSQL = "SELECT `nomFigurine`, `description`, `typeFigurine`, `tailleFigurine`, `DQM`, `DC`, `svg`, `pdv`, `mouvement`, `valide`, `partager`, `figurineFixer`, `figurineAffecter`, `prix`
  FROM figurines WHERE idFigurine = :id";
  $action = new readDB($requetteSQL, $prepare);
  $dataClone = $action->read();
      $paramClone = array();
      for ($i=0; $i <count($dataClone) ; $i++) {
        foreach ($dataClone[$i] as $key => $value) {
          array_push($paramClone, ['prep' => ':'.$key, 'variable' => $value]);
        }
      }
array_push($paramClone, ['prep' => ':idUser', 'variable' => $_SESSION['idUser']]);
  $clone = "INSERT INTO figurines(`nomFigurine`, `description`, `typeFigurine`, `tailleFigurine`, `DQM`, `DC`, `svg`, `pdv`, `mouvement`, `valide`, `partager`, `figurineFixer`, `figurineAffecter`, `prix`, `id_User`)
  VALUES (:nomFigurine, :description, :typeFigurine, :tailleFigurine, :DQM, :DC, :svg, :pdv, :mouvement, :valide, :partager, :figurineFixer, :figurineAffecter, :prix, :idUser)";
  $action = new CurDB ($clone, $paramClone);
  $action->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&message=Figurine '.$dataClone[0]['nomFigurine'].' cloner.');
} else {
  header('location:../../index.php?message=Erreur de traitement.');
}
