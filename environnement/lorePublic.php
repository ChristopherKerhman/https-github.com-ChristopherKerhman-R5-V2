<?php
if(isset($_GET['page']) && (!empty($_GET['page']))) {
  $currentPage = filter($_GET['page']);
} else {
$currentPage = 1;
}
$parPage = 10;
// Déclaration de paramètre vide :
$param = [];
$requetteSQL = "SELECT COUNT(`idLore`) AS `nbrLore`
FROM `lore`
INNER JOIN `users` ON `lore`.`idCreateur` = `users`.`idUser`
WHERE  `lore`.`valide` = 1 AND `partager` = 1  AND `users`.`valide` = 1";
$nrbC = new readDB($requetteSQL, $param);
$dataNbrC = $nrbC->read();
$nbrArticle = $dataNbrC[0]['nbrLore'];
// nombre de page total arrondit au chiffre suppérieur.
$pages = ceil($nbrArticle/$parPage);
// Calcul du premier article dans la page.
$premier = ($currentPage * $parPage) - $parPage;
$triListe = "SELECT `idLore`, `titreLore`,`login`, `nomUnivers`
FROM `lore`
INNER JOIN `users` ON `idCreateur` = `idUser`
INNER JOIN `univers` ON `lore`.`idUnivers` = `univers`.`idUnivers`
WHERE  `lore`.`valide` = 1 AND `lore`.`partager` = 1 AND `users`.`valide` = 1
ORDER BY `nomUnivers` DESC LIMIT {$premier}, {$parPage}";
$traitement = new readDB($triListe, $param);
$dataTraiter = $traitement->read();
?>
 <h3 class="sousTitre">Les texte de Lore partagé les créateurs</h3>
<?php
echo '<ul>';
foreach ($dataTraiter as $key => $value) {
  //Penser à modifier durant la mise en ligne si besoin
  echo '<li><a class="lienBoutton" href="index.php?idNav=86&idLore='.$value['idLore'].'">lire</a>'.$value['nomUnivers'].' - '.$value['titreLore'].' par '.$value['login'].'</li>';
}

echo '</ul>';
 for ($page=1; $page <= $pages ; $page++ ) {
   echo '<a class="lienBoutton" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
 }
  ?>
