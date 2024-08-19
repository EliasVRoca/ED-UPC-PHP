<?php
require_once __DIR__ . '/../abstract/Lista.php';
class Lista extends ListaAbs
{
    public function mostrarLongInifinal() {}
    public function insertar($dir, $dato)
    {
        $libre = $this->m->espacio_libre();
        $this->m->new_espacio(1);
        $this->m->poner_dato($libre, 0, $dato);
        if ($this->vacia()) {
            $this->inicio = $libre;
            $this->final = $libre;
            $this->longitud++;
        }elseif($this->longitud == 1){
            $this->m->modificar_link($this->primero(),$libre);
            $this->final = $libre;
            $this->longitud++;
        }else if ($dir == $this->primero())
        {
          $this->m->modificar_link($libre, $this->posterior($this->primero()));
          $this->m->modificar_link($this->primero(), $libre);
          $this->longitud++;
        }
        else
        {
          $this->m->modificar_link($this->anterior($dir), $libre);
          $this->m->modificar_link($libre, $dir);
          $this->longitud++;
        }
    }
    public function suprimir($dir) {}
    public function modificarDato($pos, $dato) {}
    public function vacia() {}
    public function primero() {}
    public function segundo() {}
    public function fin()
    {
        return $this->final;
    }
    public function anterior($dir) {}
    public function posterior($dir) {}
    public function mostrar_lista() {}
    public function duplicado_posterior($dir, $dato) {}
}
