<?php
  include 'securite/securiterUtilisateur.php';
  include 'administration/functionPagination.php';
  require 'objets/armes.php';
    $listeArmes = new Armes ($_SESSION['idUser'], $idNav);
  if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
  } else {
  $currentPage = 1;
  }
  $parPage = 10;
  // Déclaration de paramètre vide :
  $param = [];
  $requetteSQL = "SELECT COUNT(`idArmes`) AS `nbr` FROM `armes` WHERE `fixer` = 1";
  $pages = parametrePagination ($parPage, $requetteSQL, $param );
  // Calcul du premier article dans la page.
  $premier = ($currentPage * $parPage) - $parPage;
  $requetteSQL = 'SELECT  `idArmes`,`armes`.`nom`, `prix`, `nomUnivers`, `nomFaction`
  FROM `armes`
  INNER JOIN `univers` ON `idUnivers` = `id_Univers`
  INNER JOIN `factions` ON `idFaction` = `id_Faction`
   WHERE `fixer` = 1
  ORDER BY `nomUnivers`, `nomFaction`, `armes`.`nom`
  LIMIT '.$premier.', '.$parPage.'';
  $dataTraiter = affichageData($requetteSQL, $param);

$listeArmes->listeArmesPagination($dataTraiter, $currentPage);
navPagination($pages, $idNav);

 ?>
