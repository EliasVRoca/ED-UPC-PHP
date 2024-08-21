<?php
require_once __DIR__ . '/../abstract/Cola.php';
class Cola extends ColaAbs
{
    public function vacia()
    {
        if ($this->longitud == 0) {
            return true;
        }
        return false;
    }
    public function primero()
    {
        if ($this->vacia()) {
            return null;
        }
        $dato = $this->m->obtener_dato($this->inicio, 0);
        return $dato;
    }
    public function poner($elemento)
    {
        $libre = $this->m->espacio_libre();
        $this->m->poner_dato($libre, 0, $elemento);
        $this->m->new_espacio(1);
        if ($this->vacia()) {
            $this->inicio = $libre;
            $this->final = $libre;
            $this->longitud++;
        } else {
            $this->m->modificar_link($this->final, $libre);
            $this->final = $libre;
            $this->longitud++;
        }
    }
    public function sacar()
    {
        if ($this->vacia()) {
            return null;
        } elseif ($this->longitud == 1) {
            $resultado = $this->m->obtener_dato($this->inicio, 0);
            $this->m->delete_dir($this->inicio);
            $this->inicio = -1;
            $this->final = -1;
            $this->longitud = 0;
            return $resultado;
        } else {
            $resultado = $this->m->obtener_dato($this->inicio, 0);
            $siguiente = $this->m->MEM[$this->inicio]->link;
            $this->m->delete_dir($this->inicio);
            $this->inicio = $siguiente;
            $this->longitud--;
            return $resultado;
        }
    }
    public function posponer($dir) {}
    public function mostar()
    {
        if ($this->vacia()) {
            return null;
        }
        $resultado = '';
        $dir = $this->inicio;
        while ($dir != -1) {
            $resultado = $resultado . ',' . $this->m->MEM[$dir]->dato;
            $dir = $this->m->MEM[$dir]->link;
        }
        return $resultado;
    }
}
