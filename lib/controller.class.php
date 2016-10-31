<?php

class Controller{

    protected $data;
    protected $model;
    protected $model2;
    protected $params;

    public function getParams()
    {
        return $this->params;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getModel2()
    {
        return $this->model2;
    }

    public function getData()
    {
        return $this->data;
    }

    public function __construct($data = array()) {
        $this->data = $data;
        $this->params = App::getRouter()->getParams();

    }
}
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 13.01.2016
 * Time: 20:45
 */ 