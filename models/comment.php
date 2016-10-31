<?php


class Comment extends Model {
    /*Add comment*/

    public function addComment($user_id, $news_id, $comment){
        $user_id = $this->db->escape($user_id);
        $news_id = $this->db->escape($news_id);
        $comment = $this->db->escape($comment);

        if ($news_id && $user_id && $comment){
            $sql = "insert into `comments`(`news_id`, `user_id`, `comment`) values ('{$news_id}', '{$user_id}', '{$comment}');";
            $result = $this->db->query($sql);
            return $result;
        }
    }

    public function getComments($news_id){
        $sql = "SELECT `comments`.*, `users`.`login` FROM `comments` LEFT JOIN `users` ON `comments`.`user_id` = `users`.`id`  WHERE `comments`.`news_id` = '{$news_id}' ";
        $result = $this->db->query($sql);
        if ($result){
            return $result;
        } else {
            $result = 'There are no any comments yet. You will be the first.';
            return $result;
        }

    }
}