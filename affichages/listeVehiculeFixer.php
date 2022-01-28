<?php
require 'objets/vehicules.php';
include 'administration/functionPagination.php';
$listeVehicules = new Vehicules ($_SESSION['idUser'], $idNav);
if(isset($_GET['page']) && (!empty($_GET['page']))) {
  $currentPage = filter($_GET['page']);
} else {
$currentPage = 1;
}
$parPage = 10;
// Déclaration de paramètre vide :
  $param = [['prep'=>':idUser', 'variable'=>$_SESSION['idUser']]];
// Recherche du nombre d'armes total
$requetteSQL = "SELECT COUNT(`idVehicule`) AS `nbr` FROM `transport` WHERE `fixer` = 1 AND `transport`.`idUser` = :idUser";
$pages = parametrePagination ($parPage, $requetteSQL, $param );
// Calcul du premier article dans la page.
$premier = ($currentPage * $parPage) - $parPage;
// Traitement des données a affiché.
$requetteSQL = 'SELECT `idVehicule`, `nomVehicule`, `typeVehicule`, `roleVehicule`,
`prixVehicule`, `nomUnivers`, `nomFaction`
FROM `transport`
INNER JOIN `univers` ON `idUnivers` = `id_Univers`
INNER JOIN `factions` ON `idFaction` = `id_Faction`
INNER JOIN `users` ON `users`.`idUser` = `transport`.`idUser`
WHERE `fixer` = 1 AND `transport`.`idUser` = :idUser
ORDER BY `nomUnivers`, `nomFaction`, `typeVehicule`, `roleVehicule` ,`nomVehicule`
LIMIT '.$premier.', '.$parPage.'';
$dataTraiter = affichageData($requetteSQL, $param);
//print_r($dataTraiter);
if(empty($dataTraiter)) {
    echo '<h4 class="sousTitre">Pas encore de véhicules fixées</h4>';
} else {
$listeVehicules->vehicule ($dataTraiter, $currentPage);
}
navPagination($pages, $idNav);
 ?>
