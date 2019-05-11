<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->simple_login->cek_login();
	}
	// halaman utama dashboard
	public function index()
	{
		$data = array ( 'title'		=>	'Halaman Administrator',
						'isi'		=>	'admin/dasbor/list');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

}

/* End of file Dasbor.php */
/* Location: ./application/controllers/Dasbor.php */