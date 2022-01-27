<?php
include 'securite/securiterCreateur.php';
include 'administration/functionPagination.php';
require 'objets/figurines.php';
$listeFigurines = new Figurines(0, $idNav);
// Paramètre de pagination
if(isset($_GET['page']) && (!empty($_GET['page']))) {
  $currentPage = filter($_GET['page']);
} else {
$currentPage = 1;
}
$parPage = 10;
// Déclaration de paramètre vide :
$param = [];
// Recherche du nombre d'armes total
$requetteSQL = "SELECT COUNT(`idFigurine`) AS `nbr` FROM `figurines`";
$pages = parametrePagination ($parPage, $requetteSQL, $param );
// Calcul du premier article dans la page.
$premier = ($currentPage * $parPage) - $parPage;
// Traitement des données a affiché.
$requetteSQL = 'SELECT `idFigurine`, `nomFigurine`, `figurines`.`valide`, `figurines`.`partager`, `figurineFixer`, `figurineAffecter`, `prix`, `prixFinal`, `login`, `nomUnivers`, `nomFaction`
FROM `figurines`
INNER JOIN `AffecterFigurineUF` ON `id_Figurine` = `idFigurine`
INNER JOIN `univers` ON `idUnivers` = `id_Univers`
INNER JOIN `factions` ON `idFaction` = `id_Faction`
INNER JOIN `users` ON `idUser` = `id_User`
ORDER BY `nomUnivers`, `nomFaction`, `nomFigurine`
LIMIT '.$premier.', '.$parPage.'';
$dataTraiter = affichageData($requetteSQL, $param);
//print_r($dataTraiter);
$listeFigurines->listeAdministrationFigurine($dataTraiter, $currentPage);
//$ListeArmes->listeAdministrationArmes($dataTraiter, $currentPage);
navPagination($currentPage, $idNav);
?>
