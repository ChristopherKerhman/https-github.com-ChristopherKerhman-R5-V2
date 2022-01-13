<?php include 'environnement/header.php' ?>
        <?php
        if (isset($_GET['idNav'])) {
          $idNav = filter($_GET['idNav']);
          $requetteSQL = "SELECT  `cheminNav`
          FROM `nav` WHERE `idNav` = :idNav";
          $prepare = [['prep'=> ':idNav', 'variable' => $idNav]];
          $affichage = new readDB($requetteSQL, $prepare);
          $dataAffichage = $affichage->read();
        }
         ?>
         <?php
           echo '<article>';
         if (empty($dataAffichage)) {

            include 'environnement/corpsDeflaut.php';
         } else {
             // Affichage de la navigation pour la version de dev
            echo $dataAffichage[0]['cheminNav'];
            // Fin Affichage de la navigation pour la version de dev

            include $dataAffichage[0]['cheminNav'];

            $idNav = $dataAffichage[0]['cheminNav'];
         }
            echo '</article>';
          ?>
<?php include 'environnement/footer.php' ?>
