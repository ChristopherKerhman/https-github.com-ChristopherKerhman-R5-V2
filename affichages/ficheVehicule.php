affichages/ficheVehicule.php
<?php
require 'objets/vehicules.php';
$idVehicule = filter($_GET['idVehicule']);
$ficheVehicule = new Vehicules($_SESSION['idUser'], $idNav);
$dataVehicule = $ficheVehicule->readVehicule($idVehicule);
$prix = $ficheVehicule->prixBrute($idVehicule);
$ficheVehicule->fiche($dataVehicule);
 ?>
