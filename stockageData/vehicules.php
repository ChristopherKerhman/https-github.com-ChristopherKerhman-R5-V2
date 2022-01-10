<?php
$typeVehicule = [['type'=>'civile', 'Valeur'=>2], ['type'=>'militaire', 'Valeur'=>4]];
$roleVehicule = [['role'=>'transport', 'valeur'=>2, 'PC'=>0.25],
                      ['role'=>'Soutient tactique', 'valeur'=>4, 'PC'=>0.35],
                      ['role'=>'Attaque rapide', 'valeur'=>3, 'PC'=>0.45],
                      ['role'=>'Véhicule de commandement', 'valeur'=>6, 'PC'=>2],
                      ['role'=>'Artillerie', 'valeur'=>4, 'PC'=>0.12]];
$dice =[['type' => 'D6', 'Valeur' => 2],
              ['type' => 'D8', 'Valeur' => 4],
              ['type' => 'D10', 'Valeur' => 6],
              ['type' => 'D12', 'Valeur' => 8]];
$tailleVehicule = [ ['taille' => 'Petit', 'Valeur' => 2],
                          ['taille' => 'Standard', 'Valeur' => 4],
                          ['taille' => 'Grand', 'Valeur' => 8],
                          ['taille' => 'Géant', 'Valeur' => 16]];
$pds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
$equipage = [['nbre'=>0, 'valeur'=>1],
                  ['nbre'=> 1, 'valeur'=>2],
                  ['nbre'=> 2, 'valeur'=>4],
                  ['nbre'=> 3, 'valeur'=>6],
                  ['nbre'=> 4, 'valeur'=>8],
                  ['nbre'=> 5, 'valeur'=>10],
                  ['nbre'=> 6, 'valeur'=>14]];
$passager = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
$svgVehicule = [['armure' => 'Aucune', 'Valeur' => 0.3],
                      ['armure' => '6+', 'Valeur' => 0.4],
                      ['armure' => '5+', 'Valeur' => 0.5],
                      ['armure' => '4+', 'Valeur' => 1],
                      ['armure' => '4++', 'Valeur' => 1.25],
                      ['armure' => '3+', 'Valeur' => 1.5],
                      ['armure' => '3++', 'Valeur' => 2],
                      ['armure' => '2+', 'Valeur' => 4]];
$yes = ['Non', 'Oui'];
