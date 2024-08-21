<?php
abstract class ColaAbs
{
    protected $longitud;
    protected $inicio;
    protected $final;
    protected MemoriaAbs $m;

    public function __construct(MemoriaAbs $mem)
    {
        $this->longitud = 0;
        $this->inicio = -1;
        $this->final = -1;
        $this->m = $mem;
    }

    public abstract function vacia();
    public abstract function primero();
    public abstract function poner($elemento);
    public abstract function sacar();
    public abstract function mostar();
    public abstract function posponer($dir);
}
