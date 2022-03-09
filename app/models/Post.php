<?php
class Post extends Model{
    public function __construct()
    {
        parent::__construct();
        $this->table = "post";
        $this->primaryKey = "id";
    }

    public function get_all(){
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
                p.categorie_id = c.id");
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
        echo "<pre>";
        var_dump(($posts));
    }
}