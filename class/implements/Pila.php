<?php
require_once __DIR__ . '/../abstract/Pila.php';
class Pila extends PilaAbs
{
  public function vacia()
  {
    if ($this->length == 0) {
      return true;
    }
    return false;
  }
  public function cima()
  {
    if ($this->vacia()) {
      return null;
    }
    $dato = $this->m->obtener_dato($this->init, $this->length);
    return $dato;
  }
  public function meter($elemento)
  {
    $libre = $this->m->espacio_libre();
    $this->m->poner_dato($this->m->espacio_libre(), 0, $elemento);
    $this->m->new_espacio(1);

    if ($this->vacia()) {
      $this->init = $libre;
      $this->end = $libre;
      $this->length++;
    } else {
      $this->m->modificar_link($this->end, $libre);
      $this->end = $libre;
      $this->length++;
    }
  }
  public function sacar() {
    if($this->vacia()){
      return null;
    }
    elseif($this->length == 1){
      $dato = $this->m->obtener_dato($this->init, $this->length);
      $this->m->delete_dir($this->end);
      $this->init = -1;
      $this->end = -1;
      $this->length--;
      return $dato;
    }
    else{
      $dato = $this->m->obtener_dato($this->init, $this->length);
      $aux = $this->anterior($this->end);
      $this->m->modificar_link($this->anterior($this->end), -1);
      $this->m->delete_dir($this->end);
      $this->end = $aux;
      return $dato;

    }
  }
  public function mostrar_pila()
  {
    $pilaAux = new Pila($this->m);
    $ordenado = '';
    while (!$this->vacia()) {
      $dato = $this->sacar();
      $pilaAux->meter($dato);
      $ordenado = $ordenado . ', ' . $dato;
    }
    while (!$pilaAux->vacia()) {
      $dato = $pilaAux->sacar();
      $this->meter($dato);
    }
    return rtrim(ltrim($ordenado, ','), ',');
  }
  public function anterior($dir)
  {
    if ($this->vacia()) {
      return -1;
    }
    if ($dir) {
      return -1;
    }
    $actual = $this->init;
    while ($this->m->MEM[$actual]->link != $dir) {
      $actual = $this->m->MEM[$actual]->link;
    }
    return $actual;
  }
}
