<?php
require_once './app/controllers/apiController.php';

class tracksController extends ApiController {

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
        if (isset($_GET["limit"])) {
            $limit = $_GET["limit"];
            $pagination = "LIMIT ".$limit;
            if (isset($_GET["page"]) && !empty($_GET["page"])) {
                $page = $_GET["page"];
                $pagination = $pagination." OFFSET ".(($page-1)*$limit);                
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
            // $this->tracksView->showTracks($tracks);
        } else {
            $this->view->response("Not found tracks :(", 404);
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
        
        $account = $this->authHelper->getAuth();

        if (!$account) {
            $this->view->response("Bad Request", 400);
            return;
        }

        $track = $this->tracksModel->get($id);

        if ($track->user_id==$account->id || ($account->rol==0 || $account->rol==1)) {
            if ($track) {            
                $this->tracksModel->delete($id);
                $this->view->response($track);
            } else 
                $this->view->response("The track with id= '$id' don't exists", 404);
        } else {
            $this->view->response("Don't authorized", 403);
            return;
        }        
    }

    public function upload() {

        $account = $this->authHelper->getAuth();

        if (!$account) {
            $this->view->response("You must be logged to post a file", 401);
            return;
        }

        $track = $this->getData();

        if (!isset($track->genre_id)) {
            $track->genre_id = 0;
        }

        if (empty($track->name)) {
            $this->view->response("Please set a name", 400);
        } else {
            $id = $this->tracksModel->upload($track->name, $account->id, $track->genre_id, $track->date);
            $track = $this->tracksModel->get($id);
            $this->view->response($track, 201);
        }
    }

}