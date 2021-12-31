<?php
include 'administration/securite.php';
//$yes = ['non', 'oui'];
$admin = ['Visiteur', 'Utilisateur', 'Createur', 'Administrateur' ];
$centrale = ['Bandeau haut', 'Admin User', 'Univers', 'Armes', 'Figurines', 'Véhicule', 'Listes'];
 ?>
<form class="colonne" action="CUD/Create/lien.php" method="post">
  <h4 class="sousTitre">Ajouter un lien sur le site</h4>
    <label for="nom"> Nom Lien</label>
      <input id="nomLien" class="inputFormulaire" type="text" name="nomLien">
    <label for="chemin">Chemin lien</label>
      <input id="chemin" class="inputFormulaire" type="text" name="cheminNav">
    <label for="levelAdmi">Niveau d'administration</label>
      <select id="levelAdmi" class="inputFormulaire" name="levelAdmi">
      <?php
      for ($i=0; $i < count($admin)  ; $i++) {
      echo '<option value="'.$i.'">'.$admin[$i].'</option>';
      }
      ?>
      </select>
    <label for="ordre">ordre</label>
      <input id="ordre" type="number" min="0" max="10" name="ordre" value="0">
    <p>Pour le menus bandeau laisser ces éléments à 0</p>
    <label for="centrale">Lien au centre de la page</label>
      <select id="centrale" type="number"name="centrale">
        <?php
        for ($i=0; $i < count($centrale)  ; $i++) {
        echo '<option value="'.$i.'">'.$centrale[$i].'</option>';
        }
        ?>
      </select>
    <label for="classement">Classement du lien au centre de la page</label>
      <input id="classement" type="number" min="0" max="10" name="classement" value="0">
      <input type="hidden" name="idNavigation" value="<?=$idNav?>">
    <button type="submit" name="button">Créer</button>
</form>

<?php
//print_r($_SESSION);
// Recherche des liens de la navigation
// objets et fonction nécessaire au fonctionnement de la log
require 'objets/liens.php';
$lien = new lienNav ();
$dataNav = $lien->readNav();
?>
  <article>
    <ul>
      <li><h4>Les liens des visiteurs</h4></li>
      <?php $lien->liens($dataNav, 0);
        $lien->formulaire($dataNav, 0, $idNav);
       ?>
    </ul>
    <ul>
      <li><h4>Les liens des utilisateurs</h4></li>
      <?php $lien->liens($dataNav, 1);
      $lien->formulaire($dataNav, 1, $idNav);
       ?>
    </ul>
    <ul>
      <li><h4>Les liens des modérateurs</h4></li>
      <?php $lien->liens($dataNav, 2);
      $lien->formulaire($dataNav, 2, $idNav);
       ?>
    </ul>
    <ul>
      <li><h4>Les liens des administrateurs</h4></li>
      <?php $lien->liens($dataNav, 3);
      $lien->formulaire($dataNav, 3, $idNav);
       ?>
    </ul>
  </article>
