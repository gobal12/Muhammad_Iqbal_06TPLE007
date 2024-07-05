<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPengarang extends CI_Model{

    //fungsi untuk select data dari tabel di database
    function ambildata($tabel, $where){
        //where adalah array
        //jika $where tidak kosong, maka generate kode buat perintah where
        if (!empty($where)) $this->db->where($where);

        return $this->db->get($tabel);

    }

    //fungsi untuk delete
    function deletedata($tabel, $where){
        //where adalah array
        //jika $where tidak kosong, maka generate kode buat perintah where
        if (!empty($where)) $this->db->where($where);

        return $this->db->delete($tabel);

    }
    function tambahdata($tabel, $data){
        //where adalah array
        //jika $where tidak kosong, maka generate kode buat perintah where
        //if (!empty($where)) $this->db->where($where);
        return $this->db->insert($tabel, $data) ;

    }
    function ubahdata($tabel, $data, $where){
        //where adalah array
        //jika $where tidak kosong, maka generate kode buat perintah where
        if (!empty($where)) $this->db->where($where);
        return $this->db->update($tabel, $data) ;

    }
}