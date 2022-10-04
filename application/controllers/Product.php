<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('m_product');
        $this->load->model('m_product_type');
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
			'product_type' => $this->m_product_type->get_product_type()->result(),
		);
        // $barang = $this->m_product->cek_stok();
        // $stokhabis = $this->m_product->cek_stok_habis();
        // if($barang == True)
        // {
        //     $this->session->set_flashdata('stok', '<div class="alert alert-warning alert-dismissible bg-warning text-dark border-0 fade show"role="alert">
        //                                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //                                             <span aria-hidden="true">×</span>
        //                                         </button>
        //                                         <strong>Stok Barang Menipis - </strong>Sepertinya ada stok barang yang mulai menipis.
        //                                         </div>');
        // }
        // if($stokhabis == True)
        // {
        //     $this->session->set_flashdata('stokhabis', '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"role="alert">
        //                                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //                                             <span aria-hidden="true">×</span>
        //                                         </button>
        //                                         <strong>Stok Barang Habis - </strong>Sepertinya ada stok barang yang sudah habis.
        //                                         </div>');
        // }
        
        view('DataMaster/v_product', $data);
    }

    
    function get_data_user()
    {
        $list = $this->m_product->get_datatables();
        $data = array();
        $no = 1;
        foreach ($list as $field) {
            $row = array();
            $row[] = $no++;
            $row[] = $field->product_name;
            $row[] = $field->product_type_name;
            $row[] = $field->uom_name;            
            $row[] = 'Rp. ' . number_format( $field->price, 0 , '' , '.' );
            $row[] = $field->qty_stock;
            $row[] = $field->status;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_product->count_all(),
            "recordsFiltered" => $this->m_product->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    // public function cek_nama()
	// {         
	// 	$nama = html_escape($this->input->post('nama'));
	// 	$cekNama = $this->m_product->get_nama($nama);
	// 	if ($cekNama > 0)
	// 	{
	// 		echo "nama ada";
	// 	}
    // }

    // public function cek_kd_barang()
	// {         
	// 	$kd_barang = html_escape($this->input->post('kd_barang'));
	// 	$cekkd_barang = $this->m_product->get_kd_barang($kd_barang);
	// 	if ($cekkd_barang > 0)
	// 	{
	// 		echo "kd_barang ada";
	// 	}
    // }
    
    // public function cek_namaEdit()
	// {         
	// 	$nama = html_escape($this->input->post('namaEdit'));
	// 	$cekNama = $this->m_product->get_nama($nama);
	// 	if ($cekNama > 0)
	// 	{
	// 		echo "nama ada";
	// 	}
	// }
 
    // public function add()
    // {
    //     $kd_barang = html_escape($this->input->post('kd_barang'));
    //     $nama = html_escape($this->input->post('nama'));
    //     $kategori = html_escape($this->input->post('kategori'));
    //     $harga_beli = html_escape($this->input->post('harga_beli'));
    //     $harga_beli_str = preg_replace("/[^0-9]/", "", $harga_beli);
    //     $harga_jual = html_escape($this->input->post('harga_jual'));
    //     $harga_jual_str = preg_replace("/[^0-9]/", "", $harga_jual);
    //     $stok = html_escape($this->input->post('stok'));
    //     $username = $this->session->userdata('username');
    //     $tanggal = date('Y-m-d');

    //     $data = array(
    //         'kd_barang'  => $kd_barang, 
    //         'nama_barang'  => $nama, 
    //         'kd_kategori'  => $kategori, 
    //         'harga_beli'  => $harga_beli_str, 
    //         'harga_jual'  => $harga_jual_str, 
    //         'stok'  => $stok, 
    //     );
        
    //     $data1 = array(
    //         'kd_barang'  => $kd_barang, 
    //         'username'  => $username, 
    //         'tanggal'  => $tanggal, 
    //         'update_stok'  => $stok,
    //         'status'  => "Barang Baru",
    //     );
    //     $this->m_product->barang_masuk($data1);
    //     $data=$this->m_product->add_barang($data);
    //     echo json_encode($data);
    // }
    // public function add_stok()
    // {
    //     $kd_barang = html_escape($this->input->post('kd_barangAdd'));
    //     $stok = html_escape($this->input->post('stokAdd'));
    //     $username = $this->session->userdata('username');
    //     $tanggal = date('Y-m-d');
        
    //     $data1 = array(
    //         'kd_barang'  => $kd_barang, 
    //         'username'  => $username, 
    //         'tanggal'  => $tanggal, 
    //         'update_stok'  => $stok,
    //         'status'  => "Ditambahkan",
    //     );
    //     $data=$this->m_product->barang_masuk($data1);
    //     echo json_encode($data);
    // }
 
    // public function update(){
    //     $kd_barang = html_escape($this->input->post('kd_barangEdit'));
    //     $nama_barang = html_escape($this->input->post('nama_barangEdit'));
    //     $kategori = html_escape($this->input->post('kategoriEdit'));
    //     $harga_beli = html_escape($this->input->post('harga_beliEdit'));
    //     $harga_beli_str = preg_replace("/[^0-9]/", "", $harga_beli);
    //     $harga_jual = html_escape($this->input->post('harga_jualEdit'));
    //     $harga_jual_str = preg_replace("/[^0-9]/", "", $harga_jual);
    //     $username = $this->session->userdata('username');
    //     $tanggal = date('Y-m-d');
        
    //     $data = array(
    //         'nama_barang'  => $nama_barang, 
    //         'kd_kategori'  => $kategori, 
    //         'harga_beli'  => $harga_beli_str, 
    //         'harga_jual'  => $harga_jual_str,
    //     );
    //     $data=$this->m_product->update_barang($data,$kd_barang);
    //     echo json_encode($data);
    // }
 
    // public function delete(){
    //     $kd_barang = html_escape($this->input->post('kd_barang'));

    //     $data=$this->m_product->delete_barang($kd_barang);
    //     echo json_encode($data);
    // }
    
 

}
