<?php

namespace Lamp\Leanid3\App;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class HomeController
{
    private Logger $logger;
    
    public function __construct()
    {
        $this->logger = new Logger('home_controller');
        $this->logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));
    }
    
    public function index(): void
    {
        $this->logger->info('HomeController::index() вызван');
        
        echo '<h1>HomeController работает!</h1>';
        echo '<p>Это демонстрация работы автозагрузки классов.</p>';
        echo '<p>Пространство имен: ' . __NAMESPACE__ . '</p>';
        echo '<p>Класс: ' . __CLASS__ . '</p>';
    }
    
    public function about(): void
    {
        $this->logger->info('HomeController::about() вызван');
        
        echo '<h1>О приложении</h1>';
        echo '<p>Это простое LAMP приложение с автозагрузкой классов.</p>';
    }
} 