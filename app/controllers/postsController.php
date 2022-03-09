<?php
class Posts extends Controller{
    public function __construct(){
        $this->model = $this->model("Post");
    }

    public function index(){
        $this->get_all_posts();
    }

    public function get_all_posts(){
        if($_SERVER["REQUEST_METHOD"] === "GET"){
            $posts = $this->model->get_all();
            echo json_encode($posts);
        }
    }
}