<h3 class="titreArticle">Formulaire d'inscription</h3>
<h4 class="sousTitreArticle">Votre identité</h4>
<form class="formulaire" action="CUD/Create/inscription.php" method="post">
      <label for="nom">Nom</label>
      <input id="nom" type="text" name="nom" required>
      <label for="prenom">Prenom</label>
      <input id="prenom" class="inputFormulaire" type="text" name="prenom" required>
      <label for="login">Login</label>
      <input id="login" class="inputFormulaire" type="text" name="login" required>
      <label for="mdp">Mot de passe</label>
      <input id="mdp" class="inputFormulaire" type="text" name="mdp" required>
            <label for="CGU">Acceptez-vous la RGPD & la CGU du site  ?</label>
        Cocher la casse si oui :<input id="CGU" type="checkbox" name="CGU">
            <a class="lienBoutton" href="index.php?idNav=93">Voir la RGPD & CGU</a>
    <button type="submit" name="button">Créer un compte</button>
</form>
