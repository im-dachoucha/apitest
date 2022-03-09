<?php
class Posts extends Controller{
    public function __construct(){
        $this->model = $this->model("Post");
    }

    public function index($id = null){
        $this->get_all_posts($id);
    }

    public function get_all_posts($id){
        if($_SERVER["REQUEST_METHOD"] === "GET"){
            $posts = $this->model->get_all($id);
            echo json_encode($posts);
        }
    }

    public function details($id = null){
        if($_SERVER["REQUEST_METHOD"] === "GET"){
            $post = $this->model->get_single($id);
            echo json_encode($post);
        }
    }
}