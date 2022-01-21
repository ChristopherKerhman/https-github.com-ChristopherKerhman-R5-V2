<?php
include 'administration/securite.php';
function triMessage ($type) {
  $tri = "SELECT `idContact`, `mail`, `objet`, `message`, `traitement` FROM `contact` WHERE `traitement` = :traitement";
  $param = [['prep'=>':traitement', 'variable'=>$type]];
  $readMessage = new readDB($tri, $param);
  return $data = $readMessage->read();
}
function affichageMessage ($data, $idNav) {
  $traitement = ['reçus', 'traiter', 'archiver'];
  echo '<ul>';
  foreach ($data as $key => $value) {
    echo '<li>De : '.$value['mail'].'</li>';
    echo '<li>Objet : '.$value['objet'].' - Statut : <strong>'.$traitement[$value['traitement']].'</strong></li>';
    echo '<li>Objet : '.$value['message'].'</li>';
    if ($value['traitement']>1) {
      echo '<form action="CUD/Delette/contact.php" method="post">
        <input type="hidden" name="idContact" value="'.$value['idContact'].'">
        <input type="hidden" name="idNav" value="'.$idNav.'">
        <button class="classique marge" type="submit" name="button">Effacer</button>
      </form>';
    } else {
      echo '<form action="CUD/Update/contact.php" method="post">
        <label for="traitement">Action</label>
        <select id="traitement" name="traitement">';
        for ($i=0; $i < count($traitement) ; $i++) {
          if($i == $value['traitement']) {
              echo '<option value="'.$i.'" selected>'.$traitement[$i].'</option>';
          } else {
            echo '<option value="'.$i.'">'.$traitement[$i].'</option>';
          }
        }
        echo '</select>
          <input type="hidden" name="idContact" value="'.$value['idContact'].'">
          <input type="hidden" name="idNav" value="'.$idNav.'">
          <button class="classique marge" type="submit" name="button">Modifier</button>
        </form>';
    }
  }
  echo '</ul>';
}

 ?>
<h3 class="sousTitre">Les messages reçus</h3>
<?php
$dataMessage = triMessage (0);
affichageMessage($dataMessage, $idNav);
 ?>
 <h3 class="sousTitre">Les messages traités</h3>
 <?php
 $dataMessage = triMessage (1);
 affichageMessage($dataMessage, $idNav);
  ?>
  <h3 class="sousTitre">Les messages archivés</h3>
  <?php
  $dataMessage = triMessage (2);
  affichageMessage($dataMessage, $idNav);
   ?>
