<?php
use Symfony\Component\Dotenv\Dotenv;

require __DIR__.'/../vendor/autoload.php';

$envFile = dirname(__DIR__) . '/test.env';
if(!file_exists($envFile)){
    throw new \Exception("test.env file not found in project root.");
}
(new Dotenv())->load($envFile);

if(!$_ENV['API_KEY']){
    throw new \Exception("api key not set in test.env");
}