affichages/listeFigurinesOk.php
<?php
require 'objets/figurines.php';
$listeFOk = new figurines ($_SESSION['idUser'], $idNav);
$listeFOk->listeFigOk();

 ?>
