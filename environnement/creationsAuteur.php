<?php
$sql = "SELECT `idUnivers`, `nomUnivers`, `NTUnivers`, `login`
FROM `univers`
INNER JOIN `users` ON `idUser` = `idProprietaire`
WHERE `univers`.`valide` = 1 AND `partager` = 1";
$param = [];
$universPartager = new readDB($sql, $param);
$listeUnivers = $universPartager->read();
 ?>

<h3 class="sousTitre">Liste des univers partagés</h3>
<ul>
  <?php
  foreach ($listeUnivers as $key => $value) {
    echo '<li>'.$value['nomUnivers'].' - Createur '.$value['login'].' NT '.$value['NTUnivers'].'
    <a class="lienBoutton" href="index.php?idNav=99&idUnivers='.$value['idUnivers'].'">Ouvrir</a>
    </li>';
  }

   ?>


</ul>
