<?php
require_once __DIR__ . '/Memoria.php';
abstract class PilaAbs
{
    protected $length;
    public $init;
    protected $end;
    protected MemoriaAbs $m;

    public function __construct(MemoriaAbs $mem)
    {
        $this->length = 0;
        $this->init = -1;
        $this->end = -1;
        $this->m = $mem;
    }
    public abstract function vacia();
    public abstract function cima();
    public abstract function meter($elemento);
    public abstract function sacar();
    public abstract function mostrar_pila();
    public abstract function mostrar_torre();
    public abstract function anterior($dir);

}
