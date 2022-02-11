<?php
$idUnivers  = filter($_GET['idUnivers']);
require 'objets/lienCentrale.php';
$LienCentrale = new LienCentrale(0, 9, $idNav);
$dataNav = $LienCentrale->NavCentrale();
$sql = "SELECT `nomUnivers`, `NTUnivers`, `login`
FROM `univers`
INNER JOIN `users` ON `idUser` = `idProprietaire`
WHERE `idUnivers` = :idUnivers AND `univers`.`valide` = 1 AND `partager` = 1";
$param = [['prep'=>':idUnivers', 'variable'=> $idUnivers]];
$action = new readDB($sql, $param);
$dataNomUnivers = $action->read();
$triFaction = "SELECT `nomFaction` FROM `factions` WHERE `idUnivers` = :idUnivers AND `valide` = 1 AND `partager` = 1";
$actionFaction = new readDB($triFaction, $param);
$dataFaction = $actionFaction->read();
?>
<h3 class="sousTitre"><?=$dataNomUnivers[0]['nomUnivers']?></h3>
<ul>
  <li>Créateur : <?=$dataNomUnivers[0]['login']?></li>
  <li>NT de l'univers : <?=$dataNomUnivers[0]['NTUnivers']?></li>
</ul>
<h4 class="sousTitre">Les factions de l'univers <?=$dataNomUnivers[0]['nomUnivers']?></h4>
<ul>
  <?php
    foreach ($dataFaction as $key => $value) {
      echo '  <li>'.$value['nomFaction'].'</li>';
    }
  ?>
</ul>
<h4 class="sousTitre">Moteurs de recherches</h4>
<ul>
  <?php
    $LienCentrale->affichageLienPartageUnivers($dataNav, $idUnivers);
   ?>

</ul>
