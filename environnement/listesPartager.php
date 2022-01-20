<?php
require 'objets/listes.php';
// Créer un accessé à l'objet liste
if(isset($_GET['page']) && (!empty($_GET['page']))) {
  $currentPage = filter($_GET['page']);
} else {
$currentPage = 1;
}
$parPage = 10;
// Déclaration de paramètre vide :
$param = [];
// Recherche du nombre de listes partagées
$requetteSQL = "SELECT COUNT(`idListe`) AS `nbrListe` FROM `listeArmee` WHERE `valide` = 1  AND `partager` = 1";
$nrbC = new readDB($requetteSQL, $param);
$dataNbrC = $nrbC->read();
$nbrArticle = $dataNbrC[0]['nbrListe'];
// nombre de page total arrondit au chiffre suppérieur.
$pages = ceil($nbrArticle/$parPage);
// Calcul du premier article dans la page.
$premier = ($currentPage * $parPage) - $parPage;
// Extration des listes partagées.
$triListe = "SELECT `idListe`, `nomListe`, `nomUnivers`, `nomFaction`, `listeArmee`.`idUser`, `login`
FROM `listeArmee`
INNER JOIN `univers` ON `id_Univers` = `idUnivers`
INNER JOIN `factions` ON `id_Faction` = `idFaction`
INNER JOIN `users` ON `listeArmee`.`idUser` = `users`.`idUser`
WHERE `listeArmee`.`partager` = 1 AND `listeArmee`.`valide` = 1
ORDER BY `nomUnivers`, `nomFaction` DESC LIMIT {$premier}, {$parPage}";
$traitement = new readDB($triListe, $param);
$dataTraiter = $traitement->read();
 ?>
 <h3 class="sousTitre">Les listes partagées par les créateurs</h3>
<?php
$shareListe = new Listes(0, $idNav);
$shareListe->listePublique($dataTraiter);
 ?>
 <?php
 for ($page=1; $page <= $pages ; $page++ ) {
   echo '<a class="lienBoutton" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
 }
  ?>
