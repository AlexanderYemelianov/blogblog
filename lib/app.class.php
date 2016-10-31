<?php

class App{

    protected static $router;
    public static $db;

    public static function getRouter()
    {
        return self::$router;
    }

    public static function run($uri) {
        self::$router = new Router($uri);

        self::$db = new DB(Config::get('db.host'),Config::get('db.user'), Config::get('db.password'), Config::get('db.db_name'));
/*        self::$db = new DB(Config::get('db.host'),Config::get('db.user'), Config::get('db.password'));*/

        self::$db->query('SET NAMES utf8;');

        Lang::load(self::$router->getLanguage());

        $controller_class = ucfirst(self::$router->getController()) . 'Controller';
        $controller_method = strtolower(self::$router->getMethodPrefix() . self::$router->getAction());

        $layout = self::$router->getRoute();
        if($layout == 'admin' && Session::get('role') != 'admin'){
            if($controller_method != 'admin_login'){
                Router::redirect('/users/login');
            }
        }

        $controller_object = new $controller_class();
        if ($controller_method == 'add_comment') {
            $controller_class = New $controller_class;
            $add_comment = $controller_class->$controller_method();
            return $add_comment;
        } elseif(method_exists($controller_object, $controller_method)) {
            $view_path = $controller_object->$controller_method();
            $view_object = new View($controller_object->getData(), $view_path);
            $content = $view_object->render();
        } else {
            throw new Exception('Method ' . $controller_method . ' of class ' . $controller_class . ' does not exist.');
        }

/*      Original code
        if (method_exists($controller_object, $controller_method)) {
            $view_path = $controller_object->$controller_method();
            $view_object = new View($controller_object->getData(), $view_path);
            $content = $view_object->render();
        } else {
            throw new Exception('Method ' . $controller_method . ' of class ' . $controller_class . ' does not exist.');
        }*/

        $layout_path = VIEWS_PATH.DS.$layout.'.html';
        $layout_view_object = new View(compact('content'), $layout_path);
        echo $layout_view_object->render();
    }
}
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 13.01.2016
 * Time: 20:41
 */ 