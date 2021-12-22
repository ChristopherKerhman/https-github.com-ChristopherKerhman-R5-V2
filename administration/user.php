<?php
include 'administration/securite.php';
$role = ['Non valide', 'Utilisateur', 'Gestionnaire', 'Administrateur'];
$requetteSQL = "SELECT `idUser`, `nom`, `prenom`, `login`, `valide`, `role`
FROM `users`
ORDER BY `login` ASC";
$prepare = [];
$readUser = new readDB ($requetteSQL, $prepare);
$dataUser = $readUser->read();
$SQL = "SELECT `idNav`
FROM `nav`
WHERE `levelAdmi`= :role AND `centrale` = 1";
$preparation = [['prep'=> ':role', 'variable' => $_SESSION['role']]];
$dataNavCentrale = new readDB($SQL, $preparation);
$DNC = $dataNavCentrale->read();
$idNav = $DNC[0]['idNav'];
 ?>
<h3>Administration des utilisateurs</h3>
<article>
    <ul>
      <?php
      foreach ($dataUser as $key) {
      echo '<li><a class="lienBoutton" href="index.php?idNav='.$idNav.' &idUser='.$key['idUser'].'">'.$key['login'].' - Rôle : '.$role[$key['role']].'</a></li>';
      }
      ?>
    </ul>
</article>
