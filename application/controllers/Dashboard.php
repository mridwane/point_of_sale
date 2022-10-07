<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('m_transaksi_offline');
        $this->load->model('m_product');
        if(empty($this->session->userdata('is_login')))
        {
			redirect('Auth');
		}
    }
    
    public function index()
    {
        $data = array(
            'title' => "Dashboard",

			'barang' => $this->db->count_all('wsproduct'),
			'kategori' => $this->db->count_all('wsproduct_type'),
            'transaksi' => $this->m_transaksi_offline->total_sales(),
            'barang_terjual' => $this->m_transaksi_offline->total_barang_terjual(),
            'list' => $this->m_transaksi_offline->list_barang_terjual(),
            'stok' => $this->m_product->stok_menipis(),
		);
        view('Dashboard/v_dashboard', $data);
    }

}
