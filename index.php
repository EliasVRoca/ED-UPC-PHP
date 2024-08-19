<?php
require_once __DIR__. '/autoload.php';

$pila = new Pila(new Memoria);

var_dump($pila->vacia());
