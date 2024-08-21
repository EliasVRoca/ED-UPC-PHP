<?php
require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/helpers.php';
$memoria = new Memoria();
$cola = new Cola($memoria);

echo "-------------------------\n";
echo "---------WELCOME---------\n";
echo "OPCIONES: \n";
echo "1: INGRESAR EDAD PACIENTE\n";
echo "2: ATENDER PACIENTE PACIENTE\n";
echo "3: MOSTRAR COLA PACIENTE\n";
echo "4: PROMEDIO DE EDADES DE PACIENTES\n";
echo "\n";
do {
    echo "SELECCIONE UNA OPCIÓN: \n";

    $teclado = fgets(STDIN);
    if ($teclado == 1) {
        echo "INGRESE LA EDAD DEL PACIENTE\n";
        $dato = fgets(STDIN);
        $cola->poner($dato);
    }
    if ($teclado == 2) {
        echo "ATENDIENDO PACIENTE\n";
        $cola->sacar();
    }
    if ($teclado == 3) {
        echo "LISTANDO COLA\n";
        echo "\n";
        $mostrar = $cola->mostar();
        echo "$mostrar";
        echo "\n";
    }
    if ($teclado == 4) {
        echo "PROMEDIO EDAD PACIENTES\n";
        $lista_cola = $cola->mostar();
        $lista_cola = ltrim(rtrim($lista_cola, ','), ',');
        $edades = explode(',', $lista_cola);
        if (count($edades) == 0) {
            echo "PROMEDIO: 0 \n";
            continue;
        }
        $sumar_edades = 0;
        foreach ($edades as $key => $edad) {
            $sumar_edades = $sumar_edades + intval($edad);
        }
        $promedio = $sumar_edades / count($edades);
        echo "PROMEDIO: $promedio \n";
        echo "\n";
    }
} while ($teclado != -1);
exit(limpiarConsola());
