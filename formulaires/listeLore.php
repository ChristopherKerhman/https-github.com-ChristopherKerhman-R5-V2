<?php
include 'securite/securiterUtilisateur.php';
include 'administration/functionPagination.php';
//$ListeArmes = new Armes(0, $idNav);
// Paramètre de pagination
if(isset($_GET['page']) && (!empty($_GET['page']))) {
  $currentPage = filter($_GET['page']);
} else {
$currentPage = 1;
}
$parPage = 10;
// Déclaration de paramètre vide :
$param = [['prep'=>':idUser', 'variable'=>$_SESSION['idUser']]];
// Recherche du nombre d'armes total
$requetteSQL = "SELECT COUNT(`idLore`) AS `nbr` FROM `lore` WHERE `idCreateur` = :idUser";
$pages = parametrePagination ($parPage, $requetteSQL, $param );
// Calcul du premier article dans la page.
$premier = ($currentPage * $parPage) - $parPage;
// Traitement des données a affiché.
$requetteSQL = 'SELECT `idLore`, `idCreateur`, `lore`.`idUnivers`, `titreLore`, `lore`.`valide`, `lore`.`partager`, `nomUnivers`, `login`
FROM `lore`
INNER JOIN `users` ON `idUser` = `idCreateur`
INNER JOIN `univers` ON `lore`.`idUnivers` = `univers`.`idUnivers`
WHERE `idCreateur` = :idUser
ORDER BY `nomUnivers`, `titreLore`
LIMIT '.$premier.', '.$parPage.'';

$dataTraiter = affichageData($requetteSQL, $param);
//print_r($dataTraiter);
?>
'<table>
  <caption>Table des figurine page : <?=$currentPage?></caption>
  <tr>
    <th>Id</th>
    <th>Createur</th>
    <th>Univers</th>
    <th>Titre</th>
    <th>Valide</th>
    <th>Partager</th>
    <th>modifier Valide</th>
    <th>Voir</th>
    <th>Modifier texte</th>
    <th>Effacer</th>
  </tr>

  <?php
$yes = ['Non', 'Oui'];
foreach ($dataTraiter as $key => $value) {
  echo '<tr>
    <td>'.$value['idLore'].'</td>
    <td>'.$value['login'].'</td>
    <td>'.$value['nomUnivers'].'</td>
    <td>'.$value['titreLore'].'</td>
    <td>'.$yes[$value['valide']].'</td>
    <td>'.$yes[$value['partager']].'</td>
    <td>
    <form action="administration/valideLore.php" method="post">
      <label for="valide">Valide ?</label>
      <select id="valide" name="valide">';
      for ($i=0; $i <count($yes) ; $i++) {
        if($value['valide'] == $i) {
          echo '<option value="'.$i.'" selected>
          '.$yes[$i].'
          </option>';
        } else {
          echo '<option value="'.$i.'">
          '.$yes[$i].'
          </option>';
        }
      }
  echo'</select>';
  echo '<label for="partager">Partager ?</label>
  <select id="partager" name="partager">';
  for ($i=0; $i <count($yes) ; $i++) {
    if($value['partager'] == $i) {
      echo '<option value="'.$i.'" selected>
      '.$yes[$i].'
      </option>';
    } else {
      echo '<option value="'.$i.'">
      '.$yes[$i].'
      </option>';
    }
  }

    echo'</select>';
  echo'<input type="hidden" name="idNav" value="'.$idNav.'">
        <input type="hidden" name="idLore" value="'.$value['idLore'].'">
        <button type="submit" name="button">Modifier</button>
      </form>
    </td>
    <td><a class="lienBoutton" href="index.php?idNav=86&idLore='.$value['idLore'].'">Voir</a></td>
    <td><a class="lienBoutton" href="index.php?idNav=44&idLore='.$value['idLore'].'">Modifier</a></td>
    <td>';
    if($value['valide']>0) {
      echo 'Texte valide';
    } else {
      echo'<form action="administration/delLore.php" method="post">
          <input type="hidden" name="idNav" value="'.$idNav.'">
          <input type="hidden" name="idLore" value="'.$value['idLore'].'">
          <button type="submit" name="button">Effacer</button>
        </form>';
    }

    echo'</td>
  </tr>';
}
?>

</table>
<?php
navPagination($pages, $idNav);
?>
