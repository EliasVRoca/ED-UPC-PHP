<?php
require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/helpers.php';
limpiarConsola();
$memoria = new Memoria();
$torreA = new Pila($memoria);
$torreB = new Pila($memoria);
$torreC = new Pila($memoria);

$data = [5, 4, 3, 2, 1];

foreach ($data as $key => $value) {
  $torreA->meter($value);
}

$control = 0;
// while (($torreA->vacia() && $torreB->vacia()) || $control >= 30) {
//   $disco = $torreA->sacar();
//   if ($torreB->) {
//     # code...
//   }
// }

echo 


$torreA->sacar();
$torreA->mostrar_torre();
$torreB->mostrar_torre();
$torreC->mostrar_torre();
