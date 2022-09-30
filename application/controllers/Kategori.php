<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('m_kategori');
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
        $this->template->load('app/app', 'DataMaster/v_kategori', $data);
    }

    function get_data_user()
    {
        $list = $this->m_kategori->get_datatables();
        $data = array();
        $no = 1;
        foreach ($list as $field) {
            $row = array();
            $row[] = $no++;
            $row[] = $field->nama_kategori;
            $row[] = '<a href="javascript:void(0);" class="btn btn-danger btn-circle delete_kategori" data-kd_kategori="'.$field->kd_kategori.'"><i class="fas fa-trash"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_kategori->count_all(),
            "recordsFiltered" => $this->m_kategori->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function cek_nama()
	{         
		$nama = html_escape($this->input->post('nama'));
		$cekNama = $this->m_kategori->get_nama($nama);
		if ($cekNama > 0)
		{
			echo "nama ada";
		}
    }
    
    public function cek_namaEdit()
	{         
		$nama = html_escape($this->input->post('namaEdit'));
		$cekNama = $this->m_kategori->get_nama($nama);
		if ($cekNama > 0)
		{
			echo "nama ada";
		}
	}
 
    public function add()
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $shuffle  = substr(str_shuffle($karakter), 0, 4);        
        $kd_kategori = "K-".$shuffle;
        $nama = html_escape($this->input->post('nama'));
        $data = array(
            'kd_kategori'  => $kd_kategori, 
            'nama_kategori'  => $nama, 
        );
        $data=$this->m_kategori->add_kategori($data);
        echo json_encode($data);
    }
 
    public function update(){
        $kd_kategori = html_escape($this->input->post('kd_kategori'));

        $data = array(
            'nama_kategori' => html_escape($this->input->post('nama_kategori')),
        );
        $data=$this->m_kategori->update_kategori($data,$kd_kategori);
        echo json_encode($data);
    }
 
    public function delete(){
        $kd_kategori = html_escape($this->input->post('kd_kategori'));

        $data=$this->m_kategori->delete_kategori($kd_kategori);
        echo json_encode($data);
    }
    
 

}
