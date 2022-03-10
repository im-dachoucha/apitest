<?php
class Post extends Model{
    public function __construct()
    {
        parent::__construct();
        $this->table = "post";
        $this->primaryKey = "id";
    }

    public function get_all($id){
        $results = $this->execute(
            "SELECT
                c.id as category_id,
                c.name as category_name,
                p.id,
                p.title,
                p.body,
                p.author,
                p.created_at
            FROM
                `{$this->table}` p
            join
                categorie c
            on
                p.categorie_id = c.id
            order by
                p.created_at desc " . ($id ? "limit {$id} " : " "));
        $posts = array();
        $posts["data"] = array();
        foreach($results as $data){
            $post_item = array(
                "id" => $data["id"],
                "title" => $data["title"],
                "body" => $data["body"],
                "author" => $data["author"],
                "created_at" => $data["created_at"],
                "category_id" => $data["category_id"],
                "category_name" => $data["category_name"],
            );
            array_push($posts["data"], $post_item);
        }
        return $posts;
    }

    public function get_single($id){
        // var_dump($id);
        $post = array();
        $post["data"] = array();
        if($id !== null){
            $results = $this->execute(
                "SELECT
                    c.id as category_id,
                    c.name as category_name,
                    p.id,
                    p.title,
                    p.body,
                    p.author,
                    p.created_at
                FROM
                    `{$this->table}` p
                join
                    categorie c
                on
                    p.categorie_id = c.id where p.{$this->primaryKey} = ?", [$id]);
            foreach($results as $data){
                $post_item = array(
                    "id" => $data["id"],
                    "title" => $data["title"],
                    "body" => $data["body"],
                    "author" => $data["author"],
                    "created_at" => $data["created_at"],
                    "category_id" => $data["category_id"],
                    "category_name" => $data["category_name"],
                );
                array_push($post["data"], $post_item);
            }
        }else{
            $post["message"] = "must provide an id!!!";
        }
        return $post;
    }
    public function add($values){
        $this->execute("INSERT into `{$this->table}`(`title`, `body`, `author`, `categorie_id`) values (?, ?, ?, ?)", $values);
        return ["message" => "Post Created"];
    }
    public function delete($id){
        $this->execute("DELETE from `{$this->table}` where `{$this->primaryKey}` = ?", [$id]);
        return ["message" => "Post deleted"];
    }
}