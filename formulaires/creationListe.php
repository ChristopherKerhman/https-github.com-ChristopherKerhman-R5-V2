<?php
include 'securite/securiterUtilisateur.php';
require 'objets/listes.php';
// Création de la liste des univers + faction associé
$triFU = "SELECT `idFaction`, `factions`.`idUnivers`, `nomFaction`, `nomUnivers`
FROM `factions`
INNER JOIN `univers` ON `univers`.`idUnivers` = `factions`.`idUnivers`
WHERE `idCreateur` = :idUser
ORDER BY `nomUnivers`";
$param = [['prep'=> ':idUser', 'variable'=> $_SESSION['idUser']]];
$liste = new readDB($triFU, $param);
$dataListeFU = $liste->read();
 ?>
 <h3 class="sousTitre">Création d'une nouvelle liste</h3>
<form class="formulaire" action="CUD/Create/liste.php" method="post">
  <label for="nom">Nom de votre liste ?</label>
  <input type="text" name="nomListe">
  <label for="FU">Univers et faction de votre liste ?</label>
  <select id="FU" name="FU">
<?php
foreach ($dataListeFU as $index => $valeur) {
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
$dataListeUser = $listeNouvelle->readListesUser(1);
$listeNouvelle->affichageListe($dataListeUser)

 ?>
