<?php
require 'objets/vehicules.php';
$listeVehicule = new Vehicules ($_SESSION['idUser'], $idNav);
 ?>
<h3 class="sousTitre">Liste des véhicules sans univers</h3>
<?php $listeVehicule->attribution(); ?>
<h3 class="sousTitre">Liste des véhicules attribués à un univers</h3>
<?php $listeVehicule->listeVehicule(0); ?>
<h3 class="sousTitre">Liste des véhicules fixer et en service</h3>
<?php $listeVehicule->listeVehicule(1); ?>
