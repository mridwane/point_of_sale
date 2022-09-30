<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('m_barang');
        $this->load->model('m_kategori');
        if(empty($this->session->userdata('is_login')))
        {
			redirect('Auth');
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
            'sub_title' => "Data Barang",
			'kategori' => $this->m_kategori->ambil_kategori()->result(),
		);
        $barang = $this->m_barang->cek_stok();
        $stokhabis = $this->m_barang->cek_stok_habis();
        if($barang == True)
        {
            $this->session->set_flashdata('stok', '<div class="alert alert-warning alert-dismissible bg-warning text-dark border-0 fade show"role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <strong>Stok Barang Menipis - </strong>Sepertinya ada stok barang yang mulai menipis.
                                                </div>');
        }
        if($stokhabis == True)
        {
            $this->session->set_flashdata('stokhabis', '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <strong>Stok Barang Habis - </strong>Sepertinya ada stok barang yang sudah habis.
                                                </div>');
        }
        
        $this->template->load('app/app', 'DataMaster/v_barang', $data);
    }

    
    function get_data_user()
    {
        $list = $this->m_barang->get_datatables();
        $data = array();
        $no = 1;
        foreach ($list as $field) {
            $row = array();
            $row[] = $no++;
            $row[] = $field->nama_barang;
            $row[] = $field->nama_kategori;
            $row[] = 'Rp. ' . number_format( $field->harga_beli, 0 , '' , '.' );
            $row[] = 'Rp. ' . number_format( $field->harga_jual, 0 , '' , '.' );
            $row[] = $field->stok;
            $row[] = '<a href="javascript:void(0);" class="btn btn-warning btn-circle edit_barang" data-toggle="modal" 
                        data-target="#modal-edit-data" data-kd_barang="'.$field->kd_barang.'" data-nama_barang="'.$field->nama_barang.'" 
                        data-kategori="'.$field->kd_kategori.'" data-harga_beli="'.$field->harga_beli.'" data-harga_jual="'.$field->harga_jual.'">
                        <i class="fas fa-pencil-alt"></i></a> 
                        <a href="javascript:void(0);" class="btn btn-info btn-circle add_stok" data-toggle="modal" 
                        data-target="#modal-add-stok" data-kd_barang="'.$field->kd_barang.'" data-nama_barang="'.$field->nama_barang.'"><i class="fas fa-database"></i></a>
                        <a href="javascript:void(0);" class="btn btn-danger btn-circle delete_barang" data-kd_barang="'.$field->kd_barang.'"><i class="fas fa-trash"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_barang->count_all(),
            "recordsFiltered" => $this->m_barang->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function cek_nama()
	{         
		$nama = html_escape($this->input->post('nama'));
		$cekNama = $this->m_barang->get_nama($nama);
		if ($cekNama > 0)
		{
			echo "nama ada";
		}
    }

    public function cek_kd_barang()
	{         
		$kd_barang = html_escape($this->input->post('kd_barang'));
		$cekkd_barang = $this->m_barang->get_kd_barang($kd_barang);
		if ($cekkd_barang > 0)
		{
			echo "kd_barang ada";
		}
    }
    
    public function cek_namaEdit()
	{         
		$nama = html_escape($this->input->post('namaEdit'));
		$cekNama = $this->m_barang->get_nama($nama);
		if ($cekNama > 0)
		{
			echo "nama ada";
		}
	}
 
    public function add()
    {
        $kd_barang = html_escape($this->input->post('kd_barang'));
        $nama = html_escape($this->input->post('nama'));
        $kategori = html_escape($this->input->post('kategori'));
        $harga_beli = html_escape($this->input->post('harga_beli'));
        $harga_beli_str = preg_replace("/[^0-9]/", "", $harga_beli);
        $harga_jual = html_escape($this->input->post('harga_jual'));
        $harga_jual_str = preg_replace("/[^0-9]/", "", $harga_jual);
        $stok = html_escape($this->input->post('stok'));
        $username = $this->session->userdata('username');
        $tanggal = date('Y-m-d');

        $data = array(
            'kd_barang'  => $kd_barang, 
            'nama_barang'  => $nama, 
            'kd_kategori'  => $kategori, 
            'harga_beli'  => $harga_beli_str, 
            'harga_jual'  => $harga_jual_str, 
            'stok'  => $stok, 
        );
        
        $data1 = array(
            'kd_barang'  => $kd_barang, 
            'username'  => $username, 
            'tanggal'  => $tanggal, 
            'update_stok'  => $stok,
            'status'  => "Barang Baru",
        );
        $this->m_barang->barang_masuk($data1);
        $data=$this->m_barang->add_barang($data);
        echo json_encode($data);
    }
    public function add_stok()
    {
        $kd_barang = html_escape($this->input->post('kd_barangAdd'));
        $stok = html_escape($this->input->post('stokAdd'));
        $username = $this->session->userdata('username');
        $tanggal = date('Y-m-d');
        
        $data1 = array(
            'kd_barang'  => $kd_barang, 
            'username'  => $username, 
            'tanggal'  => $tanggal, 
            'update_stok'  => $stok,
            'status'  => "Ditambahkan",
        );
        $data=$this->m_barang->barang_masuk($data1);
        echo json_encode($data);
    }
 
    public function update(){
        $kd_barang = html_escape($this->input->post('kd_barangEdit'));
        $nama_barang = html_escape($this->input->post('nama_barangEdit'));
        $kategori = html_escape($this->input->post('kategoriEdit'));
        $harga_beli = html_escape($this->input->post('harga_beliEdit'));
        $harga_beli_str = preg_replace("/[^0-9]/", "", $harga_beli);
        $harga_jual = html_escape($this->input->post('harga_jualEdit'));
        $harga_jual_str = preg_replace("/[^0-9]/", "", $harga_jual);
        $username = $this->session->userdata('username');
        $tanggal = date('Y-m-d');
        
        $data = array(
            'nama_barang'  => $nama_barang, 
            'kd_kategori'  => $kategori, 
            'harga_beli'  => $harga_beli_str, 
            'harga_jual'  => $harga_jual_str,
        );
        $data=$this->m_barang->update_barang($data,$kd_barang);
        echo json_encode($data);
    }
 
    public function delete(){
        $kd_barang = html_escape($this->input->post('kd_barang'));

        $data=$this->m_barang->delete_barang($kd_barang);
        echo json_encode($data);
    }
    
 

}
