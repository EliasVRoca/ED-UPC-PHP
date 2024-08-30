<?php
function limpiarConsola()
{
  // Detectar el sistema operativo
  if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
    // Para Windows, puedes intentar esta secuencia de escape o usar `cls`
    echo chr(27) . "[2J" . chr(27) . "[;H";
  } else {
    // Para Linux, macOS, y otros sistemas UNIX-like
    echo "\033[2J\033[H";
  }
}