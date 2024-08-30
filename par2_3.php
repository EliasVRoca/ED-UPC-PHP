<?php
require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/helpers.php';

$memoria = new Memoria();
$cola = new Cola($memoria);
$pila = new Pila($memoria);

echo "--------------------------\n";
echo "----WELCOME TO BOOKSBO----\n";
echo "--------------------------\n";
do {
  echo "OPCIONES: \n";
  echo "1: INGRESAR NUEVO LIBRO\n";
  echo "2: INGRESAR NUEVO CLIENTE\n";
  echo "3: PRESTAR LIBRO\n";
  echo "4: DEVOLVER LIBRO\n";
  echo "5: VERIFICAR ALCANCE\n";
  echo "6: VOLTEAR PILA\n";
  echo "7: MOSTRAR MEMORIA\n";
  echo "-1: TERMINAR PROGRAMA\n";
  echo "\n";
  echo "SELECCIONE UNA OPCIÓN: ";
  $res = fgets(STDIN);

  if ($res == 1) {
    echo "INGRESE EL NOMBRE DEL LIBRO: .....";
    $ingresar = fgets(STDIN);
    $ingresar = ltrim($ingresar);
    $ingresar = rtrim($ingresar);
    $pila->meter($ingresar);
    echo "LIBRO REGISTRADO EXITOSAMENTE, PRESIONE CUALQUIER TECLA PARA CONTINUAR\n";
    fgets(STDIN);
  }
  if ($res == 2) {
    echo "INGRESE EL NOMBRE DEL CLIENTE: .....";
    $ingresar = fgets(STDIN);
    $ingresar = ltrim($ingresar);
    $ingresar = rtrim($ingresar);
    $cola->poner($ingresar);
    echo "CLIENTE REGISTRADO EXITOSAMENTE, PRESIONE CUALQUIER TECLA PARA CONTINUAR\n";
    fgets(STDIN);
  }
  if ($res == 3) {
    echo "PROCESANDO PRESTAMO DEL LIBRO \n";
    $libro = $pila->sacar();
    $cliente = $cola->sacar();
    if ($libro == 'null') {
      echo "LO SENTIMOS, NO QUEDAN LIBROS PARA PRESTAR \n";
      echo "PRESIONE CUALQUIER TECLA PARA CONTINUAR ... ";
      $cola->poner($cliente);
      fgets(STDIN);
      continue;
    }
    if ($cliente == 'null') {
      echo "ADVERTENCIA NO SE PUEDE PROCESAR PEDIDO PORQUE NO EXISTEN CLIENTES EN ESPERA \n";
      echo "PRESIONE CUALQUIER TECLA PARA CONTINUAR ... ";
      $pila->meter($libro);
      fgets(STDIN);
      limpiarConsola();
      continue;
    }
    echo "EXITO!, SE APRESTADO $libro A $cliente \n";
    echo "PRESIONE CUALQUIER TECLA PARA CONTINUAR ... ";
    fgets(STDIN);
  }
  if ($res == 4) {
    echo "INGRESE EL NOMBRE DEL LIBRO A DEVOLVER \n";
    $ingresar = fgets(STDIN);
    $ingresar = ltrim($ingresar);
    $ingresar = rtrim($ingresar);
    $pila->meter($ingresar);
    echo "INGRESE SU NOMBRE \n";
    $nombre = fgets(STDIN);
    $nombre = ltrim($nombre);
    $nombre = rtrim($nombre);
    echo "LIBRO DEBUELTO EXITOSAMENTE, GRACIAS $nombre \n";
    echo "PRESIONE CUALQUIER TECLA PARA CONTINUAR ... ";
    fgets(STDIN);
  }
  if ($res == 5) {
    echo "CALCULANDO ALCANCE ... \n";
    $libros = $pila->mostrar_pila();
    $libros = ltrim($libros, ',');
    $libros = rtrim($libros, ',');
    $libros = explode(',', $libros);

    $clientes = $cola->mostar();
    $clientes = ltrim($clientes, ',');
    $clientes = rtrim($clientes, ',');
    $clientes = explode(',', $clientes);

    if (count($libros) >= count($clientes)) {
      echo "EXITEN SUFICIENTES LIBROS PARA TODOS LOS CLIENTES EN ESPERA ... \n";
      echo "PRESIONE CUALQUIER TECLA PARA CONTINUAR ... ";
      fgets(STDIN);
      limpiarConsola();
      continue;
    }
    echo "NO EXITEN SUFICIENTES LIBROS PARA TODOS LOS CLIENTES EN ESPERA ... \n";
    echo "PRESIONE CUALQUIER TECLA PARA CONTINUAR ... ";
    fgets(STDIN);
  }
  if ($res == 6) {
    echo "¿ESTAS SEGURO QUE QUIERES VOLTEAR LA PILA DE LIBROS? \n";
    echo " 'Y'   PARA CONTINUAR \n";
    echo " 'N'   PARA ABORTAR \n";
    $condicional = fgets(STDIN);
    if ($condicional == 'N' || $condicional == 'n') {
      limpiarConsola();
      continue;
    }

    $libros = [];
    $libro = $pila->sacar();

    while ($libro != 'null') {
      $libros[] = $libro;
      $libro = $pila->sacar();
    }

    foreach ($libros as $key => $book) {
      $pila->meter($book);
    }
    echo "PILA DE LIBROS VOLTEADA EXITOSAMENTE ... \n";
    echo "PRESIONE CUALQUIER TECLA PARA CONTINUAR ... ";
    fgets(STDIN);
  }
  if ($res == 7) {
    $memoria->mostrar();
    echo "\n PRESIONE CUALQUIER TECLA PARA CONTINUAR ... ";
    fgets(STDIN);
  }
  if ($res == 8) {
    echo $pila->mostrar_pila(). "\n";
    echo $cola->mostar(). "\n";
    echo "\n PRESIONE CUALQUIER TECLA PARA CONTINUAR ... ";
    fgets(STDIN);
  }

  limpiarConsola();
} while ($res != -1);
