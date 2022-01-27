<?php
include 'environnement/header.php';
// Blocage pour débloquer, mettre l'élément ligne 4 en commentaire.
//$_GET['idNav'] = 0;
// $Dev = 1 affichage des chemins / $dev = 0 chemin non affiché.
$dev = 1;
  if (isset($_GET['idNav'])) {
    $idNav = filter($_GET['idNav']);
    $requetteSQL = "SELECT  `cheminNav`
    FROM `nav` WHERE `idNav` = :idNav";
    $prepare = [['prep'=> ':idNav', 'variable' => $idNav]];
    $affichage = new readDB($requetteSQL, $prepare);
    $dataAffichage = $affichage->read();
  }
  echo '<article>';
  // Affichage de la navigation pour la version de dev
  if (($dev > 0) && (isset($dataAffichage[0]['cheminNav']))) {
    echo $dataAffichage[0]['cheminNav'];
  }
  // Fin Affichage de la navigation pour la version de dev
  if (empty($dataAffichage)) {
    include 'environnement/corpsDeflaut.php';
  } else {
    include $dataAffichage[0]['cheminNav'];
    $idNav = $dataAffichage[0]['cheminNav'];
  }
  echo '</article>';
include 'environnement/footer.php'
?>
