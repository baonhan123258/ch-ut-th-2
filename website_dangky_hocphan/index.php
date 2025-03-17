<?php
session_start();

// Tự động load các controllers
spl_autoload_register(function($class_name) {
    $file = __DIR__ . '/controllers/' . $class_name . '.php';
    if (file_exists($file)) {
        require_once $file;
    } else {
        die("Controller '$class_name' không tồn tại.");
    }
});

// Xác định controller và action
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'sinhvien';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Kiểm tra file controller có tồn tại không
$controllerFile = __DIR__ . "/controllers/" . ucfirst($controller) . "Controller.php";
if (!file_exists($controllerFile)) {
    die("Lỗi: Controller '$controller' không tồn tại.");
}

// Gọi controller
require_once $controllerFile;
$controllerClass = ucfirst($controller) . "Controller";
$controllerInstance = new $controllerClass();

// Kiểm tra action có tồn tại không
if (!method_exists($controllerInstance, $action)) {
    die("Lỗi: Action '$action' không tồn tại trong controller '$controllerClass'.");
}

// Gọi phương thức tương ứng
$controllerInstance->$action();
?>
