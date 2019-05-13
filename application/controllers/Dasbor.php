<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Dasbor extends CI_Controller {

//load model
    public function __construct(){
        parent::__construct();
        $this->load->model('pelanggan_model');
        $this->load->model('header_transaksi_model');
        $this->load->model('transaksi_model');
        //proteksi check login
        $this->simple_pelanggan->cek_login();

    }
    //halaman dasbor
    public function index()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $header_transaksi = $this->header_transaksi_model->pelanggan($id_pelanggan);

        $data = array(  'title'     =>  'Halaman Dashboard Pelanggan',
                         'header_transaksi'  => $header_transaksi,
                        'isi'       =>  'dasbor/list'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
                
    }   

    public function belanja()
    {
        // ambil data login
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $header_transaksi = $this->header_transaksi_model->pelanggan($id_pelanggan);
        $data = array(  'title'             => 'Riwayat Belanja',
                        'header_transaksi'  => $header_transaksi,
                        'isi'               => 'dasbor/belanja'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);

        }
    public function detail($kode_transaksi){
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi = $this->transaksi_model->kode_transaksi($kode_transaksi);
        // mengakses data transaksinya
        if($header_transaksi->id_pelanggan != $id_pelanggan){
            $this->session->set_flashdata('warning', 'Anda mencoba mengakses data transaksi orang lain');
            redirect(base_url('masuk'));
        }
        
        $data = array(  'title'             => 'Riwayat Belanja',
                        'header_transaksi'  => $header_transaksi,
                        'transaksi'         => $transaksi,
                        'isi'               => 'dasbor/detail'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);

    }
        
}
        
    /* End of file  Dasbor.php */
        
                            