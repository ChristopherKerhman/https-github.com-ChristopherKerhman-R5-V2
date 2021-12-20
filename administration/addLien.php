<?php
include 'administration/securite.php';
$yes = ['non', 'oui'];
$admin = ['Visiteur', 'Utilisateur', 'Createur', 'Administrateur' ];
 ?>
 <form action="CUD/Create/lien.php" method="post">
 <label for="nom"> Nom Lien</label>
 <input id="nomLien" class="inputFormulaire" type="text" name="nomLien">
 <label for="chemin">Chemin lien</label>
 <input id="chemin" class="inputFormulaire" type="text" name="cheminNav">
 <label for="levelAdmi">Niveau d\'administration</label>
 <select class="inputFormulaire" name="levelAdmi">
   <?php
 for ($i=0; $i < count($admin)  ; $i++) {
     echo '<option value="'.$i.'">'.$admin[$i].'</option>';
   }
    ?>
 </select>
 <label for="ordre">ordre</label>
 <input id="ordre" class="inputFormulaireNumber" type="number" min="0" max="10" name="ordre" value="'.$key['ordre'].'">
 <button class="buttonAdmin" type="submit" name="button">Créer</button>
 </form>

<?php
//print_r($_SESSION);
// Recherche des liens de la navigation
// objets et fonction nécessaire au fonctionnement de la log
require 'objets/liens.php';
$lien = new lienNav ();
$dataNav = $lien->readNav();


?>
<section>
  <article class="">
    <ul>
      <li><h4>Les liens des visiteurs</h4></li>
      <?php $lien->lienVisiteurs($dataNav); ?>
    </ul>
    <ul>
      <li><h4>Les liens des utilisateurs</h4></li>
      <?php $lien->lienUtilisateurs($dataNav); ?>
    </ul>
    <ul>
      <li><h4>Les liens des modérateurs</h4></li>
      <?php $lien->lienModerateurs($dataNav); ?>
    </ul>
    <ul>
      <li><h4>Les liens des administrateurs</h4></li>
      <?php $lien->lienAdministrateurs($dataNav); ?>
    </ul>
  </article>
</section>
