<h4 class="sousTitre">Formulaire de contact des administrateurs</h4>
  <p>Vous désirez nous contacter pour toutes questions concernant R-5 ou les sites web associer à R-5 ? Ce formulaire de contact est fait pour vous.</p>
  <form class="formulaire" action="CUD/Create/contact.php" method="post">
    <label for="email">E mail pour la réponse</label>
    <input id="email" class="sizeInpute" type="text" name="email" placeholder="Votre email" required>
    <label for="object">L'objet de votre demande</label>
    <input id="object" class="sizeInpute" type="text" name="objet" placeholder="Objet de votre demande" required>
    <textarea name="message" rows="8" cols="80">Votre message.</textarea>
    <label for="robot">A + B =</label>
    <input class="sizeInpute" id="robot" type="text" name="robot" value="AB" size="3">
    <input type="hidden" name="idNav" value="<?=$idNav?>">
    <button class="classique marge" type="submit" name="button">Envoyer</button>
    <button class="classique marge" type="reset" name="button">Effacer</button>
  </form>
