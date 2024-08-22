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
        $this->m->new_espacio(1);
        $this->m->poner_dato($libre, 0, $elemento);
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
            return 'null';
        } 
        $borrado = $this->posterior($this->inicio);
        $dato = $this->m->obtener_dato($this->inicio, 0);
        $this->m->delete_dir($this->inicio);
        $this->inicio = $borrado;
        $this->longitud--;
        return $dato;
    }
    public function posterior($dir)
    {
        if ($this->vacia()) {
            return -1;
        }
        $actual = $this->inicio;
        while ($actual != $dir) {
            $actual = $this->m->MEM[$actual]->link;
        }
        return $this->m->MEM[$actual]->link;
    }
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
