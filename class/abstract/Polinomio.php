<?php
abstract class PolinimioAbs
{
  protected $inicio;
  protected $final;
  protected $cantidad;
  protected MemoriaAbs $m;

  public function __construct(MemoriaAbs $mem)
  {
    $this->inicio = -1;
    $this->final = -1;
    $this->cantidad = 0;
    $this->m = $mem;
  }

  public abstract function esCero();
  public abstract function grado();
  public abstract function coeficiente($exponente);
  public abstract function ponerTermino($coeficiente, $exponente);
  public abstract function numeroTerminos();
  public abstract function mostrarPolinomio();
  public abstract function derivada();
  public abstract function suma($sumando);
  public abstract function anterior($dir);
  public abstract function posterior($dir);

}
