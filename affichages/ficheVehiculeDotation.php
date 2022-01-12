<?php include 'securite/securiterUtilisateur.php';
require 'objets/vehicules.php';
require 'objets/rulesSp.php';
require 'objets/armes.php';
$idVehicule = filter($_GET['idVehicule']); ?>
<form action="CUD/Update/fixerVehicule" method="post">
  <input type="hidden" name="idVehicule" value="<?=$idFigurine?>">
  <button type="submit" name="button">Bon pour le service</button>
</form>
<h3 class="titreArticle">Dotation de nouvelles armes sur un véhicule</h3>
<?php
$ficheVehicule = new Vehicules($_SESSION['idUser'], $idNav);
$dataVehicule = $ficheVehicule->readVehicule($idVehicule);
$dataUF = $ficheVehicule->UniversFaction($idVehicule);
$prix = $ficheVehicule->prixBrute($idVehicule);
$ficheVehicule->fiche($dataVehicule);
$ficheVehicule->spRules($idVehicule);
// On sort la valeur idFaction en vue du tri sur les armes.
$idF = $dataUF[0]['id_faction'];
$armes = new Armes($_SESSION['idUser'], $idNav);
$dataArmes = $armes->readArmes($idF);
 $ficheVehicule->delArmesVehicule($idVehicule);
$armes->mosaiqueArmes($dataArmes, $idVehicule, $idNav, 1);
 ?>
