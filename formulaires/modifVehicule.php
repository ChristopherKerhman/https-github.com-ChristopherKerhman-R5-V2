forumlaires/modifVehicule.php
<?php
include 'securite/securiterUtilisateur.php';
include 'stockageData/vehicules.php';
require 'objets/vehicules.php';
$idVehicule = filter($_GET['idVehicule']);
$oneVehicule = new Vehicules ($_SESSION['idUser'], $idNav);
$dataVehicule = $oneVehicule->readVehicule($idVehicule);
$prix = $oneVehicule->prixBrute($idVehicule);
 ?>
 <h3 class="sousTitre">Modification de véhicule <?=$dataVehicule[0]['nomVehicule']?></h3>
 <h4 class="sousTitre">Prix : <?=round($prix,0)?> points</h4>
 <form class="formulaire" action="CUD/Update/vehicule.php" method="post">
 <label for="nom">Nom du vehicule</label>
 <input id="nom" type="text" name="nomVehicule" required value="<?=$dataVehicule[0]['nomVehicule']?>">
 <label for="description">Description</label>
 <textarea id="description" name="description" rows="8" cols="80" required><?=$dataVehicule[0]['description']?></textarea>
 <div class="flex-ligne">
 <label for="type">Type de véhicule</label>
 <select id="type" name="typeVehicule">
   <?php foreach ($typeVehicule as $key => $value) {
     if ($dataVehicule[0]['typeVehicule'] == $key) {
       echo '<option value="'.$key.'" selected>'.$value['type'].'</option>';
     } else {
       echo '<option value="'.$key.'">'.$value['type'].'</option>';
     }
    } ?>
 </select>

 <label for="role">Role du vehicule</label>
 <select id="role" name="roleVehicule">
   <?php foreach ($roleVehicule as $key => $value) {
     if ($dataVehicule[0]['roleVehicule'] == $key) {
     echo '<option value="'.$key.'" selected>'.$value['role'].'</option>';
   } else {
     echo '<option value="'.$key.'">'.$value['role'].'</option>';
   }

   } ?>
 </select>
 <label for="taille">Taille du vehicule</label>
 <select id="taille" name="tailleVehicule">
   <?php foreach ($tailleVehicule as $key => $value) {
      if ($dataVehicule[0]['tailleVehicule'] == $key) {
        echo '<option value="'.$key.'" selected>'.$value['taille'].'</option>';
      }
     else {
     echo '<option value="'.$key.'">'.$value['taille'].'</option>';
   }
   } ?>
 </select>
 </div>
 <div class="flex-ligne">
   <label for="crew">Nombre de membre d'équipage</label>
   <select id="crew" name="equipage">
       <?php foreach ($equipage as $key => $value) {
           if ($dataVehicule[0]['equipage'] == $key) {
            echo '<option value="'.$key.'" selected>'.$value['nbre'].'</option>';
          }
         else {
           echo '<option value="'.$key.'">'.$value['nbre'].'</option>';
         }
       } ?>
   </select>
   <label for="passager">Nombre de passager</label>
   <select id="passager" name="passage">
       <?php for ($i=0; $i <count($passager) ; $i++) {
         if ($i == $dataVehicule[0]['passage'] ) {
           echo '<option value="'.$i.'" selected>'.$passager[$i].'</option>';
         } else {
        echo '<option value="'.$i.'">'.$passager[$i].'</option>';
         }

       } ?>
   </select>
   </div>
 <div class="flex-ligne">
 <label for="DQM">Dé de qualité martial</label>
 <select id="DQM" name="DQM">
   <?php foreach ($dice as $key => $value) {
     if ($dataVehicule[0]['DQM'] == $key) {
     echo '<option value="'.$key.'" selected>'.$value['type'].'</option>'; }
     else {
        echo '<option value="'.$key.'">'.$value['type'].'</option>';
     }
   } ?>
 </select>
 <label for="DC">Dé de combat</label>
 <select id="DC" name="DC">
   <?php foreach ($dice as $key => $value) {
     if ($dataVehicule[0]['DC'] == $key) {
      echo '<option value="'.$key.'" selected>'.$value['type'].'</option>'; }
      else {
         echo '<option value="'.$key.'">'.$value['type'].'</option>';
      } } ?>
 </select>
 </div>
 <div class="flex-ligne">
   <label for="pds">Point de structure</label>
   <select id="pds" name="pds">
     <?php for ($i=0; $i <count($pds) ; $i++) {
       if ($i == $dataVehicule[0]['pds'] ) {
         echo '<option value="'.$i.'" selected>'.$pds[$i].' point de structure</option>';
       } else {
      echo '<option value="'.$i.'">'.$pds[$i].' point de structure</option>';
       }

     } ?>
   </select>
   <label for="svg">Sauvegarde</label>
   <select id="svg" name="svgVehicule">
     <?php foreach ($svgVehicule as $key => $value) {
       if ($dataVehicule[0]['svgVehicule'] == $key) {
         echo '<option value="'.$key.'" selected>'.$value['armure'].'</option>';
       }
       else {echo '<option value="'.$key.'">'.$value['armure'].'</option>';}} ?>
   </select>
 </div>
 <label>Mouvement tactique de référence : Reférence : <?=$dataVehicule[0]['deplacement']?>" / <?php echo round($dataVehicule[0]['deplacement']*1.5);  ?>" + 1D4" </label>
 <div id="COURSE" class="flex-ligne">

   <label for="deplacement">Déplacement tactique : {{mouvement}}" / Course {{course}}" + 1D4"</label>
     <input id="deplacement" type="range" name="deplacement" v-model="mouvement" min="0" max="28"/>
 </div>
 <div class="flex-ligne">
   <label for="vol">Vol :</label>
   <select id="vol" name="vol">
       <?php for ($i=0; $i <count($yes) ; $i++) {
         if ($i == $dataVehicule[0]['vol']) {
           echo '<option value="'.$i.'" selected>'.$yes[$i].'</option>';
         } else {
         echo '<option value="'.$i.'">'.$yes[$i].'</option>';}
       } ?>
   </select>
   <label for="station">Vol stationnaire :</label>
   <select id="station" name="stationnaire">
       <?php for ($i=0; $i <count($yes) ; $i++) {
         if ($i == $dataVehicule[0]['stationnaire']) {
           echo '<option value="'.$i.'" selected>'.$yes[$i].'</option>';
         } else {
         echo '<option value="'.$i.'">'.$yes[$i].'</option>';}
       } ?>
   </select>
 </div>
 <input type="hidden" name="idVehicule" value="<?=$idVehicule?>">
 <input type="hidden" name="idNav" value="<?=$idNav?>">
 <button type="submit" name="button">Modifier</button>
 </form>
 <?php include 'javascript/mouvementVehicule.php' ?>
