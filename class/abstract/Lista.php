<?php
abstract class ListaAbs
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
    public abstract function mostrarLongInifinal();
    public abstract function insertar($dir, $dato);
    public abstract function suprimir($dir);
    public abstract function modificarDato($pos, $dato);
    public abstract function vacia();
    public abstract function primero();
    public abstract function segundo();
    public abstract function fin();
    public abstract function anterior($dir);
    public abstract function posterior($dir);
    public abstract function mostrar_lista();
    public abstract function duplicado_posterior($dir, $dato);
}
