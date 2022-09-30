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
        $data = array(
            'title' => "Dashboard",
            // 'sub_title' => "Data Barang",
			'barang' => $this->db->count_all('barang'),
			'kategori' => $this->db->count_all('kategori'),
            'transaksi' => $this->m_transaksi->total_transaksi(),
            'barang_terjual' => $this->m_transaksi->total_barang_terjual(),
            'list' => $this->m_transaksi->list_barang_terjual(),
            'stok' => $this->m_barang->stok_menipis(),
		);
        $this->template->load('app/app', 'Dashboard/v_dashboard', $data);
    }

}
