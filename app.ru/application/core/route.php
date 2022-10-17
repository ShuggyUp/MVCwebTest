<?
require_once __DIR__ . '/../controllers/Controller404.php';

class MyAppException extends Exception {

    public function getMoreInfo() {
        $message = $this->getFile();
        return 'File: ' . $message;
    }
}

class RoutingExceptions extends MyAppException {

    public function __construct($message) {
        parent::__construct($message);
    }

    public function __toString() {
        return 'RouterException' . ": $this->message";
    }
}

class Route {

    static function start() {
        try {
            $controllerName = 'NewsList';
            $actionName = 'Index';

            $routes = explode('/', preg_replace('#\?(?:.+?)$#', '', $_SERVER['REQUEST_URI']));

            // получаем имя контроллера
            if ( !empty($routes[1]) ) {
                $controllerName = $routes[1];
            }

            // получаем имя экшена
            if ( !empty($routes[2]) ) {
                $actionName = $routes[2];
            }

            // добавляем префиксы
            $modelName = 'Model'.$controllerName;
            $controllerName = 'Controller'.$controllerName;
            $actionName = 'action'.$actionName;

            $modelFile = $modelName.'.php';
            $modelPath = __DIR__ . "/../models/" .$modelFile;
            if(file_exists($modelPath)) {
                include __DIR__ . "/../models/" .$modelFile;
            }

            $controllerFile = $controllerName.'.php';
            $controllerPath = __DIR__ . "/../controllers/" .$controllerFile;
            if(file_exists($controllerPath)) {
                include __DIR__ . "/../controllers/" .$controllerFile;
            } else {
                throw new RoutingExceptions("Controller not found ($controllerName)!");
            }

            $controller = new $controllerName;
            $action = $actionName;
            if(method_exists($controller, $action)) {
                $controller->$action();
            }
            else {
                throw new RoutingExceptions("Action not found ($actionName)!");
            }
        }
        catch (RoutingExceptions $e) {
            Route::ErrorPage404($e);
        }
}

    static function ErrorPage404($e) {
        $controller = new Controller404;
        $controller->actionIndex($e);
    }
}
