<?php
class NodoM
{
    public $dato;
    public $id;
    public $link;

    public function __construct($dato = "", $id = 0, $link = 0)
    {
        $this->dato = $dato;
        $this->id = $id;
        $this->link = $link;
    }
}
