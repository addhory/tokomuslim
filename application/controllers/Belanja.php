<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
		$this->load->model('kategori_model');
		$this->load->model('konfigurasi_model');
		$this->load->model('header_transaksi_model');
		$this->load->model('transaksi_model');
		$this->load->model('pelanggan_model');

				//helper random string
				$this->load->helper('string');
				

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
	//sukses belanja
	public function sukses()
	{
		$keranjang = $this->cart->contents();
		$data = array(	'title'		=> 'Belanja Berhasil',
						'isi'		=> 'belanja/sukses'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//checkout
	public function checkout()
	{
		if($this->session->userdata('email')){
			$email = $this->session->userdata('email');
			$nama_pelanggan = $this->session->userdata('nama_pelanggan');
			$pelanggan = $this-> pelanggan_model->sudah_login($email,$nama_pelanggan);
		
		$keranjang = $this->cart->contents();

		//validasi input
        $valid = $this->form_validation;
		$valid->set_rules('nama_pelanggan','Nama Lengkap','required',
			array(	'required'		=>	'%s harus diisi'));
		$valid->set_rules('telepon','Nomor Telepon','required',
			array(	'required'		=>	'%s harus diisi'));
		$valid->set_rules('alamat','Alamat','required',
			array(	'required'		=>	'%s harus diisi'));

		$valid->set_rules('email','Email','required|valid_email',
			array(	'required'		=>	'%s harus diisi',
                    'valid email'	=>	'%s tidak valid'));
                    
        
		
			if($valid->run()===FALSE) {
			//end validasi

			$data = array(	'title'		=> 'Checkout',
						'keranjang'	=>	$keranjang,
						'pelanggan' =>  $pelanggan,
						'isi'		=> 'belanja/checkout'
					);
			$this->load->view('layout/wrapper', $data, FALSE);
			//masuk database
			}else{
			$i = $this->input;
			$data = array(	
							'id_pelanggan'				=> $pelanggan->id_pelanggan,
							'nama_pelanggan' 			=> $i->post('nama_pelanggan'),
							'email' 		=> $i->post('email'),
                            'telepon'	    => $i->post('telepon'),
							'alamat'	    => $i->post('alamat'),
							'kode_transaksi'=> $i->post('kode_transaksi'),
							'tanggal_transaksi'=> $i->post('tanggal_transaksi'),
							'jumlah_transaksi'=> $i->post('jumlah_transaksi'),
							'status_bayar'	=> 'Belum',
                            'tanggal_post'=> date('Y-m-d H:i:s')
						);

						//masuk ke transaksi
				$this->header_transaksi_model->tambah($data);
				//proses masuk ke tabel transaksi
				foreach ($keranjang as $keranjang){
				$subtotal = $keranjang['price']*$keranjang['qty'];

				$data = array(		'id_pelanggan'	=>$pelanggan->id_pelanggan,
									'kode_transaksi'=> $i->post('kode_transaksi'),
									'id_produk'		=> $keranjang['id'],
									'harga'			=> $keranjang['price'],
									'jumlah'		=> $keranjang['qty'],
									'total_harga'	=> $subtotal,
									'tanggal_transaksi' => $i->post('tanggal_transaksi')	
								);
								$this->transaksi_model->tambah($data);
				}

			//end proses masuk tabel transaksi

			//setelah masuk tabel transaksi maka harus dikosongkan
			$this->cart->destroy();
			// end kosong keranjang
           
			$this->session->set_flashdata('sukses', 'Checkout berhasil');
			redirect(base_url('belanja/sukses'),'refresh');
        }
        //end masuk database
	
		}else{
			//kalau belum regis
			$this->session->set_flashdata('sukses', 'Silhakan login atau registrasi terlebih dahulu');
			redirect(base_url('registrasi'),'refresh');
		}

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