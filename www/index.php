<?php

// Подключаем автозагрузчик Composer
require_once __DIR__ . '/vendor/autoload.php';

// Включаем отображение ошибок для разработки
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Получаем URI запроса
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Убираем query string из URI
$path = parse_url($requestUri, PHP_URL_PATH);

// Убираем trailing slash
$path = rtrim($path, '/');

// Если путь пустой, устанавливаем корневой путь
if (empty($path)) {
    $path = '/';
}

// Определяем путь к файлу в src/App/View/Pages
$appPath = __DIR__ . '/src/View/Pages';

// Создаем путь к файлу обработчика
if ($path === '/') {
    $handlerFile = $appPath . '/main.php';
} else {
    // Убираем начальный слеш и создаем путь к файлу
    $relativePath = ltrim($path, '/');
    $handlerFile = $appPath . '/' . $relativePath . '.php';
}

// Проверяем существование файла обработчика
if (file_exists($handlerFile)) {
    // Подключаем файл обработчика
    require_once $handlerFile;
} else {
    // Если файл не найден, возвращаем 404
    http_response_code(404);
    echo '<h1>404 - Страница не найдена</h1>';
    echo '<p>Запрошенный путь: ' . htmlspecialchars($path) . '</p>';
}

