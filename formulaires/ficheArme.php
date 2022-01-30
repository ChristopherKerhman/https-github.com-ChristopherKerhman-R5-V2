<?php
include 'securite/securiterUtilisateur.php';
require 'objets/armes.php';
require 'objets/rulesSp.php';
$idArmes = filter($_GET['idArmes']);
$ficheArmes = new Armes ($_SESSION['idUser'], $idNav);
$securiterID = $ficheArmes->securiteID($idArmes);
if(empty($securiterID)) {
  echo '<h3 class="sousTitre">Pas de données</h3>';
} else {
  if($securiterID[0]['fixer'] == 0) {
    echo '<form action="CUD/Update/fixer.php" method="post">
      <input type="hidden" name="fixer" value="0">
      <input type="hidden" name="idArmes" value="'.$idArmes.'">
      <input type="hidden" name="idNav" value="'.$idNav.'">
      <button type="submit" name="button">Fixer</button>
      </form>';
  }
  $puissanceArme = $ficheArmes->valeurArmes($idArmes);
  $dataFiche = $ficheArmes->ficheArme($idArmes, $puissanceArme);
  $ficheArmes->specialRulesFicheArmes($idArmes);
  $puissanceArme = $ficheArmes->valeurArmes($idArmes);
  echo '<br />';
  $ficheArmes->DelSpecialRules($idArmes, $idNav);
  $liste = new Rules();
  $type = 0;
  $dataRS = $liste->readRules($type);
  $liste->affectation($dataRS, $idArmes, $idNav, $type);
}
 ?>
