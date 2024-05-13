<?php

class Core 
{
    public function run($routes)
    {
        $url = '/';

        isset($_GET['url']) ? $url .= $_GET['url'] : '';

        //$value -> controller
        //$key -> /
        foreach ($routes as $key => $value) {
            $pattern = '#^'.preg_replace('/{id}/','(\w+)', $key).'$#';

            if(preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                [$currentController, $action] = explode('@', $value);

                require_once __DIR__ ."/../controller/$currentController.php";

                $newController = new $currentController();
                $newController->$action();
                //print_r($matches);
            }

        }
    }
}
?>