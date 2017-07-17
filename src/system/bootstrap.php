<?php
/**
 * Carregamento automatico das classes
 */
$autoload = ROOT_DIR . '/vendor/autoload.php';

if (!file_exists($autoload)) {
    echo "Você precisa instalar os componentes com o comando: <code>$ composer install</code>!";
    exit;
}

require_once $autoload;

use System\Core\PHPFunctions as PHP;
use System\Core\Session;

Session::start();

/**
 * Carrega o arquivo deconfigurações
 */
(new Symfony\Component\Dotenv\Dotenv())->load(ROOT_DIR.'/src/app/.env');

/**
 * Seta a configuração de caracteres
 */
PHP::mb_internal_encoding(PHP::getenv('CHARSET'));

/**
 * Seta o modelo padrão para datas
 */
PHP::date_default_timezone_set(PHP::getenv('TIMEZONE'));

/**
 * Configuração das sessões
 */
PHP::ini_set('session.cookie_httponly', 1);

/**
 * Configurações do ActiveRecordo PHP
 */
\ActiveRecord\Config::initialize(function($cfg) {
    $cfg->set_connections([
        'development' =>
            PHP::sprintf(
                'mysql://%s:%s@%s/%s?charset=utf8',
                PHP::getenv('DB_USER'),
                PHP::getenv('DB_PASS'),
                PHP::getenv('DB_HOST'),
                PHP::getenv('DB_NAME'))
            ]);
});

/**
 * Configuração para formato de datas para MySQL
 */
\ActiveRecord\Connection::$datetime_format = 'Y-m-d H:i:s';

/**
 * Rotas do sistema
 */
$router = new Gears\Router();
$router->routesPath = ROOT_DIR . '/src/app/Routers';
$router->exitOnComplete = true;

/**
 * Cria um cache da página de erro!
 */
PHP::ob_start();
    (new \App\Controllers\Error())->index(404);
    $error404 = PHP::ob_get_contents();
PHP::ob_end_clean();
$router->notFound = $error404;

$router->dispatch();