<?php
require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/helpers.php';
limpiarConsola();

$memoria = new Memoria();
$pila = new Pila($memoria);
$cola = new Cola($memoria);
$lista = new Lista($memoria);

$pila->meter('A');
$pila->meter('B');
$pila->meter('C');

$cola->poner(99);
$cola->poner(88);

$lista->insertar($lista->posterior($lista->primero()), 'mochi');
$lista->insertar($lista->posterior($lista->primero()), 'pocky');



$lista->modificarDato(0, 'AAA');

$cache = $cola->sacar();
$pila->meter($cache);

$cache = $pila->mostrar_pila();
$cache = rtrim($cache, ',');
$cache = ltrim($cache, ',');
$cache = explode(',', $cache);
$cache = $cache[0];
$cola->poner($cache);

$cache = $cola->mostar();
$cache = rtrim($cache, ',');
$cache = ltrim($cache, ',');
$cache = explode(',', $cache);
$cache = $cache[0];
$pila->meter($cache);


 $memoria->mostrar();
 echo "\n";
 echo $pila->mostrar_pila();
 echo "\n";
 echo $cola->mostar();
 echo "\n";
 echo $lista->mostrar_lista();
