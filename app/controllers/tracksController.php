<?php
require_once './app/controllers/apiController.php';

class tracksController extends ApiController {

    

    private function getData() {
        return json_decode($this->data);
    }

    public function getAll($params = null) {  
        if (isset($_GET["order"])) {
            switch ($_GET["order"]) {
                case 'id':
                    $order = $_GET["order"]; 
                    break;
                case 'name':
                    $order = $_GET["order"]; 
                    break;
                case 'user_id':
                    $order = $_GET["order"]; 
                    break;
                case 'genre_id':
                    $order = $_GET["order"]; 
                    break;
                case 'date':
                    $order = $_GET["order"]; 
                    break;                
                default:
                    $this->view->response("The column '".$_GET['order']."' doesn't exists in the database or don't can use to order the items", 404);
                    die;
                    break;
            }                       
        } else {
            $order = "id";
        }
        if (isset($_GET["desc"])) {
            $desc = true;
        } else {
            $desc = false;
        }
        if (isset($_GET["limit"]) && (gettype($_GET["limit"])=="integer")) {
            $pagination = "LIMIT ".$_GET["limit"];
            if ((isset($_GET["page"])) && (gettype($_GET["page"])=="integer")) {
                $pagination = $pagination." OFFSET ".(($_GET["page"]-1)*$_GET["limit"]);
            }
        } else {
            $pagination = '';
        }
        if (isset($_GET["filter"])) {
            $filter = explode(":", $_GET["filter"]);
            $field = $filter[0];
            $req = $filter[1]."%";
        } else {
            $field = 1;
            $req = 1;
        }

        $tracks = $this->tracksModel->getAll($order, $desc, $pagination, $field, $req);

        if ($tracks!=null) {
            $this->view->response($tracks);
        } else {
            $this->view->response("Not founded :(", 404);
        }
    }

    public function get($params = null) {
        $id = $params[':ID'];
        $track = $this->tracksModel->get($id);

        if ($track)
            $this->view->response($track);
        else 
            $this->view->response("The track with id= '$id' don't exists", 404);
    }

    public function delete($params = null) { 
        $id = $params[':ID'];

        $track = $this->tracksModel->get($id);
        if ($track) {
            $this->tracksModel->delete($id);
            $this->view->response($track);
        } else 
            $this->view->response("The track with id= '$id' don't exists", 404);
    }

    public function upload() {

        $track = $this->getData();

        if (empty($track->name)) {
            $this->view->response("Please set a name", 400);
        } else {
            $id = $this->tracksModel->upload($track->name, 0, $track->genre_id, $track->date);
            $track = $this->tracksModel->get($id);
            $this->view->response($track, 201);
        }
    }

}