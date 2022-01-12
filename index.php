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
         if (empty($dataAffichage)) {
            include 'environnement/corpsDeflaut.php';
         } else {
             // Affichage de la navigation pour la version de dev
            echo $dataAffichage[0]['cheminNav'];
            // Fin Affichage de la navigation pour la version de dev
            echo '<article>';
            include $dataAffichage[0]['cheminNav'];
            echo '</article>';
            $idNav = $dataAffichage[0]['cheminNav'];
         }
          ?>
<?php include 'environnement/footer.php' ?>
