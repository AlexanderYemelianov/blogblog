<?php

class CommentsController extends Controller {

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Comment();
    }

    public function add_comment(){
        $user_id = Session::get('user_id');
        $news_id =  Session::get('news_id');
        $comment = trim($_POST['comment']);
        if($user_id && $news_id && $comment) {
            $addComment = $this->model->addComment($user_id, $news_id, $comment);
            if ($addComment) {
                Session::setFlash('You comment have been saved. Thank you!');
                $path = Session::get('path');
                Router::redirect($path);
            }
        }else{
            Session::setFlash('Please login first.');
            Router::redirect('/users/login/');
            exit();
        }
    }
}
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 13.01.2016
 * Time: 20:51
 */