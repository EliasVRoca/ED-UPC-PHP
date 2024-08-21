<?php

abstract class MemoriaAbs
{
    protected const MAX = 20;
    protected const NULO = -1;

    public $MEM = [];
    protected $libre;

    public function __construct()
    {
        for ($i = 0; $i < self::MAX; $i++) {
            $this->MEM[$i] = new NodoM("", $i, $i + 1);
        }
        $this->libre = 0;
        $this->MEM[self::MAX - 1]->link = self::NULO;
    }

    // Abstract methods
    public abstract function mostrarVarlibre();

    public abstract function mostrar();
    public abstract function new_espacio($cantidad);
    public abstract function delete_espacio($dir);
    public abstract function delete_dir($dir);
    public abstract function espacio_disponible();
    public abstract function espacio_ocupado();
    public abstract function dir_libre($dir);
    public abstract function poner_dato($dir, $lugar, $valor);
    public abstract function obtener_dato($dir, $lugar);
    public abstract function obtener_link($dir, $lugar);
    public abstract function espacio_palabra($cadena);
    public abstract function modificar_link($dir, $nuevo_link);
    public abstract function espacio_libre();
}

class NodoM
{
    public $dato;
    public $id;
    public $link;

    public function __construct($dato = "", $id = 0, $link = 0)
    {
        $this->dato = $dato;
        $this->id = $id;
        $this->link = $link;
    }
}

