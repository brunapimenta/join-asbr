<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

    public function index()
    {
        $this->load->view('landing');
    }

    public function lead()
    {
        try {

        } catch(Exception $e) {
            http_response_code($e->getCode());
        }
    }
}
