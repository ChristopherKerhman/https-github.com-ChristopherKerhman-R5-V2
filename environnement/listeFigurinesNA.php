<?php
require 'objets/figurines.php';
$listeNF = new Figurines ($_SESSION['idUser'], $idNav);
$dataListeFigurines0 = $listeNF->ListeNouvelleFigurine(0);
$dataListeFigurines1 = $listeNF->ListeNouvelleFigurine(1);
 ?>
<h3 class="sousTitre">Liste des nouvelles figurines</h3>
<?php
$listeNF->affichageListe($dataListeFigurines0);
 ?>
 <h3 class="sousTitre">Liste des figurines affecter</h3>
 <?php
 $listeNF->affichageListeAffecter($dataListeFigurines1);
  ?>
