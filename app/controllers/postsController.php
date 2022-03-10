<?php
class Posts extends Controller
{
    public function __construct()
    {
        $this->model = $this->model("Post");
    }

    public function index($id = null)
    {
        $this->get_all_posts($id);
    }

    public function get_all_posts($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            include APPROOT . "/libraries/getheaders.php";
            $posts = $this->model->get_all($id);
            echo json_encode($posts);
        }
    }

    public function details($id = null)
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            include APPROOT . "/libraries/getheaders.php";
            $post = $this->model->get_single($id);
            echo json_encode($post);
        }
    }

    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            include APPROOT . "/libraries/postheaders.php";
            $data = (array) json_decode(file_get_contents("php://input"));
            extract($data);
            $values = [$title, $body, $author, $category_id];
            $response = $this->model->add($values);
            echo json_encode($response);
        }
    }
    public function delete($id = null)
    {
        header("Access-Control-Allow-Orign: *");
        header("Access-Control-Allow-Methods: DELETE");
        header("Content-type: application/json");
        header("Content-Control-Allow-Headers: Content-Control-Allow-Headers, Access-Control-Allow-Methods, Content-type, Authorization, X-Requested-With");
        if (!$id) {
            echo json_encode(["message" => "must provide an id!!!"]);
            return;
        }
        if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
            $response = $this->model->delete($id);
            echo json_encode($response);
        }
    }

    public function update(){
        if($_SERVER["REQUEST_METHOD"] === "PUT"){
            $data = (array) json_decode(file_get_contents("php://input"));
            extract($data);
            $values = [$title, $body, $author, $category_id, $id];
            $response = $this->model->update($values);
            echo json_encode($response);
        }
    }
}
