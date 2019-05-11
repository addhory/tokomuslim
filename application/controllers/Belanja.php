<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
		$this->load->model('kategori_model');
		$this->load->model('konfigurasi_model');
	}

	public function index()
	{
		$keranjang = $this->cart->contents();
		$data = array(	'title'		=> 'Keranjang Belanja',
						'keranjang'	=>	$keranjang,
						'isi'		=> 'belanja/list'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function add()
	{
		//ambil data
		$id 			= $this->input->post('id');
		$qty 			= $this->input->post('qty');
		$price 			= $this->input->post('price');
		$name 			= $this->input->post('name');
		$redirect_page	= $this->input->post('redirect_page');
	
		//processing
		$data = array(	'id'		=> $id,
						'qty'		=> $qty,
						'price'		=> $price,
						'name'		=> $name
						);
		$this->cart->insert($data);
		redirect($redirect_page,'refresh');
	}

	public function update_cart($rowid)
	{
		if ($rowid) 
		{
			$data	= array(	'rowid'			=> $rowid,
								'qty'			=> $this->input->post('qty')
							);
			$this->cart->update($data);
			$this->session->set_flashdata('sukses', 'Keranjang Telah Diupdate');
			redirect(base_url('belanja'),'refresh');	
		}else{
			redirect(base_url('belanja'),'refresh');
		}
	}

	public function hapus($rowid='')
	{
		if ($rowid) {
			$this->cart->remove($rowid);
			$this->session->set_flashdata('sukses', 'Produk telah dihapus');
			redirect(base_url('belanja'),'refresh');
		}else{
			$this->cart->destroy();
			$this->session->set_flashdata('sukses', 'Keranjang Belanja telah direset');
			redirect(base_url('belanja'),'refresh');
		}
	}

}

/* End of file belanja.php */
/* Location: ./application/controllers/belanja.php */