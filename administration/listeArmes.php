<?php
include 'securite/securiterCreateur.php';
include 'administration/functionPagination.php';
require 'objets/armes.php';

$ListeArmes = new Armes(0, $idNav);
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
$requetteSQL = "SELECT COUNT(`idArmes`) AS `nbr` FROM `armes`";
$pages = parametrePagination ($parPage, $requetteSQL, $param );
// Calcul du premier article dans la page.
$premier = ($currentPage * $parPage) - $parPage;
// Traitement des données a affiché.
$requetteSQL = 'SELECT  `idArmes`, `armes`.`nom`, `fixer`, `armes`.`valide`, `prix`, `login`, `nomUnivers`, `nomFaction`, `fixer`
FROM `armes`
INNER JOIN `users` ON `idUser` = `idCreateur`
INNER JOIN `univers` ON `idUnivers` = `id_Univers`
INNER JOIN `factions` ON `idFaction` = `id_Faction`
ORDER BY `nomUnivers`, `nomFaction`, `armes`.`nom`
LIMIT '.$premier.', '.$parPage.'';
$dataTraiter = affichageData($requetteSQL, $param);
$ListeArmes->listeAdministrationArmes($dataTraiter, $currentPage);
navPagination($pages, $idNav);
?>
