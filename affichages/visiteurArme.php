<?php
$idUnivers  = filter($_GET['idUnivers']);
require 'objets/armes.php';
require 'objets/univers.php';
require 'objets/rulesSp.php';
$sql ="SELECT `nomUnivers`, `NTUnivers` FROM `univers` WHERE `idUnivers` = :idUnivers AND `valide` = 1 AND `partager` = 1";
$param = [['prep'=>'idUnivers', 'variable'=>$idUnivers]];
$nomUnivers = new readDB($sql, $param);
$nomUnivers = $nomUnivers->read();
?>
<h3 class="sousTitre">Moteur de recherche des armes par nom dans l'univers - <?php  echo $nomUnivers[0]['nomUnivers']; ?></h3>
<form class="formulaire" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?idNav='.$idNav.'&idUnivers='.$idUnivers; ?>" method="post">
  <input class="sizeInpute" type="text" name="recherche" size="30" placeholder="Recherche un nom d'arme">
  <button type="submit" name="button">Rechercher</button>
 </form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $recherche = filter($_POST['recherche']);
  $param = [['prep'=>':idUnivers', 'variable'=> $idUnivers], ['prep'=>':recherche', 'variable'=> $recherche]];
  $sqlRecherche = "SELECT `idArmes`
  FROM `armes` WHERE `nom`  LIKE :recherche AND `id_Univers` = :idUnivers AND `valide` = 1";
  $reading = new readDB($sqlRecherche, $param);
  $dataId = $reading->read();
if($dataId == []) {
  echo '<p>Pas d\'éléments dans la base de données des armes.</p>';
}
echo '<ul>';
//  print_r($dataId);
  $ficheArmes = new Armes(0, $idNav);
foreach ($dataId as $cle => $valeur) {
  $id = $valeur['idArmes'];
  echo '<li>';
    $puissanceArme = $ficheArmes->valeurArmes($id);
    $ficheArmes->fichePublic($id, $puissanceArme);

  echo '</li>';
  }
echo '</ul>';

} else {
  echo 'Pas encore de résultat.';
}


 ?>
