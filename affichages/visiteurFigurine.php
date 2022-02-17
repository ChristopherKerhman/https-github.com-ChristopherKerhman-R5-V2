<?php
require 'objets/figurines.php';
require 'objets/rulesSp.php';
require 'objets/armes.php';
$idUnivers  = filter($_GET['idUnivers']);
 ?>
 <h3 class="sousTitre">Moteur de recherche des figurines par nom</h3>
 <form class="formulaire" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?idNav='.$idNav.'&idUnivers='.$idUnivers; ?>" method="post">
   <input class="sizeInpute" type="text" name="recherche" size="30" placeholder="Recherche un nom de figurine">
   <button type="submit" name="button">Rechercher</button>
  </form>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recherche = filter($_POST['recherche']);
    $param = [['prep'=>':idUnivers', 'variable'=> $idUnivers], ['prep'=>':recherche', 'variable'=> $recherche]];
    $sqlRecherche = "SELECT `idFigurine`, `nomUnivers`, `nomFaction`
FROM `figurines`
INNER JOIN `AffecterFigurineUF` ON `idFigurine` =  `id_Figurine`
INNER JOIN `univers` ON `id_Univers` = `idUnivers`
INNER JOIN `factions` ON `id_Faction` = `idFaction`
WHERE `nomFigurine` LIKE :recherche  AND `id_Univers` = :idUnivers AND `figurines`.`valide` = 1 AND `figurines`.`partager`= 0
ORDER BY `nomUnivers`, `nomFaction`";
    $reading = new readDB($sqlRecherche, $param);
    $dataId = $reading->read();
  if($dataId == []) {
    echo '<p>Pas d\'éléments dans la base de données des armes.</p>';
  }
  echo '<ul>';

  //  print_r($dataId);
    $ficheFigurine = new Figurines(0, $idNav);
  foreach ($dataId as $cle => $valeur) {
    $id = $valeur['idFigurine'];
    echo '<li><strong>'.$valeur['nomUnivers'].' - '.$valeur['nomFaction'].'</strong></li>';
    $ficheFigurine->ficheFigurineCompleteListe($id);
    }

  echo '</ul>';

  } else {
    echo 'Pas encore de résultat.';
  }


   ?>
