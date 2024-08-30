<?php
abstract class ConjuntoAbs
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

  abstract public function anterior(int $dir): int;
  abstract public function cardinal(): int;
  abstract public function inserta(string $elemento): void;
  abstract public function mostrar_conjunto(): string;
  abstract public function muestrea(): string;
  abstract public function ordinal(string $elemento): int;
  abstract public function pertenece(string $elemento): bool;
  abstract public function suprime(string $elemento): void;
  abstract public function vacio(): bool;
}
