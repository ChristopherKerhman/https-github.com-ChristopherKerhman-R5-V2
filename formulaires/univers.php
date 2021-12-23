<?php
//include 'securite/securiterUtilisateur.php';
 ?>
<h3 class="titreArticle">Creation univers</h3>
<form class="formulaire" action="CUD/Create/univers.php" method="post">
  <p>Vous avez <?=$_SESSION['univers']?> univers a créer.</p>
      <label for="nom">Nom de votre univers</label>
      <input id="nom" type="text" name="nomUnivers" required>
      <label for="NT">NT de votre univers</label>
      <select class="inputFormulaire"  name="NTunivers">
        <?php
        for ($i=0; $i < 13 ; $i++) {
          if ($i == 6) {
            echo '<option value="'.$i.'" selected>NT '.$i.'</option>';
          } else {
          echo '<option value="'.$i.'">NT '.$i.'</option>';
          }
        }
         ?>
      </select>
      <input type="hidden" name="idNav" value="<?php echo $idNav; ?>">
      <?php if($_SESSION['univers'] <= 0) {
        echo '<button type="button" name="button">Impossible de créer un univers</button>';
      } else {
        echo '<button type="submit" name="button">Créer un univers</button>';
      }
       ?>
</form>
<h4 class="sousTitre">Les univers déjà créé par <?=$_SESSION['login']?></h4>
<?php
include 'stockageData/yes.php';
  $select = "SELECT `idUnivers`, `nomUnivers`, `NTUnivers`, `partager`
  FROM `univers`
  WHERE `valide` = 1 AND `idProprietaire` = :idUser";
  $data = [['prep'=> ':idUser', 'variable' => $_SESSION['idUser']]];
  $univers = new readDB($select, $data);
  $dataUnivers = $univers->read();
 ?>
<ul>
  <?php
  foreach ($dataUnivers as $key) {
  echo '<li>
      Nom : '.$key['nomUnivers'].' - Niveau Technologique '.$key['NTUnivers'].' - Partage création : '.$yes[$key['partager']].'
      </li>';
    echo '<li class="line">
    <form action="CUD/Update/univers.php" method="post">
      <label for="nom">Nom de votre univers</label>
      <input id="nom" class="inputFormulaire" type="text" name="nomUnivers" value="'.$key['nomUnivers'].'">
      <label for="partager">Partager la création ?</label>
      <select class="inputFormulaire" name="partager">
        <option value="0" selected>Non</option>
        <option value="1">Oui</option>
      </select>
        <input type="hidden" name="idNav" value="'.$idNav.'">
        <input type="hidden" name="idUnivers" value="'.$key['idUnivers'].'">
        <input type="hidden" name="del" value="0">
      <button type="submit" name="button">Modifier</button>
    </form>
    <form action="CUD/Update/univers.php" method="post">
    <input type="hidden" name="del" value="1">
    <input type="hidden" name="nomUnivers" value="'.$key['nomUnivers'].'">
    <input type="hidden" name="partager" value="1">
    <input type="hidden" name="idNav" value="'.$idNav.'">
    <input type="hidden" name="idUnivers" value="'.$key['idUnivers'].'">
    <button type="submit" name="button">Effacer</button>
    </form>
    </li>';
  }
   ?>
</ul>
