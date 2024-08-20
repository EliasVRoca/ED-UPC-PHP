<?php
require_once __DIR__. '/autoload.php';
$memoria = new Memoria();
$pila = new Pila($memoria);

$pila->meter('a');
$pila->meter('b');
$pila->meter('c');

$memoria->mostrar();

