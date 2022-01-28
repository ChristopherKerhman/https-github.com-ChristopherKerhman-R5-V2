<?php
include 'securite/securiterUtilisateur.php';
require 'objets/listes.php';
require 'objets/figurines.php';
include 'administration/functionPagination.php';
// Création de la liste des univers + faction associé
$triFaction = "SELECT `idFaction`,  `factions`.`idUnivers`, `nomFaction`, `nomUnivers`
FROM `factions`
INNER JOIN `univers` ON `univers`.`idUnivers` = `factions`.`idUnivers`
WHERE `idCreateur` = :idUser";
$param = [['prep'=>':idUser', 'variable'=>$_SESSION['idUser']]];
$FactionListe = new readDB($triFaction, $param);
$dataFU = $FactionListe->read();

 ?>
 <h3 class="sousTitre">Création d'une nouvelle liste</h3>
<form class="formulaire" action="CUD/Create/liste.php" method="post">
  <label for="nom">Nom de votre liste ?</label>
  <input type="text" name="nomListe">
  <label for="FU">Univers et faction de votre liste ?</label>
  <select id="FU" name="FU">
<?php
foreach ($dataFU as $index => $valeur) {
  echo '<option value="'.$valeur['idUnivers'].','.$valeur['idFaction'].'">'.$valeur['nomUnivers'].'- '.$valeur['nomFaction'].'</option>';
}
 ?>
</select>
<label for="share">Partager votre liste ?</label>
<select id="share" name="partager">
  <option value="1">Oui</option>
  <option value="0">Non</option>
</select>
<input type="hidden" name="idNav" value="<?=$idNav?>">
<button type="submit" name="button">Créer la liste</button>
</form>
<?php
$listeNouvelle = new Listes($_SESSION['idUser'], $idNav);
// Paramètre de pagination
if(isset($_GET['page']) && (!empty($_GET['page']))) {
  $currentPage = filter($_GET['page']);
} else {
$currentPage = 1;
}
$parPage = 10;
// Recherche du nombre total de liste
$requetteSQL = "SELECT COUNT(`idListe`) AS `nbr` FROM `listeArmee` WHERE `valide` = 1 AND `idUser` = :idUser";
$pages = parametrePagination ($parPage, $requetteSQL, $param );
// Calcul du premier article dans la page.
$premier = ($currentPage * $parPage) - $parPage;
$requetteSQL = 'SELECT `idListe`, `id_Univers`, `id_Faction`, `nomListe`, `listeArmee`.`partager`, `nomUnivers`, `nomFaction`
FROM `listeArmee`
INNER JOIN `univers` ON `idUnivers` = `id_Univers`
INNER JOIN `factions` ON `idFaction` = `id_Faction`
WHERE `listeArmee`.`valide` = 1 AND `idUser` = :idUser
ORDER BY `nomUnivers`, `nomFaction`, `nomListe`
LIMIT '.$premier.', '.$parPage.'';
$dataTraiter = affichageData($requetteSQL, $param);

if(empty($dataTraiter)) {
    echo '<h4 class="sousTitre">Pas encore de liste</h4>';
} else {
  echo 'Page : '.$currentPage;
$listeNouvelle->affichageListe($dataTraiter);
}
navPagination($pages, $idNav);
 ?>
