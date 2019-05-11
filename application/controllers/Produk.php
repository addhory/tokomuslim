<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
		$this->load->model('kategori_model');
	}


	public function index()
	{
		$site 				= $this->konfigurasi_model->listing();
		$listing_kategori 	= $this->produk_model->listing_kategori();
		$total				= $this->produk_model->total_produk();
		//pagination
		$this->load->library('pagination');
		
		$config['base_url'] 		= base_url().'produk/index/';
		$config['total_rows'] 		= $total->total;
		$config['use_page_numbers']	= TRUE;
		$config['per_page'] 		= 6;
		$config['uri_segment'] 		= 3;
		$config['num_links'] 		= 5;
		$config['full_tag_open'] 	= '<p>';
		$config['full_tag_close'] 	= '</p>';
		$config['first_link'] 		= 'First';
		$config['first_tag_open'] 	= '<div>';
		$config['first_tag_close'] 	= '</div>';
		$config['last_link'] 		= 'Last';
		$config['last_tag_open'] 	= '<div>';
		$config['last_tag_close'] 	= '</div>';
		$config['next_link'] 		= '&gt;';
		$config['next_tag_open'] 	= '<div>';
		$config['next_tag_close'] 	= '</div>';
		$config['prev_link'] 		= '&lt;';
		$config['prev_tag_open'] 	= '<div>';
		$config['prev_tag_close'] 	= '</div>';
		$config['cur_tag_open'] 	= '<b>';
		$config['cur_tag_close']	 = '</b>';
		$config['first_url']		= base_url().'/produk/';
		
		$this->pagination->initialize($config);
		$page 		=	($this->uri->segment(3)) ? ($this->uri->segment(3)-1) * $config['per_page']:0;
		$produk 	= 	$this->produk_model->produk($config['per_page'],$page);
		//pagination

		$data = array(	'title'				=>	'Produk '.$site->namaweb,
						'site'				=> 	$site,
						'listing_kategori'	=> 	$listing_kategori,
						'produk'			=>	$produk,
						'pagin'				=> 	$this->pagination->create_links(),
						'isi'				=>	'produk/list'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function kategori($slug_kategori)
	{
		//detail kategori
		$kategori 			= $this->kategori_model->read($slug_kategori);
		$id_kategori		= $kategori->id_kategori;

		$site 				= $this->konfigurasi_model->listing();
		$listing_kategori 	= $this->produk_model->listing_kategori();
		$total				= $this->produk_model->total_kategori($id_kategori);
		//pagination
		$this->load->library('pagination');
		
		$config['base_url'] 		= base_url().'produk/kategori/'.$slug_kategori.'/index/';
		$config['total_rows'] 		= $total->total;
		$config['use_page_numbers']	= TRUE;
		$config['per_page'] 		= 6;
		$config['uri_segment'] 		= 5;
		$config['num_links'] 		= 5;
		$config['full_tag_open'] 	= '<p>';
		$config['full_tag_close'] 	= '</p>';
		$config['first_link'] 		= 'First';
		$config['first_tag_open'] 	= '<div>';
		$config['first_tag_close'] 	= '</div>';
		$config['last_link'] 		= 'Last';
		$config['last_tag_open'] 	= '<div>';
		$config['last_tag_close'] 	= '</div>';
		$config['next_link'] 		= '&gt;';
		$config['next_tag_open'] 	= '<div>';
		$config['next_tag_close'] 	= '</div>';
		$config['prev_link'] 		= '&lt;';
		$config['prev_tag_open'] 	= '<div>';
		$config['prev_tag_close'] 	= '</div>';
		$config['cur_tag_open'] 	= '<b>';
		$config['cur_tag_close']	 = '</b>';
		$config['first_url']		= base_url().'/produk/kategori/'.$slug_kategori;
		
		$this->pagination->initialize($config);
		$page 		=	($this->uri->segment(5)) ? ($this->uri->segment(5)-1) * $config['per_page']:0;
		$produk 	= 	$this->produk_model->kategori($id_kategori, $config['per_page'], $page);
		//pagination

		$data = array(	'title'				=>	$kategori->nama_kategori,
						'site'				=> 	$site,
						'listing_kategori'	=> 	$listing_kategori,
						'produk'			=>	$produk,
						'pagin'				=> 	$this->pagination->create_links(),
						'isi'				=>	'produk/list'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function detail($slug_produk)
	{
		$site 			= $this->konfigurasi_model->listing();
		$produk 		= $this->produk_model->read($slug_produk);
		$id_produk		= $produk->id_produk;
		$gambar			= $this->produk_model->gambar($id_produk);
		$produk_related = $this->produk_model->home();

		$data = array(	'title'				=>	$produk->nama_produk,
						'site'				=> 	$site,
						'produk'			=>	$produk,
						'produk_related'	=>	$produk_related,
						'gambar'			=>	$gambar,
						'isi'				=>	'produk/detail'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
	}



}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */