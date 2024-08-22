<?php
require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/helpers.php';
$memoria = new Memoria();
$pila = new Pila($memoria);

echo "--------------------------\n";
echo "----WELCOME TO MYMONEY----\n";
echo "--------------------------\n";
do {
  echo "OPCIONES: \n";
  echo "1: INGRESAR DINERO\n";
  echo "2: RETIRAR CAMBIO\n";
  echo "3: VERIFICAR GANANCIAS\n";
  echo "4: MOSTRAR MEMORIA\n";
  echo "-1: TERMINAR PROGRAMA\n";
  echo "\n";
  echo "SELECCIONE UNA OPCIÓN: ";
  $teclado = fgets(STDIN);

  if ($teclado == 1) {
    echo "¿CUANTO DESEA INGRESAR?: \n";
    $ingresar = fgets(STDIN);
    $pila->meter(intval($ingresar));
    echo "INGRESADO EXITOSAMENTE, PRESIONE CUALQUIER TECLA PARA CONTINUAR: \n";
    fgets(STDIN);
  }
  if ($teclado == 2) {
    echo "¿CUANTO DESEA RETIRAR?: \n";
    $retirar = fgets(STDIN);
    $sacar = '';
    $sumar = 0;
    while ($sumar < $retirar) {
      $sacar = $pila->sacar();
      if ($sacar == 'null') {
        break;
      }
      $sumar += intval($sacar);
    }
    if ($sumar == $retirar) {
      echo "HA RETIRADO LA CANTIDAD DE $retirar \n";
      echo "PRESIONE CUALQUIER TECLA PARA CONTINUAR \n";
      fgets(STDIN);
    }
    if ($sumar > $retirar) {
      $residuo = $sumar - $retirar;
      $pila->meter($residuo);
      echo "HA RETIRADO LA CANTIDAD DE $retirar \n";
      echo "PRESIONE CUALQUIER TECLA PARA CONTINUAR \n";
      fgets(STDIN);
    }
    if ($sumar < $retirar) {
      echo "ADVERTENCIA NO TIENE SUFISIENTES FONDOS \n";
      echo "PRESIONE CUALQUIER TECLA PARA CONTINUAR \n";
      fgets(STDIN);
    }
  }
  if ($teclado == 3) {
    echo "LAS GANANCIAS ACTUALES SON: ";
    $mostrar = $pila->mostrar_pila();
    $en_pila = rtrim(ltrim($mostrar, ','), ',');
    $arreglo = explode(',', $en_pila);
    $suma = 0;
    foreach ($arreglo as $key => $dinero) {
      $suma += intval($dinero);
    }
    echo "$suma \n";
    echo "PRESIONE CUALQUIER TECLA PARA CONTINUAR \n";
    fgets(STDIN);
  }
  if ($teclado == 4) {
    $memoria->mostrar();
    echo "\n";
    echo "PRESIONE CUALQUIER TECLA PARA CONTINUAR: ";
    fgets(STDIN);
  }
  limpiarConsola();
} while ($teclado != -1);
exit(limpiarConsola());
