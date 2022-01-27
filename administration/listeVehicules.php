<?php
include 'securite/securiterCreateur.php';
include 'administration/functionPagination.php';
require 'objets/vehicules.php';
$listeVehicules = new Vehicules(0, $idNav);
// Paramètre de pagination
if(isset($_GET['page']) && (!empty($_GET['page']))) {
  $currentPage = filter($_GET['page']);
} else {
$currentPage = 1;
}
$parPage = 8;
// Déclaration de paramètre vide :
$param = [];
// Recherche du nombre d'armes total
$requetteSQL = "SELECT COUNT(`idVehicule`) AS `nbr` FROM `transport`";
$pages = parametrePagination ($parPage, $requetteSQL, $param );
// Calcul du premier article dans la page.
$premier = ($currentPage * $parPage) - $parPage;
// Traitement des données a affiché.
$requetteSQL = 'SELECT `idVehicule`, `nomVehicule`, `transport`.`valide`,
`fixer`, `prixVehicule`, `transport`.`idUser`, `nomUnivers`, `nomFaction`, `login`
FROM `transport`
INNER JOIN `univers` ON `idUnivers` = `id_Univers`
INNER JOIN `factions` ON `idFaction` = `id_Faction`
INNER JOIN `users` ON `users`.`idUser` = `transport`.`idUser`
ORDER BY `nomUnivers`, `nomFaction`, `nomVehicule`
LIMIT '.$premier.', '.$parPage.'';
$dataTraiter = affichageData($requetteSQL, $param);
//print_r($dataTraiter);
$listeVehicules->listeAdministrationVehicules($dataTraiter, $currentPage);

navPagination($pages, $idNav);
?>
