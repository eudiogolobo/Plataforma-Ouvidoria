<?php

class Core 
{
    public function run($routes)
    {
        $url = '/';

        isset($_GET['url']) ? $url .= $_GET['url'] : '';

        ($url != '/') ? $url = rtrim($url, '/') : $url;

        $routerFound = false;

        //$value -> controller
        //$key -> /
        foreach ($routes as $key => $value) {
            $pattern = '#^'.preg_replace('/{id}/','(\w+)', $key).'$#';

            if(preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $routerFound = true;

                [$currentController, $action] = explode('@', $value);

                require_once __DIR__ ."/../controller/$currentController.php";

                $newController = new $currentController();
                $newController->$action($matches);
                //print_r($matches);
            }

        }

        if(!$routerFound) {
            require_once __DIR__ ."/../controller/NotFoundController.php";
            $controllerNotFound = new NotFoundController();
            $controllerNotFound->index();
        }
    }
}
?>