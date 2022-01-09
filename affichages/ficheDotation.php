<?php
include 'stockageData/figurine.php';
include 'securite/securiterUtilisateur.php';
require 'objets/figurines.php';
require 'objets/armes.php';
require 'objets/rulesSp.php';
$idFigurine = filter($_GET['idFigurine']); ?>
<form action="CUD/Update/figurineOk.php" method="post">
  <input type="hidden" name="idFigurine" value="<?=$idFigurine?>">
  <input type="hidden" name="idNav" value="<?=$idNav?>">
  <button type="submit" name="button">Bon pour le service</button>
</form>
<?php
  $figurine = new Figurines ($_SESSION['idUser'], $idNav);
  $dataFiche = $figurine->readFiche($idFigurine);
  $tri = $figurine->UniversFaction($idFigurine);
  $figurine->ficheSimple($dataFiche);
  $figurine->spRules($idFigurine);
  $arme = new Armes($_SESSION['idUser'], $idNav);
  $DC = $dataFiche[0]['DC'];
  $dotationArme = $figurine->dotationArme($idFigurine);
  $prix = $figurine->calculPrixFigurine($idFigurine);
  echo '<strong>Prix final figurine : '.round($prix, 0).' points</strong>';
  echo '<br /><strong>Niveau de puissance : '.round($prix/100, 0).' </strong>';
  $figurine->delArmeAffecter($idFigurine, $idNav);
?>
<h3 class="sousTitre">Dotation</h3>
<?php
  foreach ($dotationArme as $key) {
    $doter = new Armes ($_SESSION['idUser'], $idNav);
    $dataArme = $doter->readOneArmes($key['id_Armes']);
    $doter->resumeArme($dataArme, $DC);
  }
  $dotationFigurine = $arme->readArmes($tri[0]['id_Faction']);
  $arme->mosaiqueArmes($dotationFigurine, $idFigurine, $idNav);
 ?>
<h3 class="sousTitre">Armes disponibles</h3>
<?php
// DC de la figurine :
$arme->resumeArme($dotationFigurine, $DC);
 ?>
