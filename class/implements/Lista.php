<?php
require_once __DIR__ . '/../abstract/Lista.php';
class Lista extends ListaAbs
{
   
    public function mostrarLongInifinal()
    {
        echo "Inicio: " . $this->inicio . " \n";
        echo "Final: " . $this->final . " \n";
        echo "Longitud: " . $this->longitud . " \n";
    }
    public function insertar($dir, $dato)
    {
        $libre = $this->m->espacio_libre();
        $this->m->new_espacio(1);
        $this->m->poner_dato($libre, 0, $dato);
        if ($this->vacia()) {
            $this->inicio = $libre;
            $this->final = $libre;
            $this->longitud++;
        } elseif ($this->longitud == 1) {
            $this->m->modificar_link($this->primero(), $libre);
            $this->final = $libre;
            $this->longitud++;
        } else if ($dir == $this->primero()) {
            $this->m->modificar_link($libre, $this->posterior($this->primero()));
            $this->m->modificar_link($this->primero(), $libre);
            $this->longitud++;
        } else {
            $this->m->modificar_link($this->anterior($dir), $libre);
            $this->m->modificar_link($libre, $dir);
            $this->longitud++;
        }
    }
    public function suprimir($dir)
    {
        if ($this->vacia()) {
        } elseif ($dir == $this->primero()) {
            $this->inicio = $this->posterior($this->primero());
            $this->m->delete_dir($dir);
            $this->longitud--;
        } elseif ($dir == $this->fin()) {
            $this->final = $this->anterior($this->fin());
            $this->m->modificar_link($this->final, -1);
            $this->m->delete_dir($dir);
            $this->longitud--;
        } else {
            $this->m->modificar_link($this->anterior($dir), $this->posterior($dir));
            $this->m->delete_dir($dir);
        }
    }
    public function modificarDato($pos, $dato)
    {
        $this->m->poner_dato($this->primero(), $pos, $dato);
    }
    public function vacia()
    {
        if ($this->longitud == 0) {
            return true;
        }
        return false;
    }
    public function primero()
    {
        return $this->inicio;
    }
    public function segundo() {}
    public function fin()
    {
        return $this->final;
    }
    public function anterior($dir)
    {
        if ($this->vacia()) {
            return -1;
        }
        if ($dir == $this->primero()) {
            return -1;
        }
        $actual = $this->primero();
        while ($this->m->MEM[$actual]->link != $dir) {
            $actual = $this->m->MEM[$actual]->link;
        }
        return $actual;
    }
    public function posterior($dir)
    {
        if ($this->vacia()) {
            return -1;
        }
        $actual = $this->primero();
        while ($actual != $dir) {
            $actual = $this->m->MEM[$actual]->link;
        }
        return $this->m->MEM[$actual]->link;
    }
    public function mostrar_lista()
    {
        $lista_ordenada = "";
        $dir = $this->primero();
        while ($dir != -1) {
            $lista_ordenada = $lista_ordenada . ", " . $this->m->MEM[$dir]->dato;
            $dir = $this->m->MEM[$dir]->link;
        }
        return $lista_ordenada;
    }
    public function duplicado_posterior($dir, $dato)
    {
        $this->insertar($dir, $dato);
        $this->insertar($dir, $dato);
    }
}
