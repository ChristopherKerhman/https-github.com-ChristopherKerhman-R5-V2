</section>
</main>
<footer>
  <nav>
    <?php
      // Menu dynamique bas
      $triLien = "SELECT `idNav`, `nomLien`, `cheminNav` FROM `nav` WHERE `centrale` = 7 AND `valide` = 1";
      $param = [];
      $lienBas = new readDB($triLien, $param);
      $dataLienBas = $lienBas->read();
     ?>
  <ul class="flex-center upperSize">
    <?php foreach ($dataLienBas as $key) {
      echo '<li><a href="index.php?idNav='.$key['idNav'].'">'.$key['nomLien'].'</a></li>';
    } ?>
    <li><a href="https://blog.ludis-r5.fr">Le blog de ludis R5</a></li>

  </ul>
      <p id="copyrigth">
        Copyrigth &copy; <?=date('Y')?>
      </p>
  </nav>
<?php
  if((empty($_SESSION['RGPD'])) || $_SESSION['RGPD'] == 0) {
    echo '<h4>RGPD information</h4>
    <p>Ce site génére un cookie de session essentiel pour la navigation. Aucun dispositif ne traque vos déplacement sur le net où votre activiter sur ce site web.</p>
    <div class="line"><form method="post" action="securite/rgpd.php">
      <input type="hidden" name="RGPD" value="1">
      <button type="submit" name="button">Accepter</button>
      </form>
      <form method="post" action="securite/rgpd.php">
        <input type="hidden" name="RGPD" value="0">
        <button type="submit" name="button">Refuser</button>
        </form></div>';
  } else {
    echo 'Vous avez accepté le cookie de session de ce site.';
  }
?>

</footer>

</body>

</html>
<?php $conn = null; ?>
