<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class email extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');

		$this->load->view('welcome_message');
	}

    function sendMail()
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'programmer.train4best@gmail.com', // change it to yours
            'smtp_pass' => 'rcmrqkkznucpgxdr', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $message = 'second sending email from Codeiginter';
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('programmer.train4best@gmail.com'); // change it to yours
        $this->email->to('fajar86.unpam@gmail.com');// change it to yours
        $this->email->subject('Resume from JobsBuddy for your Job posting');
        $this->email->message($message);
        if($this->email->send()){
            echo 'Email sent.';
        }else{
            show_error($this->email->print_debugger());
        }
    }

}
