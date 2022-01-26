<?php
require 'objets/factions.php';
require 'objets/listes.php';
require 'objets/figurines.php';
require 'objets/vehicules.php';
require 'objets/armes.php';
$idListe = filter($_GET['idListe']);
$liste = new Listes(0, $idNav);
$nameListe = $liste->nameListe($idListe);
$factionListe = $liste->factionListe($idListe);
$UFListe = new Factions(0, $idNav);
$dataUFliste = $UFListe->nomFactionEtUnivers($factionListe);
$figurine = $liste->detailListeFigurine($idListe);
$vehicule = $liste->detailListeVehicule($idListe);
 ?>
<section class="listeBlanche">
 <h3 class="sousTitre"><?=$dataUFliste[0]['nomUnivers']?> / <?=$dataUFliste[0]['nomFaction']?> - Liste <?=$nameListe[0]['nomListe']?> </h3>
 <article class="listeBlanche">
   Prix total de la liste : <?php $valeurListe = $liste->sommeListe($idListe); if($valeurListe == 0) { echo 'Pas encore d\'éléments dans cette liste.';} else { echo round($valeurListe, 0).' points';}?><br />
   Point de commandement : <?php $pc = $liste->pointCommandement($idListe);echo round($pc,0); if($pc > 1.5) { echo ' points';} else { echo ' point';} ?>
<h5>Figurines</h5>
    <?php
      foreach ($figurine as $key => $value) {
        echo '<p class="ficheFigurine">';
            echo '<br />Nombre : '.$value['nbr'].'- '.round($value['prixTotal'], 0).' Points';
            $ficheFigurine = new Figurines(0, $idNav);
            $ficheFigurine->ficheFigurineCompleteListe ($value['id_Figurine']);
        echo '</p>';
      }

if(!empty($vehicule)) {
echo '<h5>Véhicules</h5>';
foreach ($vehicule as $key => $value) {
    echo '<p class="ficheFigurine">';
    echo '<br />Nombre : '.$value['nbr'].'- '.round($value['prixTotal'], 0).' Points';
    $machine = new Vehicules (0, $idNav);
    $dataVehicule = $machine->readVehicule($value['id_Vehicule']);
    $machine->ficheListe($dataVehicule);
    $dataArmes = $machine->dotationArme($value['id_Vehicule']);
    $DC = $dataVehicule[0]['DC'];
    foreach ($dataArmes as $cle => $valeur) {
      $armesVehicule = new Armes(0, $idNav);
      $armesVehicule->ficheArmeListe($valeur['id_Arme'], $DC);
    }
}
}

 ?>

 </article>
</section>
