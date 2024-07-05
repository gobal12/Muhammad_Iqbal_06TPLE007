<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Firebase\JWT\JWT;
require APPPATH . '/libraries/REST_Controller.php';

class Login extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model("SiswaModel");
		//$this->load->library('firebase/jwt');
        $this->load->library('jwtlib');
		get_instance()->load->library('jwtlib');
    }

    public function index_post()
    {
		// Ambil data dari request
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Cek apakah username dan password benar
        if ($username == 'admin' && $password == '1234') {
            // Generate token JWT
            $payload = array(
                'sub' => '1234567890',
                'name' => 'John Doe',
                'iat' => time(),
                'exp' => time() + 3600
            );
            $key = "Train4Best#1";
            $jwt = JWT::encode($payload, $key);

            // Tampilkan token sebagai response
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array('token' => $jwt)));
        } else {
            // Tampilkan pesan error jika login gagal
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode(array('message' => 'Invalid username or password')));
        }
	}
	
	

}
