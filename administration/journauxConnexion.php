<?php
include 'administration/securite.php';
// Fonction de brassage de Date et heure
function brassageDate($data) {
  $date = $data;
  $year = substr($date,0,4);
  $month = substr($date,5,2);
  $day = substr($date,8,2);
  $date = $day.'/'.$month.'/'.$year;
  return $date;
}
// Paramètre de pagination
if(isset($_GET['page']) && (!empty($_GET['page']))) {
  $currentPage = filter($_GET['page']);
} else {
$currentPage = 1;
}
$parPage = 25;
// Déclaration de paramètre vide :
$param = [];
// Recherche des connexions aux sites
$requetteSQL = "SELECT COUNT(`idConnexion`) AS `nbrConnexion` FROM `journaux`";
$nrbC = new readDB($requetteSQL, $param);
$dataNbrC = $nrbC->read();
$nbrArticle = $dataNbrC[0]['nbrConnexion'];
// nombre de page total arrondit au chiffre suppérieur.
$pages = ceil($nbrArticle/$parPage);
// Calcul du premier article dans la page.
$premier = ($currentPage * $parPage) - $parPage;
$requetteSQL = "SELECT *
FROM `journaux`
ORDER BY `idConnexion` DESC LIMIT {$premier}, {$parPage}";
$traitement = new readDB($requetteSQL, $param);
$dataTraiter = $traitement->read();
$yes = ['Non', 'Oui'];
//print_r($dataTraiter);
 ?>
    <table>
      <caption>
        Journaux de connexion des utilisateurs et des visiteurs.
      </caption>
   <tr>
     <th>IdConnexion</th>
     <th>Id User</th>
     <th>login</th>
     <th>IP de connexion</th>
     <th>Mot de passe hacker</th>
     <th>Connexion réussit</th>
     <th>date et heure de connexion</th>
   </tr>
   <?php
   foreach ($dataTraiter as $key => $value) {
     $date = $value['dateHeure'];
     echo '<tr>
            <td>'.$value['idConnexion'].'</td>
            <td>'.$value['idUser'].'</td>';
        echo'<td>'.$value['login'].'</td>';
        if ($value['okConnexion']>0) {
        echo '<td><a class="lienBoutton" href="index.php?idNav=36 &idUser='.$value['idUser'].'">'.$value['login'].'</a></td>';
        } else {
        echo '<td>'.$value['login'].'</td>';
        }
        echo'<td>'.$value['mdpHacker'].'</td>
            <td>'.$value['ipUser'].'</td>
            <td>'.$yes[$value['okConnexion']].'</td>
            <td>'.brassageDate($date).' - heure = '.substr($date,10,6).'</td>
          </tr>';
   }
    ?>
  </table>
  <br />
  <?php
  for ($page=1; $page <= $pages ; $page++ ) {
    echo '<a class="lienBoutton" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }
   ?>
