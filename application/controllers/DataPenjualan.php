<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataPenjualan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('m_transaksi');
        if(empty($this->session->userdata('is_login')))
        {
			redirect('Auth/login');
		}
        else if($this->session->userdata('kd_role') == 2)
        {            
            $keluar = $this->session->sess_destroy();
            redirect('Auth');
		}
    }
    
    
    public function index()
    {
        $url['title'] = "Data Penjualan";
        
        $this->load->view('Tamplate/header', $url);
        $this->load->view('Tamplate/sidebar');
        $this->load->view('DataMaster/v_penjualan');
        $this->load->view('Tamplate/footer');
    }

    function data_penjualan(){
        $tanggal = html_escape($this->input->post('tanggal'));
        $data=$this->m_transaksi->list_penjualan($tanggal);
        echo json_encode($data);
    }

    public function cek_transaksi()
	{         
		$tanggal = html_escape($this->input->post('tanggal'));
		$cekTransaksi = $this->m_transaksi->cek_penjualan($tanggal);
		if ($cekTransaksi > 0)
		{
			echo "ada";
		}
    }

}