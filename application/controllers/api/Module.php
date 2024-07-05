<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Module extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this->tabel = "m_module";
        $this->load->helper('Utility');
        $this->load->model('Myquery', 'Mqry');
		$this->API="https://pinter-ngoding.my.id/monitoring/api/";
    }

    function index_get(){
        $where = array();
        $res = $this->Mqry->ambildata($this->tabel, $where);
        //var_dump($res);exit;
        $this->response($res->result(), 200);
    }
	
	function data_get($mac){
        $where = array('macaddress' => $mac);
		$order = '';
        $select = array('red', 'yellow', 'green', 'relay1', 'relay2');
        $res = $this->Mqry->selectdata($this->tabel, $where, $select, '', $order);
        
		$jout = "";
		foreach ($res->result() as $row){
			$jout = '{"red":' . $row->red . ', "yellow":'. $row->yellow . ', "green":'. $row->green . ', "relay1":'. $row->relay1 . ', "relay2":'. $row->relay2.'}';
		}
		
		$jout = json_decode($jout);
		
		 $this->output
		  ->set_status_header(200)
		  ->set_content_type('application/json', 'utf-8')
		  ->set_output(json_encode($jout, JSON_PRETTY_PRINT))
		  ->_display();
		  exit;

        //$this->response($outputJson, 200);
    }
	
	function dataapi_get($mac){
        $fungsi = "curl";
		$url = $this->API.'module/data/'.$mac;
		echo $url;//exit;
		$data = ($fungsi == "curl") ? json_decode($this->curl->simple_get($url)) : json_decode(file_get_contents($url));
		
		echo $this->curl->simple_get($url);exit;
		//echo file_get_contents($url);exit;
		
		if (!empty($data)) $this->response($data);
        else $this->response(array("data" => "data API Not Found"));
    }
	
	function status_get($mac){
        $where = array('macaddress' => $mac);
		$order = '';
        $select = array('red', 'yellow', 'green', 'relay1', 'relay2');
        $res = $this->Mqry->selectdata($this->tabel, $where, $select, '', $order);
        
		$this->response($res->result(), 200);
    }
	
	function dht_get($mac){
        $where = array('macaddress' => $mac);
		$order = 'id DESC';
        $select = array('temp');
        $temp = $this->Mqry->selectdata('sensorlog', $where, array('temp'), '20', $order);
        $hum = $this->Mqry->selectdata('sensorlog', $where, array('hum'), '20', $order);
        $ldr = $this->Mqry->selectdata('sensorlog', $where, array('ldr'), '20', $order);
        
		$aa = getarray($temp, 'temp', 'temperature');
		$ab = getarray($hum, 'hum', 'humidity');
		$ld = getarray($ldr, 'ldr', 'LDR');
		
		$aout = array($aa, $ab);
		
		$timelog = $this->Mqry->selectdata('sensorlog', $where, array("DATE_FORMAT(timelog,'%Y-%m-%dT%H:%i:%s.000Z') as timelog, DATE_FORMAT(timelog,'%H:%i:%s') as times"), '20', $order);
		//$timelog = $this->Mqry->selectdata('sensorlog', $where, array("DATE_FORMAT(timelog,'%H:%i:%s') as timelog"), '20', $order);
		//$timelog = $this->Mqry->selectdata('sensorlog', $where, array("timelog"), '20', $order);
		
		$dt = array();
		$tm = array();
		foreach ($timelog->result() as $row){
			$dt[] = $row->timelog;
			$tm[] = $row->times;
		}
		
		$temp = $this->Mqry->selectdata('sensorlog', $where, array('temp'), '1', $order);
        $hum = $this->Mqry->selectdata('sensorlog', $where, array('hum'), '1', $order);
		$timelog = $this->Mqry->selectdata('sensorlog', $where, array("DATE_FORMAT(timelog,'%Y-%m-%d %H:%i:%s') as timelog, DATE_FORMAT(timelog,'%H:%i:%s') as times"), '1', 'timeLog DESC');
		
		$sel = array('red', 'yellow', 'green', 'relay1', 'relay2');
        $mod = $this->Mqry->selectdata($this->tabel, $where, $sel, '', '');
		$out = array(
			"serries" => $aout, 
			"timelog" => $dt, 
			"time" => $tm, 
			"ldrserries" => array($ld),
			"last_temp" => $temp->result(),
			"last_hum" => $hum->result(), 
			"last_timelog" => $timelog->result(), 
			"module" => $mod->result()
			
		);
		/* $this->output
		  ->set_status_header(200)
		  ->set_content_type('application/json', 'utf-8')
		  ->set_output(json)
		  ->_display();
		  exit; */
        
		$this->response($out, 200);
    }
	
	function timelog_get($mac){
        $where = array('macaddress' => $mac);
		$order = 'id DESC';
        $timelog = $this->Mqry->selectdata('sensorlog', $where, array("DATE_FORMAT(timelog,'%H:%i:%s') as timelog"), '20', $order);
		
		$dt = array();
		foreach ($timelog->result() as $row){
			$dt[] = $row->timelog;
		}
		
		$this->response($dt, 200);
    }
	
	
	function ubah_get($mac){
        $data = array($this->get("p")  => $this->get("val"));

        $where = array('macaddress' => $mac);
        $cek = $this->Mqry->ambildata($this->tabel, $where);
        if($cek->num_rows() != 0){
            $res = $this->Mqry->ubahdata($this->tabel, $data, $where);
            if($res)
                $this->response(array(
                    'status'        => true, 
                    'msg'           => "data berhasil diubah", 
                    "update"  => $data)
                , 200);
            else
                $this->response(array('status' => false, 'msg' => "data gagal diubah"), 200);
        }else
            $this->response(array('status' => false, 'msg' => "data tidak ditemukan"), 200);
        
    }
	
	function sensor_get(){
        $data = array(
			'macaddress'  => $this->get("mac"),
			'temp'  => $this->get("t"),
			'hum'  => $this->get("h"),
			'ldr'  => $this->get("ldr")
		);

        $res = $this->Mqry->tambahdata('sensorlog', $data);
        if($res)
            $this->response(array(
                'status' => true, 
                'msg' => "data berhasil ditambah", 
                "data" => $data), 200);
        else 
            $this->response(array('status' => false, 'msg' => "data gagal ditambah"), 200);
        
    }

    function index_post(){
        $data = array($this->post("field")  => $this->post("val"));

        $where = array('macaddress' => $this->post("mac"));
        $cek = $this->Mqry->ambildata($this->tabel, $where);
        if($cek->num_rows() != 0){
            $res = $this->Mqry->ubahdata($this->tabel, $data, $where);
            if($res)
                $this->response(array(
                    'status'        => true, 
                    'msg'           => "data berhasil diubah", 
                    "before_update" => $cek->result(),
                    "after_update"  => $data)
                , 200);
            else
                $this->response(array('status' => false, 'msg' => "data gagal diubah"), 200);
        }else
            $this->response(array('status' => false, 'msg' => "data tidak ditemukan"), 200);
        
    }

    function index_put(){
        $data = array($this->put("field")  => $this->put("val"));

        $where = array('macaddress' => $this->put("mac"));
        $cek = $this->Mqry->ambildata($this->tabel, $where);
        if($cek->num_rows() != 0){
            $res = $this->Mqry->ubahdata($this->tabel, $data, $where);
            if($res)
                $this->response(array(
                    'status'        => true, 
                    'msg'           => "data berhasil diubah", 
                    "before_update" => $cek->result(),
                    "after_update"  => $data)
                , 200);
            else
                $this->response(array('status' => false, 'msg' => "data gagal diubah"), 200);
        }else
            $this->response(array('status' => false, 'msg' => "data tidak ditemukan"), 200);
        

        
        
    }

}
