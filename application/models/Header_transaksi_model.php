<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Header_transaksi_model extends CI_Model {

	public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}	
	public function listing(){
		$this->db->select('*');
		$this->db->from('header_transaksi');
		$this->db->order_by('id_header_transaksi', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function pelanggan($id_pelanggan){
		$this->db->select('header_transaksi.*,
		 SUM(transaksi.jumlah) AS total_item');
		$this->db->from('header_transaksi');
		$this->db->where('header_transaksi.id_pelanggan', $id_pelanggan);
		//join
		$this->db->join('transaksi', 'transaksi.kode_transaksi = header_transaksi.kode_transaksi', 'left');
		// end join
		$this->db->group_by('header_transaksi.id_header_transaksi');
		$this->db->order_by('id_header_transaksi', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function kode_transaksi($kode_transaksi){
		$this->db->select('*');
		$this->db->from('header_transaksi');
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->order_by('id_header_transaksi', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail($id_header_transaksi){
		$this->db->select('*');
		$this->db->from('header_transaksi');
		$this->db->where('id_header_transaksi', $id_header_transaksi);
		$this->db->order_by('id_header_transaksi', 'desc');
		$query = $this->db->get();
		return $query->row();
	}
	

	public function tambah($data)
	{
		$this->db->insert('header_transaksi', $data);
	}

	public function delete($data){
		$this->db->where('id_header_transaksi', $data['id_header_transaksi']);
		$this->db->delete('header_transaksi', $data);
	}

	public function edit($data){
		$this->db->where('id_header_transaksi', $data['id_header_transaksi']);
		$this->db->update('header_transaksi', $data);
	}
}


/* End of file Header_transaksi_model.php */
/* Location: ./application/models/Header_transaksi_model.php */