<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('konfigurasi_model');
	}
	//konfig umum
	public function index()
	{
		$konfigurasi 		= $this->konfigurasi_model->listing();
		$valid = $this->form_validation;
		$valid->set_rules('namaweb','Nama Website','required',
			array(	'required'		=>	'%s harus diisi'));


		if ($valid->run()===FALSE) {
		$data = array(	'title'			=> 'Konfigurasi Website',
						'konfigurasi'	=> $konfigurasi,
						'isi'			=> 'admin/konfigurasi/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 				= $this->input;
			$data = array(	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'namaweb' 			=> $i->post('namaweb'),
							'tagline' 			=> $i->post('tagline'),
							'email' 			=> $i->post('email'),
							'website' 			=> $i->post('website'),
							'keywords' 			=> $i->post('keywords'),
							'metatext' 			=> $i->post('metatext'),
							'deskripsi' 		=> $i->post('deskripsi')
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Konfigurasi telah diupdate');
			redirect(base_url('admin/konfigurasi'),'refresh');
		}
	}

	// konfig logo
	public function logo()
	{
		$konfigurasi 	= $this->konfigurasi_model->listing();
		$valid 			= $this->form_validation;
		$valid->set_rules('namaweb','Nama Website','required',
			array(	'required'		=>	'%s harus diisi'));

		if ($valid->run()) {
			if (!empty($_FILES['logo']['name'])) {

			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpeg|jpg|png';
			$config['max_size']  		= '10000';
			$config['max_width']  		= '3000';
			$config['max_height']  		= '3000';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('logo')){

		$data = array(	'title'			=> 'Konfigurasi Logo Website : '.$konfigurasi->namaweb,
						'konfigurasi'	=> $konfigurasi,
						'error'			=> $this->upload->display_errors(),
						'isi'			=> 'admin/konfigurasi/logo'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());
			// create thumbnail
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
			$config['new_image']		= './assets/upload/image/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250;
			$config['height']       	= 250;

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			// end

			$i = $this->input;

			$data = array(	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'namaweb'			=> $i->post('namaweb'),
							'logo'				=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Logo telah diupdate');
			redirect(base_url('admin/konfigurasi/logo'),'refresh');
		}}else{
			//hanya edit data tanpa gambar
			$i = $this->input;

			$data = array(	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'namaweb'			=> $i->post('namaweb'),
							//'logo'				=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Logo telah diupdate');
			redirect(base_url('admin/konfigurasi/logo'),'refresh');
		}}
		$data = array(	'title'			=> 'Konfigurasi Logo Website : '.$konfigurasi->namaweb,
						'konfigurasi'	=> $konfigurasi,
						'isi'			=> 'admin/konfigurasi/logo'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// konfig ikon
	public function icon()
	{
		$konfigurasi 	= $this->konfigurasi_model->listing();
		$valid 			= $this->form_validation;
		$valid->set_rules('namaweb','Nama Website','required',
			array(	'required'		=>	'%s harus diisi'));

		if ($valid->run()) {
			if (!empty($_FILES['icon']['name'])) {

			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpeg|jpg|png';
			$config['max_size']  		= '10000';
			$config['max_width']  		= '3000';
			$config['max_height']  		= '3000';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('icon')){

		$data = array(	'title'			=> 'Konfigurasi Icon Website : '.$konfigurasi->namaweb,
						'konfigurasi'	=> $konfigurasi,
						'error'			=> $this->upload->display_errors(),
						'isi'			=> 'admin/konfigurasi/icon'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());
			// create thumbnail
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
			$config['new_image']		= './assets/upload/image/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250;
			$config['height']       	= 250;

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			// end

			$i = $this->input;

			$data = array(	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'namaweb'			=> $i->post('namaweb'),
							'icon'				=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Icon telah diupdate');
			redirect(base_url('admin/konfigurasi/icon'),'refresh');
		}}else{
			//hanya edit data tanpa gambar
			$i = $this->input;

			$data = array(	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'namaweb'			=> $i->post('namaweb'),
							//'logo'				=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Icon telah diupdate');
			redirect(base_url('admin/konfigurasi/icon'),'refresh');
		}}
		$data = array(	'title'			=> 'Konfigurasi Icon Website : '.$konfigurasi->namaweb,
						'konfigurasi'	=> $konfigurasi,
						'isi'			=> 'admin/konfigurasi/icon'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
}

/* End of file Konfigurasi.php */
/* Location: ./application/controllers/admin/Konfigurasi.php */