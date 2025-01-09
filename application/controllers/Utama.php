<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utama extends CI_Controller {
	function __construct()
	{
		parent::__construct();
                $this->load->model('m_model');
        
	}
	
	public function index()
	{
		$data =array(

			'rs' => $this->m_model->data_rs(),
			
		);
		$this->load->view('utama',$data, FALSE);
	}
}
