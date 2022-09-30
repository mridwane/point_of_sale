<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('m_barang');
        $this->load->model('m_transaksi');
        if(empty($this->session->userdata('is_login')))
        {
			redirect('Auth');
		}
    }

    public function index()
    {
        $data = array(
            'title' => "Transaksi Offline",
        );
        $this->template->load('app/app', 'Transaksi/v_transaksi', $data);
    }

    public function add_cart()
    {
        $kd_barang = html_escape($this->input->post('kd_barang'));
        $data = $this->m_barang->get_barang($kd_barang);
        $data1 = array(
            'id'      => $kd_barang,
            'qty'     => 1,
            'price'   => $data->harga_jual,
            'name'    => $data->nama_barang,
            'options' => array('harga_beli' => $data->harga_beli)
        );

        $insert = $this->cart->insert($data1);
		echo json_encode($insert);
    }

    public function remove_item()
    {
        $rowid = $this->input->post('kd_barang');
        $data = array(
            'rowid'   => $rowid,
            'qty'     => 0
        );
        $remove = $this->cart->update($data);
		echo json_encode($remove);
    }

    public function remove_all()
    {
        $remove_all = $this->cart->destroy();
		echo json_encode($remove_all);
    }

    public function list_cart()
    {
        $data = [];
		$no = 1; 
        foreach ($this->cart->contents() as $items){            
			$row = [];
			$row[] = $no;
			$row[] = $items["name"];
			$row[] = 'Rp. ' . number_format( $items['price'], 0 , '' , '.' );
			$row[] = '<b id="'.$items['id'].'">'.$items["qty"].'</b>';
            $row[] = 'Rp. ' . number_format( $items['subtotal'], 0 , '' , '.' );
			//add html for action
			$row[] = '<a href="javascript:void(0);" class="btn btn-danger btn-circle delete_item" data-kd_barang="'.$items['rowid'].'"><i class="fas fa-trash"></i></a>';
			$data[] = $row;
			$no++;
        }
		$output = array(
            "data" => $data,
        );
		//$this->auto_update();
		echo json_encode($output);
    }

    function show_total(){ //Fungsi untuk menampilkan Cart
        $output = '';
        $output .= '<input type="text" class="form-control custom-radius custom-shadow text-14" maxlength="25" id="subtotalval" readonly value="Rp. '.number_format($this->cart->total(), 0 , '' , '.' ).'">';
        return $output;
    }
 
    function load_total(){ //load data cart
        echo $this->show_total();
    }

    public function cek_stok()
    {
        $kd_barang = html_escape($this->input->post('kd_barang'));
		$data = $this->m_barang->get_barang($kd_barang);
		echo $data->stok;
    }

    public function cek_jumlah()
    {
        $jumlah = $this->cart->contents();
        foreach($jumlah as $items)
        {
            echo $items['qty'];
        }
    }

    public function cetak_struk(){
        $username = $this->session->userdata('username');
        $nama = $this->session->userdata('nama');
        date_default_timezone_set('Asia/Jakarta');
        $namaDepan = explode(" ",$nama);

        $arr = explode(' ', $nama);
        $singkatan = '';
        foreach($arr as $kata)
        {
            $singkatan .= substr($kata, 0, 1);
        }
        $tanggalDB = date('Y-m-d');
        $tanggal = date('d/m/y');
        $waktu = date('H:i:s');

        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $shuffle  = substr(str_shuffle($karakter), 0, 3);        
        $no_transaksi = $shuffle.'/'.$singkatan.'/'.date('dmyHis');
        
        $bayar = $this->input->post('bayar');
        $ConvertBayar = str_replace(".","",str_replace("Rp.", "", $bayar));
        $diskon = $this->input->post('diskon');
        $ConvertDiskon = str_replace(".","",str_replace("Rp.", "", $diskon));
        $kembali = $this->input->post('kembali');
        $ConvertKembali = str_replace(".","",str_replace("Rp.", "", $kembali));
        $subtotal = $this->cart->total();
        $hasil = $subtotal - (int)$ConvertDiskon;

        $pdf = new FPDF('P','mm',array(90,70)); //SETTING UKURAN KERTAS DI DALAM ARRAY        
        $pdf->AddPage(); // membuat halaman baru
        $pdf->SetFont('Arial','B',6); // setting jenis font yang akan digunakan
        // mencetak string 
        $pdf->Cell(0,2,'NAMA MARKET',0,1,'C'); 
        $pdf->SetFont('Arial','B',4); // setting jenis font yang akan digunakan
        $pdf->Cell(0,3,'ALAMAT MARKET',0,1,'C');
        $pdf->Cell(0,1,'KONTAK',0,1,'C'); 
        $pdf->Cell(5,2,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',4);
        $pdf->Cell(6,3,'No. :',0,0,'L');
        $pdf->Cell(27,3,$no_transaksi,0,0);
        $pdf->Cell(6,3,'Tgl :',0,0,'L');
        $pdf->Cell(10,3,$tanggal,0,1,'R');
        $pdf->Cell(6,3,'Kasir :',0,0,'L');
        $pdf->Cell(27,3,$namaDepan[0],0,0);
        $pdf->Cell(6,3,'Waktu :',0,0,'L');
        $pdf->Cell(10,3,$waktu,0,1,'R');
        $pdf->Cell(50,3,'=========================================================================',0,1,'C');
        $pdf->SetFont('Arial','B',4);
        $pdf->Cell(25,3,'Nama Barang',0,0);
        $pdf->Cell(5,3,'qty',0,0,'C');
        $pdf->Cell(10,3,'Harga',0,0,'C');
        $pdf->Cell(10,3,'Sub Total',0,1,'C');
        $pdf->Cell(50,3,'-------------------------------------------------------------------------------------------------------',0,1,'C'); 
        $pdf->SetFont('Arial','B',4);
        foreach ($this->cart->contents() as $items){
            $pdf->Cell(25,4,$items["name"],0,0);
            $pdf->Cell(5,4,$items["qty"],0,0,'C');
            $pdf->Cell(10,4,number_format( $items['price'], 0 , '' , '.' ),0,0,'R');
            $pdf->Cell(10,4,number_format( $items['subtotal'], 0 , '' , '.' ),0,1,'R'); 
        }
        // total
        $pdf->Cell(50,1,'-------------------------------------------------------------------------------------------------------',0,1,'C'); 
        $pdf->SetFont('Arial','B',4);
        $pdf->Cell(20,3,'',0,0);
        $pdf->Cell(5,3,'',0,0,'C');
        $pdf->Cell(10,3,'subtotal :',0,0,'L');
        $pdf->Cell(15,3,'Rp. '.number_format($this->cart->total(), 0 , '' , '.' ),0,1,'R'); 
        $pdf->Cell(20,3,'',0,0);
        $pdf->Cell(5,3,'',0,0,'C');
        $pdf->Cell(10,3,'Diskon :',0,0,'L');
        $pdf->Cell(15,3,$diskon,0,1,'R');
        $pdf->Cell(20,3,'',0,0);
        $pdf->Cell(5,3,'',0,0,'C');
        $pdf->Cell(10,3,'Total :',0,0,'L');
        $pdf->Cell(15,3,'Rp. '.number_format($hasil, 0 , '' , '.' ),0,1,'R');  
        $pdf->Cell(20,3,'',0,0);
        $pdf->Cell(5,3,'',0,0,'C');
        $pdf->Cell(10,3,'Tunai :',0,0,'L');
        $pdf->Cell(15,3,$bayar,0,1,'R'); 
        $pdf->Cell(50,3,'-------------------------------------------------------------------------------------------------------',0,1,'C'); 
        $pdf->Cell(20,3,'',0,0);
        $pdf->Cell(5,3,'',0,0,'C');
        $pdf->Cell(10,3,'Kembali :',0,0,'L');
        $pdf->Cell(15,3,$kembali,0,1,'R'); 
       
        $pdf->Cell(50,3,'=========================================================================',0,1,'C');
        $pdf->SetFont('Arial','B',4); // setting jenis font yang akan digunakan
        // mencetak string 
        $pdf->Cell(0,2,'Terimakasih sudah berbelanja di kami.',0,1,'C'); 
        $pdf->Output();

        $data = array(
            'kd_transaksi'  => $no_transaksi, 
            'username'  =>  $username,
            'tanggal_transaksi'  => $tanggalDB, 
            'waktu_transaksi'  => $waktu, 
            'subtotal'  => $subtotal, 
            'diskon'  => (int)$ConvertDiskon, 
            'total'  => $hasil, 
            'tunai'  => (int)$ConvertBayar, 
            'kembali'  => (int)$ConvertKembali, 
        );
        $this->m_transaksi->save_transaksi($data);

        foreach ($this->cart->contents() as $item)
        {
            $data1 = array(
                'kd_transaksi'  => $no_transaksi, 
                'kd_barang'  =>  $item['id'],
                'jumlah'  => $item['qty'], 
                'sub_harga_jual'  => $item['subtotal'],  
                'sub_harga_beli'  => $item['options']['harga_beli']*$item['qty'],  
            );
            $this->m_transaksi->save_detailTransaksi($data1);
        }
    }
    
 

}
