<?php
require_once './app/controllers/apiController.php';

class tracksController extends ApiController {

    private $user = [{
        "rol": 3;
    }];

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
        $tracks = $this->tracksModel->getAll($order, $desc);
        $profile = $this->authApiHelper->authToken();
        $user = $this->accountsModel->search($profile);

        $this->view->response($tracks);
        $this->tracksView->showTracks($tracks, $user);
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