<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

class Pengarang extends REST_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->tabel = 'pengarang';
        $this->load->model('MPengarang');   
    }

    function index_get(){
        $where = array();
        $res = $this->MPengarang->ambildata($this->tabel, $where)->result();
        $this->response($res, 200);
    }
    function index_delete($id){
        //karyawanname adalah nama field
        $where = array('id_pengarang'=>$id);
        $res = $this->MPengarang->ambildata($this->tabel, $where);

        if ($res->num_rows() !=0){
            $res = $this->MPengarang->deletedata($this->tabel, $where);
            if($res)$this->response(array('status'=> 'data berhasil dihapus!'), 200);
            else $this->response(array('status'=> 'data gagal dihapus!!!'), 200);
        } else {
            $this->response(array('status'=> 'data tidak ditemukan'), 200);
        } 
    }

    function index_post()
    {
        $data = array(
            "id_pengarang"               => $this->post("id_pengarang"),
            "nama_pengarang"             => $this->post("nama_pengarang"),
            "no_telp"                    => $this->post("no_telp"),
            "email"                      => $this->post("email"),
            "alamat"                     => $this->post("alamat")
        );
        //print_r($data); exit
        $res = $this->MPengarang->tambahdata($this->tabel, $data);

        if ($res){
            $this->response(array(
                "status"=>true, 
                "mgs"   =>"Data Berhasil Ditambahkan", 
                "data"  => $data), 200);
        } else $this->response(array(
            "status"=>false,
            "msg"   => "Data gagal ditambahkan", 200));
    }

    //update data
    function index_put()
    {
        $data = array(
            "id_pengarang"               => $this->put("id_pengarang"),
            "nama_pengarang"             => $this->put("nama_pengarang"),
            "no_telp"                    => $this->put("no_telp"),
            "email"                      => $this->put("email"),
            "alamat"                     => $this->put("alamat")
        );
        //print_r($data); exit;

        $where = array ('id_pengarang'=> $this->put("id_pengarang"));
        //print_r($where); exit;
        $cek = $this->MPengarang->ambildata($this->tabel, $where);

        if ($cek-> num_rows()!=0){
            $res = $this->MPengarang->ubahdata($this->tabel, $data, $where);

            if ($res){
                $this->response(array(
                    "status"=>true, 
                    "mgs"   =>"Data Berhasil Diubah", 
                    "data"  => $data), 200);
            } else $this->response(array(
                "status"=>false,
                "msg"   => "Data gagal diubah", 200));
            } else {
                $this->response(array(
                    "status" => false,
                    "msg"    => "Data tidak ditemukan"
                ), 200);
            }
        
    }
    
}