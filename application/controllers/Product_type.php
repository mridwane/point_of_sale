<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_type extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('m_product_type');
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
        $data = array(
            'title' => "Data Master",
            'sub_title' => "Data Kategori",
        );
        view('DataMaster/v_product_type', $data);
    }

    function get_data_user()
    {
        $list = $this->m_product_type->get_datatables();
        $data = array();
        $no = 1;
        foreach ($list as $field) {
            $row = array();
            $row[] = $no++;
            $row[] = $field->cname;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_product_type->count_all(),
            "recordsFiltered" => $this->m_product_type->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    // public function cek_nama()
	// {         
	// 	$nama = html_escape($this->input->post('nama'));
	// 	$cekNama = $this->m_product_type->get_nama($nama);
	// 	if ($cekNama > 0)
	// 	{
	// 		echo "nama ada";
	// 	}
    // }
    
    // public function cek_namaEdit()
	// {         
	// 	$nama = html_escape($this->input->post('namaEdit'));
	// 	$cekNama = $this->m_product_type->get_nama($nama);
	// 	if ($cekNama > 0)
	// 	{
	// 		echo "nama ada";
	// 	}
	// }
 
    // public function add()
    // {
    //     // $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    //     // $shuffle  = substr(str_shuffle($karakter), 0, 4);        
    //     // $kd_kategori = "K-".$shuffle;
    //     $nama = html_escape($this->input->post('nama'));
    //     $data = array(
    //         'cname'  => $nama, 
    //     );
    //     $data=$this->m_product_type->add_product_type($data);
    //     echo json_encode($data);
    // }
 
    // public function delete(){
    //     $kd_kategori = html_escape($this->input->post('kd_kategori'));

    //     $data=$this->m_product_type->delete_product_type($kd_kategori);
    //     echo json_encode($data);
    // }
    
 

}
