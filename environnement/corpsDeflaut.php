<?php
require 'objets/texteIndex.php';
$texte = new TexteIndex ();
$idTexte = $texte->readLastIdTexte();
$idTexte = $idTexte[0]['idTexte'];
$texte->presentationTexte($idTexte, 1);
if (!isset($_SESSION['idUser'])) {
  include 'javascript/galerie.php';
}
 ?>
