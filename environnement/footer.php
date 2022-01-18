

</section>
</main>

<footer>
  <nav>
  <ul class="flex-center upperSize">
    <li><a href="contact.php">Formulaire de contact</a></li>
    <li><a href="https://blog.ludis-r5.fr">Le blog de ludis R5</a></li>
    <li> <a href="https://aidedejeu.ludis-r5.fr">Aide de jeu en ligne</a></li>
  </ul>
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
