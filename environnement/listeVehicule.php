<?php
require 'objets/vehicules.php';
$listeVehicule = new Vehicules ($_SESSION['idUser'], $idNav);
 ?>
<h3 class="sousTitre">Liste des véhicules sans univers</h3>
<?php $listeVehicule->attribution(); ?>
<h3 class="sousTitre">Liste des véhicules attribués à un univers</h3>
<?php $listeVehicule->listeVehicule(); ?>
