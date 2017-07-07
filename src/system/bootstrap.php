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

/**
 * Carrega o arquivo deconfigurações
 */
(new Symfony\Component\Dotenv\Dotenv())->load(ROOT_DIR.'/src/app/.env');

/**
 * Seta a configuração de caracteres
 */
mb_internal_encoding(getenv('CHARSET'));

/**
 * Seta o modelo padrão para datas
 */
date_default_timezone_set(getenv('TIMEZONE'));

/**
 * Configuração das sessões
 */
ini_set('session.cookie_httponly', 1);
session_cache_expire(getenv('SESSION_EXPIRE'));
session_name(md5(getenv('SECURITY_KEY').$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']));

/**
 * Configurações do ActiveRecordo PHP
 */
\ActiveRecord\Config::initialize(function($cfg) {
    $cfg->set_connections(array('development' =>
                                sprintf('mysql://%s:%s@%s/%s?charset=utf8', getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_HOST'), getenv('DB_NAME'))));
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
ob_start();
    (new \App\Controllers\Error())->index(404);
    $error404 = ob_get_contents();
ob_end_clean();
$router->notFound = $error404;

$router->dispatch();