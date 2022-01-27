<?php
include 'securite/securiterUtilisateur.php';
require 'objets/listes.php';
require 'objets/figurines.php';
require 'objets/vehicules.php';
require 'objets/armes.php';
$idListe = filter($_GET['idListe']);
$dotationListe = new Listes($_SESSION['idUser'], $idNav);
// Nom de la liste pour affichage
$nameListe = $dotationListe->nameListe($idListe);
// Tri des figurines et création de l'objet figurine
$dataIdF = $dotationListe->triFigurineListe($idListe);
//print_r($dataIdF);
$figurine = new Figurines($_SESSION['idUser'], $idNav);
// Tri des vehicule
// Selection de l'idFaction de la liste :
$idFaction = $dotationListe->factionListe($idListe) ;
// Trie des véhicules
$vehicule =  new Vehicules($_SESSION['idUser'], $idNav);
$listeVehicule = $vehicule->triListeVehicule ($idFaction);
 ?>
 <div class="flex-presentation">
<article class="affecterListe">
 <h3 class="sousTitre">Liste <?=$nameListe[0]['nomListe']?></h3>
 <h4>Les figurines disponibles</h4>
<?php
// Affichage des listes des figurines et résumé de leur caractéristique
foreach ($dataIdF as $key => $value) {
  echo '<form action="CUD/Create/affecterListe.php" method="post">
    <input type="hidden" name="id_Liste" value="'.$idListe.'">
    <input type="hidden" name="id_Figurine" value="'.$value['id_Figurine'].'">
    <label for=numbre>Nombre</label>
    <input id="number" type="number" name="nbr" min="0" max="12" value="1">
    <input type="hidden" name="idNav" value="'.$idNav.'">
  <button type="submit" name="button">Add '.$value['nomFigurine'].'</button>
  </form>';
  $figurine->ficheFigurineCompleteListe($value['id_Figurine']);
}
 ?>
<h4>Les véhicules disponibles</h4>
<?php
foreach ($listeVehicule as $key => $value) {
  echo '<form action="CUD/Create/affecterListe.php" method="post">
        <input type="hidden" name="id_Liste" value="'.$idListe.'">
    <input type="hidden" name="id_Vehicule" value="'.$value['idVehicule'].'">
    <label for=numbre>Nombre</label>
    <input id="number" type="number" name="nbr" min="0" max="12" value="1">
    <input type="hidden" name="idNav" value="'.$idNav.'">
  <button type="submit" name="button">Add '.$value['nomVehicule'].'</button>
  </form>';
  $dataVehicule = $vehicule->readVehicule($value['idVehicule']);
  $vehicule->ficheListe($dataVehicule);
  $dataArmes = $vehicule->dotationArme($value['idVehicule']);
  $DC = $dataVehicule[0]['DC'];
  foreach ($dataArmes as $cle => $valeur) {
    $armesVehicule = new Armes($_SESSION['idUser'], $idNav);
    $armesVehicule->ficheArmeListe ($valeur['id_Arme'], $DC);
  }
}
 ?>
</article>

<article class="affecterListe">
       <a class="lienBoutton" href="index.php?idNav=<?php $dotationListe->versListe(); ?>&idListe=<?=$idListe?>">Voir liste à imprimer</a>
        <?php $dotationListe->updatePartage ($idListe); ?>
  <h4 class="sousTitre">Composition de la liste</h4>



     Prix total de la liste : <?php $valeurListe = $dotationListe->sommeListe($idListe); if($valeurListe == 0) { echo 'Pas encore d\'éléments dans cette liste.';} else { echo round($valeurListe, 0).' points';}?><br />
     Point de commandement : <?php $pc = $dotationListe->pointCommandement($idListe);echo round($pc,0); if($pc > 1.5) { echo ' points';} else { echo ' point';} ?>
     <?php $dotationListe->resumeListe($idListe);?>
</article>
 </div>
