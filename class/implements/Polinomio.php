<?php
require_once __DIR__ . '/../abstract/Polinomio.php';
class Polinomio extends PolinimioAbs
{
  public function __construct()
  {
    parent::__construct();
  }
  public function esCero()
  {
    return $this->cantidad == 0 ? true : false;
  }
  public function grado()
  {
    if ($this->cantidad < 1) {
      return 0;
    }
    $dir = $this->posterior($this->inicio);
    $grado = intval($this->m->MEM[$dir]->dato);
    return $grado;
  }
  public function coeficiente($exponente)
  {
    if ($exponente > 0 && $exponente <= $this->grado()) {
      $dir = $this->inicio;
      while ($dir != -1) {
        $dir = $this->posterior($dir);
        $exponente_actual = intval($this->m->MEM[$this->anterior($dir)]);
        if ($exponente_actual == $exponente) {
          return intval($this->m->MEM[$this->anterior($dir)]);
        }
        $dir = $this->posterior($dir);
      }
    }
    return 0;
  }
  public function ponerTermino($coeficiente, $exponente)
  {
    if ($exponente > $this->grado()) {
      $dir_coef = $this->m->espacio_libre();
      $this->m->new_espacio(1);
      $this->m->poner_dato($dir_coef, 0, $coeficiente);

      $dir_exp = $this->m->espacio_libre();
      $this->m->new_espacio(1);
      $this->m->poner_dato($dir_exp, 0, $exponente);

      $this->m->modificar_link($dir_coef, $dir_exp);

      $this->m->modificar_link($dir_exp, $this->inicio);
      $this->inicio = $dir_coef;
      $this->cantidad++;
      if ($this->final == -1) {
        $this->final = $dir_exp;
      }
    } else {
      $actual_coef = $this->inicio;
      while ($actual_coef != -1) {
        $actual_exp = $this->m->MEM[$actual_coef]->link;
        if ($this->m->MEM[$actual_exp]->dato == $exponente) {
          $suma = intval($this->m->MEM[$actual_coef]) + $coeficiente;
          $this->m->MEM[$actual_coef]->dato = $suma;
          if ($suma == 0) {
            if ($actual_coef == $this->inicio) {
              $this->inicio = $this->posterior($actual_exp);
              $this->m->delete_dir($actual_exp);
              $this->m->delete_dir($actual_coef);
            } elseif ($actual_exp == $this->final) {
              $this->final = $this->anterior($actual_coef);
              $this->m->delete_dir($actual_exp);
              $this->m->delete_dir($actual_coef);
            } else {
              $this->m->modificar_link($this->anterior($actual_coef), $this->posterior($actual_exp));
              $this->m->delete_dir($actual_exp);
              $this->m->delete_dir($actual_coef);
            }
            $this->cantidad--;
          }
          break;
        } elseif (intval($this->m->MEM[$actual_exp]->dato) < $exponente) {
          $dir_coef = $this->m->espacio_libre();
          $this->m->new_espacio(1);
          $this->m->poner_dato($dir_coef, 0, $coeficiente);

          $dir_exp = $this->m->espacio_libre();
          $this->m->new_espacio(1);
          $this->m->poner_dato($dir_exp, 0, $actual_coef);

          $this->m->modificar_link($dir_coef, $dir_exp);

          $this->m->modificar_link($this->anterior($actual_coef), $dir_coef);
          $this->m->modificar_link($dir_exp, $actual_coef);
          $this->cantidad++;
          break;
        }
        $actual_coef = $this->m->MEM[$actual_exp]->link;
        if ($actual_coef == -1) {
          $dir_coef = $this->m->espacio_libre();
          $this->m->new_espacio(1);
          $this->m->poner_dato($dir_coef, 0, $coeficiente);

          $dir_exp = $this->m->espacio_libre();
          $this->m->new_espacio(1);
          $this->m->poner_dato($dir_exp, 0, $exponente);
          $this->m->modificar_link($dir_coef, $dir_exp);
          $this->m->modificar_link($this->final, $dir_coef);
          $this->cantidad++;
          $this->final = $dir_exp;
          $this->m->modificar_link($this->final, -1);
        }
      }
    }
  }
  public function numeroTerminos() {}
  public function mostrarPolinomio()
  {
    $i = $this->grado();
    $resultado = "";
    while ($i > 0) {
      if ($this->coeficiente($i) != 0) {
        $resultado = ($resultado + $this->coeficiente($i)) . "X^" . $i . " + ";
      }
      $i--;
    }
    return $resultado;
  }
  public function derivada() {}
  public function suma($sumando = new Polinomio())
  {
    $i = $sumando->grado();
    while ($i > 0) {
      if ($sumando->coeficiente($i) > 0) {
        $this->ponerTermino($sumando->coeficiente($i), $i);
      }
      $i--;
    }
  }
  public function anterior($dir)
  {
    if ($this->esCero()) {
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
  public function posterior($dir)
  {
    if ($this->esCero()) {
      return -1;
    }
    $actual = $this->inicio;
    while ($actual != $dir) {
      $actual = $this->m->MEM[$actual]->link;
    }
    return $this->m->MEM[$actual]->link;
  }
}
