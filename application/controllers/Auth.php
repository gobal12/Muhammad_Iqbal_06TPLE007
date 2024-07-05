<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once VENDORPATH . 'autoload.php'; // memuat library Firebase JWT

use Firebase\JWT\JWT;

class Auth extends CI_Controller {

    public function index() {
        // Mengambil data POST dari form login
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Memeriksa apakah username dan password sudah diisi
        if (!$username || !$password) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['message' => 'Username and password are required.']));
            return;
        }

        // Memeriksa apakah username dan password valid
        if (!$this->validate_user($username, $password)) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode(['message' => 'Invalid username or password.']));
            return;
        }

        // Jika username dan password valid, buat token JWT
        $token = $this->create_token($username);

        // Mengembalikan token JWT sebagai response
        $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(['token' => $token]));
    }

    private function validate_user($username, $password) {
        // Lakukan validasi user di sini (contoh: periksa di database)

        // Jika username dan password valid, kembalikan nilai true
        return true;
    }

    private function create_token($username) {
        // Atur payload untuk token JWT
		$this->load->library('jwtlib');
        $payload = [
            'username' => $username,
            'iat' => time(),
            'exp' => time() + 60 * 60 // Token berlaku selama 1 jam
        ];

        // Generate token JWT menggunakan library Firebase JWT
        $jwt = JWT::encode($payload, 'SECRET_KEY');

        return $jwt;
    }

}