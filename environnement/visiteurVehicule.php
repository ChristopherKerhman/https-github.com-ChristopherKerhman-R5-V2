<?php
require 'objets/rulesSp.php';
require 'objets/vehicules.php';
require 'objets/armes.php';
$idUnivers  = filter($_GET['idUnivers']);

 ?>
 <h3 class="sousTitre">Moteur de recherche des véhicules par nom</h3>
 <form class="formulaire" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?idNav='.$idNav.'&idUnivers='.$idUnivers; ?>" method="post">
   <input class="sizeInpute" type="text" name="recherche" size="30" placeholder="Recherche un nom d'un véhicules'">
   <button type="submit" name="button">Rechercher</button>
  </form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$recherche = filter($_POST['recherche']);
$param = [['prep'=>':idUnivers', 'variable'=> $idUnivers], ['prep'=>':recherche', 'variable'=> $recherche]];
$sqlRecherche = "SELECT `idVehicule`, `nomUnivers`, `nomFaction`
FROM `transport`
INNER JOIN `univers` ON `id_Univers` = `idUnivers`
INNER JOIN `factions` ON `id_Faction` = `idFaction`
WHERE `nomVehicule` LIKE :recherche AND`id_univers` = :idUnivers AND `transport`.`partager` = 0 AND `service` = 1 ";
$reading = new readDB($sqlRecherche, $param);
$dataId = $reading->read();
if ($dataId == []) {
  echo '<p>Pas de données sur ce véhicule dans la base.</p>';
} else {

  foreach ($dataId as $key => $value) {
    echo '<p class="ficheFigurine">';
    echo 'Univers :'.$value['nomUnivers'].' Faction :'.$value['nomFaction'];
    $machine = new Vehicules (0, $idNav);
    $dataVehicule = $machine->readVehicule($value['idVehicule']);
    $machine->ficheListe($dataVehicule);
    $dataArmes = $machine->dotationArme($value['idVehicule']);
    $DC = $dataVehicule[0]['DC'];
    foreach ($dataArmes as $cle => $valeur) {
      $armesVehicule = new Armes(0, $idNav);
      $armesVehicule->ficheArmeListe($valeur['id_Arme'], $DC);
    }
    echo '</p>';
  }


}
} else {
echo 'Pas encore de résultat.';
}


 ?>
