<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

class Buku extends REST_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->tabel = 'buku';
        $this->load->model('MBuku');   
    }

    function index_get(){
        $where = array();
        $res = $this->MBuku->ambildata($this->tabel, $where)->result();
        $this->response($res, 200);
    }
    function index_delete($id){
        //karyawanname adalah nama field
        $where = array('id_buku'=>$id);
        $res = $this->MBuku->ambildata($this->tabel, $where);

        if ($res->num_rows() !=0){
            $res = $this->MBuku->deletedata($this->tabel, $where);
            if($res)$this->response(array('status'=> 'data berhasil dihapus!'), 200);
            else $this->response(array('status'=> 'data gagal dihapus!!!'), 200);
        } else {
            $this->response(array('status'=> 'data tidak ditemukan'), 200);
        } 
    }

    function index_post()
    {
        $data = array(
            "id_buku"               => $this->post("id_buku"),
            "judul_buku"            => $this->post("judul_buku"),
            "id_pengarang"          => $this->post("id_pengarang"),
            "penerbit"              => $this->post("penerbit"),
            "tahun_terbit"          => $this->post("tahun_terbit"),
            "kategori_buku"         => $this->post("kategori_buku"),
            "no_isbn"               => $this->post("no_isbn")
        );
        //print_r($data); exit
        $res = $this->MBuku->tambahdata($this->tabel, $data);

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
            "id_buku"               => $this->put("id_buku"),
            "judul_buku"            => $this->put("judul_buku"),
            "id_pengarang"          => $this->put("id_pengarang"),
            "penerbit"              => $this->put("penerbit"),
            "tahun_terbit"          => $this->put("tahun_terbit"),
            "kategori_buku"         => $this->put("kategori_buku"),
            "no_isbn"               => $this->put("no_isbn")
        );
        //print_r($data); exit;

        $where = array ('id_buku'=> $this->put("id_buku"));
        //print_r($where); exit;
        $cek = $this->MBuku->ambildata($this->tabel, $where);

        if ($cek-> num_rows()!=0){
            $res = $this->MBuku->ubahdata($this->tabel, $data, $where);

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