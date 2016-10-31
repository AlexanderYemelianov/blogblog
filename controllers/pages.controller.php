<?php

class PagesController extends Controller {

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Page();
        $this->model2 = new Comment();
    }

    public function index(){
        $this->data['preview'] = $this->model->getPreview();
        $this->data['pages'] = $this->model->getList();
    }

    public function view() {
        $params = App::getRouter()->getParams();

        if (isset($params[0])){
            $alias = strtolower($params[0]);
            $this->data['page'] = $this->model->getByAlias($alias);
            $news_id = $this->data['page'][0]['id'];
            Session::set('news_id', $news_id);
            $this->data['comments'] = $this->model2->getComments($news_id);
        }
    }

    public function admin_index() {
        $this->data['pages'] = $this->model->getList();
    }

    public function admin_edit() {
        if(isset($this->params[0])){
            $this->data['page'] = $this->model->getById($this->params[0]);
        } else {
            Session::setFlash('Wrong page id');
            Router::redirect('/admin/pages/');
        }

        if($_POST){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->model->save($_POST, $id);
            if($result){
                Session::setFlash('News have been saved.');
            } else {
                Session::setFlash('Error.');
            }
            Router::redirect('/admin/pages/');
        }
    }

    public function admin_add() {
        if($_POST){
            $result = $this->model->save($_POST);
            if($result){
                Session::setFlash('News was saved.');
            } else {
                Session::setFlash('Error.');
            }
            Router::redirect('/admin/pages/');
        }
    }
}
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 13.01.2016
 * Time: 20:51
 */ 