<?php
require_once './app/controllers/apiController.php';

class accountsController extends ApiController {

    private function getData() {
        return json_decode($this->data);
    }

    public function getAll($params = null) {
        $accounts = $this->accountsModel->getAll();
        $this->view->response($accounts);
    }

    public function get($params = null) {
        $id = $params[':ID'];
        $account = $this->accountsModel->get($id);

        if ($account)
            $this->view->response($account);
        else 
            $this->view->response("The account with id=$id don't exists", 404);
    }

    public function delete($params = null) {

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("You don't logged in", 401);
            return;
        }
        
        $id = $params[':ID'];

        $account = $this->accountsModel->get($id);
        if ($account) {
            $this->accountsModel->delete($id);
            $this->view->response($account);
        } else 
            $this->view->response("The account with id=$id don't exists", 404);
    }

    public function create() {
        $account = $this->getData();

        if (empty($account->name) || empty($account->AKA) || empty($account->password)) {
            $this->view->response("Please fill the form", 400);
        } else {
            $id = $this->accountsModel->create($account->name, $account->AKA, $account->password, $account->genre_id, $account->country_id);
            $account = $this->accountsModel->get($id);
            $this->view->response($account, 201);
        }
    }

}