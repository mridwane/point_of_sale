<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('m_transaksi');
        $this->load->model('m_barang');
        if(empty($this->session->userdata('is_login')))
        {
			redirect('Auth');
		}
    }
    
    public function index()
    {
        $data['barang'] = $this->db->count_all('barang'); 
        $data['kategori'] = $this->db->count_all('kategori'); 
        $data['transaksi'] = $this->m_transaksi->total_transaksi(); 
        $data['barang_terjual'] = $this->m_transaksi->total_barang_terjual(); 
        $data['list'] = $this->m_transaksi->list_barang_terjual(); 
        $data['stok'] = $this->m_barang->stok_menipis(); 

        $url['title'] = "Dashboard";
        $this->load->view('Tamplate/header', $url);
        $this->load->view('Tamplate/sidebar');
        $this->load->view('Dashboard/home', $data);
        $this->load->view('Tamplate/footer');
    }

}
