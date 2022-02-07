<?php
function parametrePagination ($parPage, $requetteSQL, $param ) {
  $nrbC = new readDB($requetteSQL, $param);
  $dataNbrC = $nrbC->read();
  $nbrArticle = $dataNbrC[0]['nbr'];
  // nombre de page total arrondit au chiffre suppérieur.
  return $pages = ceil($nbrArticle/$parPage);
}
function affichageData($requette, $param) {
  /*Modèle de requette
  $requetteSQL = 'SELECT  *
  FROM `armes`
  WHERE `armes`.`valide` = :valide
  ORDER BY `nomUnivers`, `nomFaction`, `armes`.`nom`
  LIMIT '.$premier.', '.$parPage.'';
  */
  $traitement = new readDB($requette, $param);
  return $dataTraiter = $traitement->read();
}

function navPagination($pages, $idNav) {
  for ($page=1; $page <= $pages ; $page++ ) {
    echo '<a class="lienBoutton" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }
}
function brassageDate($data) {
  $date = $data;
  $year = substr($date,0,4);
  $month = substr($date,5,2);
  $day = substr($date,8,2);
  $date = $day.'/'.$month.'/'.$year;
  return $date;
}
 ?>
