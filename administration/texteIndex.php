<?php
include 'securite/securiterCreateur.php';
include 'functionPagination.php';
include 'stockageData/yes.php';
require 'objets/lienCentrale.php';
require 'objets/texteIndex.php';
$role = $_SESSION['role'];
$centrale = 8;
$LienCentrale = new LienCentrale($role, $centrale, $idNav);
$dataNav = $LienCentrale->NavCentrale();
 ?>
<h3 class="sousTitre">Les textes en index</h3>
  <ul>
    <?php
    $LienCentrale->affichageLien($dataNav);
     ?>
  </ul>
<h3 class="sousTitre">Les textes déjà publié</h3>
<?php
// Navigation vers fiche de texte
$idNavTexte = 97;
// Début de la pagination
if(isset($_GET['page']) && (!empty($_GET['page']))) {
  $currentPage = filter($_GET['page']);
} else {
$currentPage = 1;
}
$parPage = 10;
// Déclaration de paramètre vide :
$param = [];
// Recherche du nombre d'armes total
$requetteSQL = "SELECT COUNT(`idTexte`) AS `nbr` FROM `texteIndex`";
$pages = parametrePagination ($parPage, $requetteSQL, $param );
$premier = ($currentPage * $parPage) - $parPage;
// Traitement des données a affiché.
$requetteSQL = 'SELECT `idTexte`, `login`, `titre`, `texte`, `texteIndex`.`valide`, `date`
FROM `texteIndex`
INNER JOIN `users` ON `id_User` = `idUser`
LIMIT '.$premier.', '.$parPage.'';
$dataTraiter = affichageData($requetteSQL, $param);
echo '<ul>';
foreach ($dataTraiter as $key => $value) {
  echo '<li class="line">'.$value['titre'].' Auteur : '.$value['login'].'
  Date de création : '.brassageDate($value['date']).'
  Publier : '.$yes[$value['valide']].'
  <a class="lienBoutton" href="index.php?idNav='.$idNavTexte.'&idTexte='.$value['idTexte'].'">Voir texte</a>
  <form action="CUD/Update/valideTexte.php" method="post">
    <label for="valide">Publier ?</label>
    <select id="valide" name="valide">';
    if ($value['valide'] >0) {
      echo '<option value="0">Non</option><option value="1" selected>Oui</option>';
    } else {
      echo '<option value="0" selected>Non</option><option value="1">Oui</option>';
    }
echo'</select>
    <input type="hidden" name="idTexte" value="'.$value['idTexte'].'">
    <input type="hidden" name="idNav" value="'.$idNav.'">
  <button type="submit" name="button">Modifier</button>
  </form>';
if ($value['valide'] == 0) {
  echo '<form action="CUD/Delette/texte.php" method="post">
  <input type="hidden" name="idTexte" value="'.$value['idTexte'].'">
  <input type="hidden" name="idNav" value="'.$idNav.'">
  <button type="submit" name="button">Effacer</button>
  </form>';
}
echo '</li>';
}
echo '</ul>';
navPagination($currentPage, $idNav);
 ?>
