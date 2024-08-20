<?php
require_once __DIR__ . '/../abstract/Memoria.php';
class Memoria extends MemoriaAbs
{
    public function mostrarVarlibre()
    {
        echo "\n " . $this->libre;
    }

    public function mostrar()
    {
        echo "Dir Dato Link \n";
        echo "*---------------* \n";

        foreach ($this->MEM as $actual) {
            $dato = $actual->dato;
            $link = $actual->link;
            $dir = $actual->id;
            echo "|" . $dir . "\t| " . $dato . "\t| " . $link . PHP_EOL;
            $dir++;
        }
    }
    public function new_espacio($cantidad = 0)
    {
        $d = $this->libre;
        for ($i = 0; $i < $cantidad - 1; $i++) {
            $d = $this->MEM[$d]->link;
        }
        $this->libre = $this->MEM[$d]->link;
        $this->MEM[$d]->link = -1;
    }
    public function delete_espacio($dir)
    {
        $x = $dir;
        while ($this->MEM[$x]->link != -1) {
            $x = $this->MEM[$x]->link;
        }
        $this->MEM[$x]->link = $this->libre;
        $this->libre = $dir;
    }
    public function delete_dir($dir)
    {
        $x = $dir;
        $this->MEM[$x]->link = $this->libre;
    }
    public function espacio_disponible()
    {
        $x = $this->libre;
        $c = 0;
        while ($x != -1) {
            $c++;
            $x = $this->MEM[$x]->link;
        }
        return $c;
    }
    public function espacio_ocupado()
    {
        $c = self::MAX - $this->espacio_disponible();
        return $c;
    }
    public function dir_libre($dir = 0)
    {
        $x = $this->libre;
        $c = false;
        while ($x != -1 && $c === false) {
            if ($x == $dir) {
                $c = true;
            }
            $x = $this->MEM[$x]->link;
        }
        return $c;
    }
    public function poner_dato($dir, $lugar, $valor)
    {
        $z = $dir;
        $i = 0;
        while ($i < $lugar - 1) {
            $z = $this->MEM[$z]->link;
            $i++;
        }
        $this->MEM[$z]->dato = $valor;
    }
    public function obtener_dato($dir, $lugar)
    {
        $z = $dir;
        $i = 0;
        while ($i < $lugar - 1) {
            $z = $this->MEM[$z]->link;
            $i++;
        }
        return $this->MEM[$z]->link;
    }
    public function espacio_palabra($cadena = '')
    {
        $d = $this->libre;
        for ($i = 0; $i < strlen($cadena); $i++) {
            $letra = $cadena[$i];
            $this->MEM[$d]->dato = $letra;
            $d = $this->MEM[$d]->link;
        }

        $this->libre = $this->MEM[$d - 1]->link;
        $this->MEM[$d - 1]->link = -1;
    }

    public function modificar_link($dir, $nuevo_link)
    {
        $this->MEM[$dir]->link = $nuevo_link;
    }

    public function espacio_libre() {
        return $this->libre;
    }
}
