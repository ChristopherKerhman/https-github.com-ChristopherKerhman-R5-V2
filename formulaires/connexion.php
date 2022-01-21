<h3 class="titreArticle">Connexion</h3>
<form class="formulaire" action="securite/connexion.php" method="post">
  <label for="speudo">Votre pseudo</label>
  <input id="speudo" class="inputFormulaire" type="text" name="login" placeholder="Votre pseudo" required>
  <label for="mdp">Votre mot de passe</label>
  <input id="speudo" class="inputFormulaire" type="password" name="motDePasse" placeholder="Votre mot de passe" required>
  <button class="buttonStandard" type="submit" name="button">Connexion</button>
</form>
<div id="VERROU" class="formulaire">
  <a v-if="!cle" class="lienBoutton" v-on:click="cle = true">Mot de passe perdu ou oublié ?</a><a v-if="cle || cle2" class="lienBoutton" v-on:click="cle = false, cle2=false">Fermer</a>
  <form v-if="cle" class="formulaire" action="securite/lostMDP.php" method="post">
    <label for="mail">Votre mail de sécurité ?</label>
    <input id="mail" type="text" name="mailSecurite">
    <input type="hidden" name="idNav" value="<?=$idNav?>">
    <button class="buttonStandard" type="submit" name="button">Lancer la procédure</button>
  </form>
  <a v-if="!cle2" class="lienBoutton" v-on:click="cle2 = true">Vous avez un token de sécurité ?</a>
  <form v-if="cle2" class="formulaire" action="securite/tokenControl.php" method="post">
    <label for="token">Votre token de sécurité ?</label>
    <input id="token" type="password" name="token" placeholder="token de sécurité" required>
    <label for="mdp">Nouveau mot de passe</label>
    <input id="mdp" class="inputFormulaire" type="password" name="mdp" placeholder="Votre nouveau mot de passe" required>
    <input type="hidden" name="idNav" value="<?=$idNav?>">
    <button class="buttonStandard" type="submit" name="button">soumettre le token</button>
  </form>
</div>


<?php include 'javascript/verrou.php'; ?>
