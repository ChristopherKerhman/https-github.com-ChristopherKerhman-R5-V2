<?php
require 'objets/figurines.php';
$listeNF = new Figurines ($_SESSION['idUser'], $idNav);
$dataListeFigurines = $listeNF->ListeNouvelleFigurine();
 ?>
<h3 class="sousTitre">Liste des nouvelles figurines</h3>
<?php
$listeNF->affichageListe($dataListeFigurines);
 ?>
