<?php
/**
 * Caminho da raiz do sistema
 */
define('ROOT_DIR', __DIR__);

/**
 * Configurações e inicializações do sistema
 */
require_once ROOT_DIR . '/src/System/bootstrap.php';

use Symfony\Component\Debug\Debug;

Debug::enable();