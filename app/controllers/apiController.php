<?php
require_once './app/models/tracksModel.php';
require_once './app/models/accountsModel.php';
require_once './app/helpers/authApiHelper.php';
require_once './app/views/api.view.php';

class ApiController {
    public $tracksModel;
    public $accountsModel;
    public $authHelper;
    public $view;

    public $data;

    public function __construct() {
        $this->tracksModel = new tracksModel();
        $this->accountsModel = new accountsModel();
        $this->authHelper = new authApiHelper();
        $this->view = new ApiView();
        $this->tracksView = new tracksView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}

