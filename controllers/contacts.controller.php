<?php

class ContactsController extends Controller {

    public function __construct($data=array()){
        parent::__construct($data);
        $this->model = new Message();
    }

    public function index(){
        if($_POST){
            if ($this->model->save($_POST)) {
                Session::setFlash('Thank you! Your message was sent successfully!');
            }
        }
    }

    public function admin_index(){
        $this->data = $this->model->getList();
    }
}
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 17.01.2016
 * Time: 14:38
 */ 