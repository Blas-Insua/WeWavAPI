<?php
require_once './app/controllers/apiController.php';

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

class authApiController extends apiController {

    private function getData() {
        return json_decode($this->data);
    }

    public function getToken($params = null) {
        // Obtener "Basic base64(user:pass)
        $basic = $this->authHelper->getAuthHeader();
        
        if(empty($basic)){
            $this->view->response("Don't authorized", 401);
            return;
        }
        $basic = explode(" ",$basic); // ["Basic" "base64(user:pass)"]
        if($basic[0]!="Basic"){
            $this->view->response('The authentication must be Basic', 401);
            return;
        }

        //validar usuario:contraseña
        $userpass = base64_decode($basic[1]); // user:pass
        $userpass = explode(":", $userpass);
        $user = $userpass[0];
        $pass = $userpass[1];

        $account = $this->accountsModel->search($user);

        if($account){
            if (password_verify($pass,($account->password))) {
                $header = array(
                    'alg' => 'HS256',
                    'typ' => 'JWT'
                );
                $payload = array(
                    'id' => $account->id,
                    'name' => $account->name,
                    'rol' => $account->rol_id,
                    'exp' => time()+(0 * 00 * 15 * 00)
                );
                $header = base64url_encode(json_encode($header));
                $payload = base64url_encode(json_encode($payload));
                $signature = hash_hmac('SHA256', "$header.$payload", "Clave1234", true);
                $signature = base64url_encode($signature);
                $token = "$header.$payload.$signature";
                 $this->view->response($token);
            } else {
                $this->view->response("The password is incorrect", 401);
            }
        }else{
            $this->view->response("The user '$user' don't exists", 401);
        }
    }
}
