<?php
require_once __DIR__. '/../abstract/Pila.php';
class Pila extends PilaAbs
{
    public function vacia() {
        if ($this->length == 0) {
            return true;
        }
        return false;
    }
    public function cima() {}
    public function meter($elemento) {}
    public function sacar() {}
    public function mostrar_pila() {}
    public function anterior($dir) {}
}
