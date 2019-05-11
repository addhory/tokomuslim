<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_login
{
	protected $CI;

	public function __construct()
	{
        $this->CI =& get_instance();
        $this->CI->load->model('user_model');
	}

	public function login($username,$password)
	{
		$check = $this->CI->user_model->login($username,$password);
		if ($check) {
			$id_user		= $check->id_user;
			$nama			= $check->nama;
			$akses_level 	= $check->akses_level;

			$this->CI->session->set_userdata('id_user',$id_user);
			$this->CI->session->set_userdata('nama',$nama);
			$this->CI->session->set_userdata('username',$username);
			$this->CI->session->set_userdata('akses_level',$akses_level);    
			
			redirect(base_url('admin/dasbor'),'refresh');
		}else{
			$this->CI->session->set_flashdata('Warning', 'Username atau Password Salah');
			redirect(base_url('login'),'refresh');
		}
	}

	public function cek_login()
	{
		if ($this->CI->session->userdata('username') == "") {
			$this->CI->session->set_flashdata('Warning', 'Silahkan Login');
			redirect(base_url('login'),'refresh');
		}
	}

	public function logout()
	{
		$this->CI->session->unset_userdata('id_user');
		$this->CI->session->unset_userdata('nama');
		$this->CI->session->unset_userdata('username');
		$this->CI->session->unset_userdata('akses_level');

		$this->CI->session->set_flashdata('Sukses', 'Anda telah LOGOUT');
		redirect(base_url('login'),'refresh');


	}

	

}

/* End of file Simple_login.php */
/* Location: ./application/libraries/Simple_login.php */
