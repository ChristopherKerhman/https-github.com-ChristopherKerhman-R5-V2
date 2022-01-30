<?php
include 'securite/securiterUtilisateur.php';
require 'objets/lienCentrale.php';
require 'objets/univers.php';
require 'objets/factions.php';

$role = $_SESSION['role'];
$centrale = 2;
$LienCentrale = new LienCentrale($role, $centrale, $idNav);
$listeUnivers = new Univers();
$dataUnivers = $listeUnivers->listeUniversUser();
$listeFaction = new Factions ($_SESSION['idUser'], $idNav);
$dataUF = $listeFaction->readFactionUnivers();
$dataNav = $LienCentrale->NavCentrale();
 ?>
 <div class="flex-menuCentrale">
       <ul>
         <li><h3 class="sousTitre">Gestion Univers</h3></li>
         <?php
         $LienCentrale->affichageLien($dataNav);
          ?>
       </ul>
   <aside class="simpleColonne">
     <h4 class="sousTitre">Liste des univers</h4>
     <ul>
       <?php
       foreach ($dataUnivers as $key => $value) {
         echo '<li>'.$value['nomUnivers'].'</li>';
       }
        ?>
     </ul>
     <h4 class="sousTitre">Liste des factions</h4>
   <ul>
       <?php
       foreach ($dataUF   as $key => $value) {
         echo '<li>'.$value['nomUnivers'].' - '.$value['nomFaction'].'</li>';
       }
        ?>
     </ul>
   </aside>

 </div>
