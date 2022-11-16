<?php
require_once './app/controllers/apiController.php';

class accountsController extends ApiController {

    public function getAll($params = null) {
        if (isset($_GET["order"])) {
            switch ($_GET["order"]) {
                case 'id':
                    $order = $_GET["order"]; 
                    break;
                case 'name':
                    $order = $_GET["order"]; 
                    break;
                case 'AKA':
                    $order = $_GET["order"]; 
                    break;
                case 'genre_id':
                    $order = $_GET["order"]; 
                    break;
                case 'country_id':
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
            if (isset($_GET["page"])) {
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

        $accounts = $this->accountsModel->getAll($order, $desc, $pagination, $field, $req);
        $this->view->response($accounts);
    }

    public function get($params = null) {
        $id = $params[':ID'];
        $account = $this->accountsModel->get($id);

        if ($account)
            $this->view->response($account);
        else 
            $this->view->response("The account with id '$id' don't exists", 404);
    }

    public function delete($params = null) {

        $id = $params[':ID'];

        $account = $this->authHelper->getAuth();

        $user = $this->accountsModel->get($id);

        if ($account) {
            if ($account->id == $id || ($account->rol==0 || $account->rol==1)) {
                $this->accountsModel->delete($id);
                $this->view->response($user);
            } else {
                $this->view->response("Don't authorized", 403);
                return;
            }
        } else {
            $this->view->response("The account with id '$id' don't exists", 404);
        }

    }

    public function create() {
    
        $account = $this->getData();

        if (isset($account->name)) {
            $user = $this->accountsModel->search($account->name);
            if ($user) {
                $this->view->response("This user name name is already taken", 400);
                return;
            } else {
                $name = $account->name;
            }
        } else {
            $this->view->response("Please set a name", 400);
        }

        if (isset($account->AKA)) {
            $user = $this->accountsModel->search($account->AKA);
            if ($user) {
                $this->view->response("This user AKA is already taken", 400);
                return;
            } else {
                $AKA = $account->AKA;
            }
        } else {
            $this->view->response("Please set a AKA", 400);
        }

        if (isset($account->password)) {
            $password = password_hash($account->password, PASSWORD_BCRYPT); 
        } else {
            $this->view->response("Please set a password", 400);
            return;
        }

        if (!isset($account->genre_id)) {
            $genre_id = 0; 
        }

        if (!isset($account->country_id)) {
            $country_id = 0; 
        }

        $id = $this->accountsModel->create($name, $AKA, $password, $genre_id, $country_id);
        $account = $this->accountsModel->get($id);
        $this->view->response($account, 201);
    }

}