<?php

class ApiView {

    public function response($data, $status = 200) {
        header("Content-Type: application/json");
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
        
        // convierte los datos a un formato json
        echo json_encode($data);
    }

    private function _requestStatus($code){
        $status = array(
          200 => "OK",
          201 => "Created",
          400 => "Bad request",
          401 => "Unauthorized",
          403 => "Forbidden",
          404 => "Not found",
          500 => "Internal Server Error"
        );
        return (isset($status[$code])) ? $status[$code] : $status[500];
      }
  
}

require_once './libs/smarty-4.2.1/libs/Smarty.class.php';

class tracksView extends ApiView{
    private $smarty;

    public function __construct() {
        $this->smarty = new Smarty();
    }

    public function showTracks($tracks) {
      
        $this->smarty->assign('tracks', $tracks);    
        $this->smarty->display('tracks.tpl');
    }

    public function showTracksErr($genre) {   
        $this->smarty->assign('genre', $genre);    
        $this->smarty->display('tracksErr.tpl');
    }

    public function showUploadSection($genres) {
        $this->smarty->assign('genres', $genres);  
        $this->smarty->display('upload.tpl');
    }

    
}