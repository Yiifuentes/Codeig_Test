<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {

        /*if (!empty($_SESSION['adm_user'])) {
            redirect('admin/GestAdmin/home');
        } else {
            $data['msj'] = $this->input->get('msj');
            $this->template
                    ->set_layout('loginadmin')
                    ->build('loginadmin/login', $data);
        }*/
        echo "Hola";
    }

}
