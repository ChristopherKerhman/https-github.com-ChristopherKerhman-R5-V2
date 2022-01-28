<?php
require 'objets/figurines.php';
include 'administration/functionPagination.php';
//$listeFOk = new figurines ($_SESSION['idUser'], $idNav);
//$listeFOk->listeFigOk();
// Paramètre de pagination
if(isset($_GET['page']) && (!empty($_GET['page']))) {
  $currentPage = filter($_GET['page']);
} else {
$currentPage = 1;
}
$parPage = 10;
// Nombre de figurine de l'utilateur
$param = [['prep'=>':idUser', 'variable'=>$_SESSION['idUser']]];
$requetteSQL = "SELECT COUNT(`idFigurine`) AS `nbr` FROM `figurines` WHERE `id_User` = :idUser AND `figurineFixer`=1 AND `valide` = 1";
$pages = parametrePagination ($parPage, $requetteSQL, $param );

// Calcul du premier article dans la page.
$premier = ($currentPage * $parPage) - $parPage;
$requetteSQL = "SELECT `idFigurine`, `nomFigurine`, `typeFigurine`, `nomFaction`, `nomUnivers`, `prixFinal`
FROM `figurines`
INNER JOIN `AffecterFigurineUF` ON `id_Figurine` = `idFigurine`
INNER JOIN `factions` ON `idFaction` = `AffecterFigurineUF`.`id_Faction`
INNER JOIN `univers` ON `univers`.`idUnivers` = `AffecterFigurineUF`.`id_Univers`
WHERE `id_User` = :idUser AND `figurineFixer` = 1
ORDER BY `nomUnivers`, `nomFaction`, `prixFinal`
DESC LIMIT {$premier}, {$parPage}";
$dataTraiter = affichageData($requetteSQL, $param);
$listeFOk = new figurines ($_SESSION['idUser'], $idNav);
$listeFOk->listeFigOk($dataTraiter);
?>
<?php
for ($page=1; $page <= $pages ; $page++ ) {
  echo '<a class="lienBoutton" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
}
 ?>
