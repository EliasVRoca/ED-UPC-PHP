<?php
require_once __DIR__ . '/../abstract/Conjunto.php';
class Conjunto extends ConjuntoAbs
{
  public function anterior(int $dir): int
  {
    if ($this->vacio()) {
      return -1;
    }
    if ($dir == $this->inicio) {
      return -1;
    }
    $actual = $this->inicio;
    while ($this->m->MEM[$actual]->link != $dir) {
      $actual = $this->m->MEM[$actual]->link;
    }
    return $actual;
  }

  public function cardinal(): int
  {
    return $this->cantidad;
  }

  public function inserta(string $elemento): void
  {
    if (!$this->pertenece($elemento)) {
      $libre = $this->m->espacio_libre();
      $this->m->new_espacio(1);
      $this->m->poner_dato($libre, 0, $elemento);
      if ($this->vacio()) {
        $this->inicio = $libre;
        $this->final = $libre;
        $this->cantidad++;
      } else {
        $this->m->modificar_link($this->final, $libre);
        $this->final = $libre;
        $this->cantidad++;
      }
    }
  }

  public function mostrar_conjunto(): string
  {
    $dir = 1;
    $resultado = "";
    while ($dir <= $this->cantidad) {
      $resultado .= $this->m->obtener_dato($this->inicio, $dir) . " - ";
      $dir++;
    }
    return $resultado;
  }

  public function muestrea(): string
  {
    $aleatorio = rand(1, $this->cantidad);
    return $this->m->obtener_dato($this->inicio, $aleatorio);
  }

  public function ordinal(string $elemento): int
  {
    $dir = $this->inicio;
    $posicion = 0;
    if ($this->vacio()) {
      return 0;
    }
    while ($dir != -1) {
      $dato_actual = $this->m->obtener_dato($dir, 0);
      $posicion++;
      if ($dato_actual == $elemento) {
        return $posicion;
      }
      $dir = $this->m->MEM[$dir]->link;
    }
    return 0;
  }

  public function pertenece(string $elemento): bool
  {
    return $this->ordinal($elemento) != 0;
  }

  public function suprime(string $elemento): void
  {
    $dir = $this->inicio;
    while ($dir != -1) {
      if ($this->m->obtener_dato($dir, 0) == $elemento) {
        if ($dir == $this->inicio) {
          $this->inicio = $this->m->MEM[$dir]->link;
          $this->m->delete_dir($dir);
        } elseif ($dir == $this->final) {
          $this->final = $this->anterior($dir);
          $this->m->modificar_link($this->final, -1);
          $this->m->delete_dir($dir);
        } else {
          $this->m->modificar_link($this->anterior($dir), $this->m->MEM[$dir]->link);
          $this->m->delete_dir($dir);
        }
        $this->cantidad--;
      }
      $dir = $this->m->MEM[$dir]->link;
    }
  }

  public function vacio(): bool
  {
    return $this->cantidad == 0;
  }
}
