<?php
class Posts extends Controller{
    public function __construct(){
        $this->model = $this->model("Post");
    }

    public function index(){
        $this->get_all_posts();
    }

    public function get_all_posts(){
        $posts = $this->model->get_all();
        
    }
}