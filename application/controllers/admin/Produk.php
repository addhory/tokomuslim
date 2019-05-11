<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	//Load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
		$this->load->model('kategori_model');
		$this->load->library('image_lib');
		$this->simple_login->cek_login();
	}

	//data produk
	public function index()
	{
		$produk = $this->produk_model->listing();
		$data = array(	'title'		=> 'Data Produk',
						'produk'	=> $produk,
						'isi'		=> 'admin/produk/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function gambar($id_produk)
	{
		$produk = $this->produk_model->detail($id_produk);
		$gambar = $this->produk_model->gambar($id_produk);

		$valid = $this->form_validation;
		$valid->set_rules('judul_gambar','Judul/Nama Gambar','required',
			array(	'required'		=>	'%s harus diisi'));


		if ($valid->run()) {

			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpeg|jpg|png';
			$config['max_size']  		= '10000';
			$config['max_width']  		= '3000';
			$config['max_height']  		= '3000';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('gambar')){

		$data = array(	'title'		=> 'Tambah Gambar Produk: '.$produk->nama_produk,
						'produk'	=> $produk,
						'gambar'	=> $gambar,
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/produk/gambar'
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
			echo $this->image_lib->display_errors();

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			// end


			$i = $this->input;
			$data = array(	'id_produk'		=> $id_produk,
							'judul_gambar' 	=> $i->post('judul_gambar'),
							'gambar'		=> $upload_gambar['upload_data']['file_name'],
						);
			$this->produk_model->tambah_gambar($data);
			$this->session->set_flashdata('sukses', 'Gambar telah ditambah');
			redirect(base_url('admin/produk/gambar/'.$id_produk),'refresh');
		}}
		$data = array(	'title'		=> 'Tambah Gambar Produk: '.$produk->nama_produk,
						'produk'	=> $produk,
						'gambar'	=> $gambar,
						'isi'		=> 'admin/produk/gambar'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function tambah()
	{
		$kategori = $this->kategori_model->listing();
		$valid = $this->form_validation;
		$valid->set_rules('nama_produk','Nama Produk','required',
			array(	'required'		=>	'%s harus diisi'));

		$valid->set_rules('kode_produk','Kode Produk','required|is_unique[produk.kode_produk]',
			array(	'required'		=>	'%s harus diisi',
					'is_unique'		=>	'%s sudah ada, silahkan buat kode produk baru'));

		if ($valid->run()) {

			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpeg|jpg|png';
			$config['max_size']  		= '10000';
			$config['max_width']  		= '3000';
			$config['max_height']  		= '3000';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('gambar')){

		$data = array(	'title'		=> 'Tambah Produk',
						'kategori'	=> $kategori,
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/produk/tambah'
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
			echo $this->image_lib->display_errors();

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			// end


			$i = $this->input;
			$slug_produk = url_title($this->input->post('nama_produk').'-'.$this->input->post('kode_produk'), 'dash', TRUE);
			$data = array(	'id_user'		=> $this->session->userdata('id_user'),
							'id_kategori'	=> $i->post('id_kategori'),
							'kode_produk' 	=> $i->post('kode_produk'),
							'nama_produk' 	=> $i->post('nama_produk'),
							'slug_produk'	=> $slug_produk,
							'keterangan' 	=> $i->post('keterangan'),
							'keywords'		=> $i->post('keywords'),
							'harga'		 	=> $i->post('harga_produk'),
							'gambar'		=> $upload_gambar['upload_data']['file_name'],
							'tanggal_post'	=> date('Y-m-d H:i:s')
						);
			$this->produk_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambah');
			redirect(base_url('admin/produk'),'refresh');
		}}
		$data = array(	'title'		=> 'Tambah Produk',
						'kategori'	=> $kategori,
						'isi'		=> 'admin/produk/tambah'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function edit($id_produk)
	{
		$produk 	= $this->produk_model->detail($id_produk);
		$kategori 	= $this->kategori_model->listing();

		$valid 		= $this->form_validation;
		$valid->set_rules('nama_produk','Nama Produk','required',
			array(	'required'		=>	'%s harus diisi'));

		$valid->set_rules('kode_produk','Kode Produk','required',
			array(	'required'		=>	'%s harus diisi'));

		if ($valid->run()) {
			if (!empty($_FILES['gambar']['name'])) {

			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpeg|jpg|png';
			$config['max_size']  		= '10000';
			$config['max_width']  		= '3000';
			$config['max_height']  		= '3000';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('gambar')){

		$data = array(	'title'		=> 'Edit Produk: '.$produk->nama_produk,
						'kategori'	=> $kategori,
						'produk'	=> $produk,
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/produk/edit'
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
			echo $this->image_lib->display_errors();

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			// end


			$i = $this->input;
			$slug_produk = url_title($this->input->post('nama_produk').'-'.$this->input->post('kode_produk'), 'dash', TRUE);
			$data = array(	'id_produk'		=> $id_produk,
							'id_user'		=> $this->session->userdata('id_user'),
							'id_kategori'	=> $i->post('id_kategori'),
							'kode_produk' 	=> $i->post('kode_produk'),
							'nama_produk' 	=> $i->post('nama_produk'),
							'slug_produk'	=> $slug_produk,
							'keterangan' 	=> $i->post('keterangan'),
							'keywords'		=> $i->post('keywords'),
							'harga'		 	=> $i->post('harga_produk'),
							'gambar'		=> $upload_gambar['upload_data']['file_name'],
						);
			$this->produk_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/produk'),'refresh');
		}}else{
			//hanya edit data tanpa gambar
			$i = $this->input;
			$slug_produk = url_title($this->input->post('nama_produk').'-'.$this->input->post('kode_produk'), 'dash', TRUE);
			$data = array(	'id_produk'		=> $id_produk,
							'id_user'		=> $this->session->userdata('id_user'),
							'id_kategori'	=> $i->post('id_kategori'),
							'kode_produk' 	=> $i->post('kode_produk'),
							'nama_produk' 	=> $i->post('nama_produk'),
							'slug_produk'	=> $slug_produk,
							'keterangan' 	=> $i->post('keterangan'),
							'keywords'		=> $i->post('keywords'),
							'harga'		 	=> $i->post('harga_produk'),
							//'gambar'		=> $upload_gambar['upload_data']['file_name'],
						);
			$this->produk_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/produk'),'refresh');
		}}
		$data = array(	'title'		=> 'Edit Produk: '.$produk->nama_produk,
						'kategori'	=> $kategori,
						'produk'	=> $produk,
						'isi'		=> 'admin/produk/edit'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);

	}

	public function delete($id_produk){
		$produk = $this->produk_model->detail($id_produk);
		unlink('./assets/upload/image/'.$produk->gambar);
		$data = array('id_produk' => $id_produk);
		$this->produk_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/produk/'),'refresh');
	}

	public function delete_gambar($id_produk,$id_gambar){
		$gambar = $this->produk_model->detail_gambar($id_gambar);
		unlink('./assets/upload/image/'.$gambar->gambar);
		$data = array('id_gambar' => $id_gambar);
		$this->produk_model->delete_gambar($data);
		$this->session->set_flashdata('sukses', 'Gambar telah dihapus');
		redirect(base_url('admin/produk/gambar/'.$id_produk),'refresh');
	}

}

/* End of file Produk.php */
/* Location: ./application/controllers/admin/Produk.php */