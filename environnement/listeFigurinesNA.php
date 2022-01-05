environnement/listeFigurineNA.php
<?php
require 'objets/figurines.php';
$listeNF = new Figurines ($_SESSION['idUser'], $idNav);
$dataListeFigurines0 = $listeNF->ListeNouvelleFigurine(0, 0);
$dataListeFigurines1 = $listeNF->ListeNouvelleFigurine(1, 0);
$dataListeFigurines3 = $listeNF->ListeNouvelleFigurine(1, 1);
 ?>
 <article class="">
   <h3 class="sousTitre">Liste des nouvelles figurines</h3>
   <?php $listeNF->affichageListe($dataListeFigurines0); ?>
 </article>
<article class="">
  <h3 class="sousTitre">Liste des figurines affecter</h3>
  <?php $listeNF->affichageListeAffecter($dataListeFigurines1); ?>
</article>
 <article class="">
   <h3 class="sousTitre">Liste des figurines mise en service</h3>
   <?php $listeNF->affichageListeEnService($dataListeFigurines3); ?>
 </article>
