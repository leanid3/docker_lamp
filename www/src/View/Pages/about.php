<?php

use Lamp\Leanid3\App\HomeController;

// Демонстрация использования контроллера
try {
    $controller = new HomeController();
    $controller->about();
    
} catch (Exception $e) {
    echo '<h2>Ошибка:</h2>';
    echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
} 