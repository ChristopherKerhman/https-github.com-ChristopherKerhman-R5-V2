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
      <input type="hidden" name="idProprietaire" value="<?=$_SESSION['idUser']?>">
      <input type="hidden" name="idNav" value="<?=$idNav?>">

      <?php if($_SESSION['univers'] <= 0) {
        echo '<button type="button" name="button">Impossible de créer un univers</button>';
      } else {
        echo '<button type="submit" name="button">Créer un univers</button>';
      }
       ?>

</form>
