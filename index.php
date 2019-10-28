<?php 

use App\MainService;
use App\MainDao;
use App\Config;

require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set("Asia/Taipei");
mb_internal_encoding('UTF-8');

$app = new \Slim\Slim();

$app->view()->set('app', $app);

$app->config(array(
    'debug' => true,
    'templates.path' => __DIR__ . '/templates'
));

$config = new Config();
$valueArray = $config->valueArray();
$app->config('valueArray',$valueArray);
 
$app->container->singleton('conn', function () use ($app) {

    $servername = $app->config('valueArray')['servername'];
    $username = $app->config('valueArray')['username'];
    $password = $app->config('valueArray')['password'];
    $dbname = $app->config('valueArray')['dbname'];
    try 
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;    
});

$app->container->singleton('MainService', function () use ($app) {
    $service = new MainService(new MainDao($app->conn));
    return $service;
});

$app->get('/', '\App\MainController:showHome')->name('ShowHome');
$app->post('/', '\App\MainController:homePost')->name('HomePost');

$app->run();