<?php
session_start();
include '../CUD/fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_SESSION['RGPD'] = filter($_POST['RGPD']);
  if ($_SESSION['RGPD'] == 1) {
    header('location:../index.php?message=RGPD accepté');
  } else {
    header('location:../index.php?message=RGPD refusé');
  }
} else {
  header('location:../index.php?message=Erreur de traitement');
}
