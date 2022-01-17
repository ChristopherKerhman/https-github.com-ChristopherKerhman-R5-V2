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
$figurine = new Figurines($_SESSION['idUser'], $idNav);
// Tri des vehicule
// Selection de l'idFaction de la liste :
$idFaction = $dotationListe->factionListe($idListe) ;
// Trie des véhicules
$vehicule =  new Vehicules($_SESSION['idUser'], $idNav);
$listeVehicule = $vehicule->triListeVehicule ($idFaction);

 ?>
 <h3 class="sousTitre">Liste <?=$nameListe[0]['nomListe']?></h3>
 <h4>Les figurines disponibles</h4>
<?php
// Affichage des listes des figurines et résumé de leur caractéristique
foreach ($dataIdF as $key => $value) {
  $figurine->ficheFigurineCompleteListe ($value['id_Figurine']);
  echo '<form action="CUD/Create/liste.php" method="post">
    <input type="hidden" name="id_Liste" value="'.$idListe.'">
    <input type="hidden" name="id_Figurine" value="'.$value['id_Figurine'].'">
    <label for=numbre>Nombre</label>
    <input id="number" type="number" name="nbr" min="0" max="12">
    <input type="hidden" name="idNav" value="'.$idNav.'">
  <button type="submit" name="button">Ajouter à la liste</button>
  </form>';
}
 ?>
<h4>Les véhicules disponibles</h4>
<?php
foreach ($listeVehicule as $key => $value) {
  $dataVehicule = $vehicule->readVehicule($value['idVehicule']);
  $vehicule->ficheListe($dataVehicule);
  $dataArmes = $vehicule->dotationArme($value['idVehicule']);
  $DC = $dataVehicule[0]['DC'];
  foreach ($dataArmes as $cle => $valeur) {
    $armesVehicule = new Armes($_SESSION['idUser'], $idNav);
    $armesVehicule->ficheArmeListe ($valeur['id_Arme'], $DC);
  }
  echo '<form action="CUD/Create/liste.php" method="post">
        <input type="hidden" name="id_Liste" value="'.$idListe.'">
    <input type="hidden" name="id_Vehicule" value="'.$value['idVehicule'].'">
    <label for=numbre>Nombre</label>
    <input id="number" type="number" name="nbr" min="0" max="12">
    <input type="hidden" name="idNav" value="'.$idNav.'">
  <button type="submit" name="button">Ajouter à la liste</button>
  </form>';
echo '-- -- -- -- -- -- --';
}
 ?>
