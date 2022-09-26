<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

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
        else if($this->session->userdata('kd_role') == 2)
        {            
            $keluar = $this->session->sess_destroy();
            redirect('Auth');
		}
    }
    public function barang_masuk()
    {
        $url['title'] = "Laporan Barang Masuk";
        
        $this->load->view('Tamplate/header', $url);
        $this->load->view('Tamplate/sidebar');
        $this->load->view('Laporan/v_barang_masuk');
        $this->load->view('Tamplate/footer');
    }

    public function barang()
    {
        $url['title'] = "Laporan Barang";
        
        $this->load->view('Tamplate/header', $url);
        $this->load->view('Tamplate/sidebar');
        $this->load->view('Laporan/v_barang');
        $this->load->view('Tamplate/footer');
    }

    public function cetak_barang_masuk(){
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('d-m-Y');
        
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tgl_mulai = date('Y-m-d', strtotime($tanggal_mulai));
        $tgl_mulai_periode = date('d/m/Y', strtotime($tanggal_mulai));
        $tanggal_akhir = $this->input->post('tanggal_akhir');
        $tgl_akhir = date('Y-m-d', strtotime($tanggal_akhir));
        $tgl_akhir_periode = date('d/m/Y', strtotime($tanggal_akhir));

        $tampil = $this->m_barang->laporan_barang_masuk($tgl_mulai,$tgl_akhir);

        $pdf = new FPDF('P','mm', 'A4'); //SETTING UKURAN KERTAS DI DALAM ARRAY        
        $pdf->AddPage(); // membuat halaman baru
        $pdf->SetFont('Arial','B',18); // setting jenis font yang akan digunakan
        $pdf->SetTextColor(74,74,74); // set warna
        // mencetak string 
        $pdf->Cell(0,10,'LAPORAN BARANG MASUK',0,5,'C'); 
        $pdf->SetFont('Arial','B',16); // setting jenis font yang akan digunakan
        $pdf->Cell(0,10,'Riddessain',0,5,'C');
        $pdf->Cell(10,2,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(20,10,'Periode :',0,0,'L');
        $pdf->Cell(0,10,$tgl_mulai_periode.' - '.$tgl_akhir_periode  ,0,0);
        $pdf->Cell(10,15,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFillColor(0,0,195);// set warna fill
        $pdf->SetTextColor(245,245,245); // set teks warna
        $pdf->SetDrawColor(255,255,255);
        $pdf->Cell(15,10,'No',1,0,'C',1);
        $pdf->Cell(70,10,'Nama Barang',1,0,'C',1);
        $pdf->Cell(40,10,'Tanggal',1,0,'C',1);
        $pdf->Cell(20,10,'Jumlah',1,0,'C',1);
        $pdf->Cell(45,10,'Status',1,0,'C',1);
        $pdf->Cell(10,10,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetTextColor(74,74,74); // set warna
        // $pdf->SetFillColor(194,194,255);// set warna fill
        $no = 1;
        foreach ($tampil as $items){
            $pdf->SetFillColor(194,194,255);// set warna fill
            $pdf->Cell(15,10,$no++,1,0,'C',1);
            $pdf->Cell(70,10,$items->nama_barang,1,0,'L',1);
            $pdf->Cell(40,10,date('d-m-Y', strtotime($items->tanggal)),1,0,'C',1);
            $pdf->Cell(20,10,$items->update_stok,1,0,'C',1);
            $pdf->Cell(45,10,$items->status,1,1,'C',1); 
        }
        $pdf->Output();
    }

    public function cetak_laporan_barang(){
        date_default_timezone_set('Asia/Jakarta');
        $bulan = date('m');
        
        $barang= $this->m_barang->laporan_barang();

        $pdf = new FPDF('L','mm', 'A4'); //SETTING UKURAN KERTAS DI DALAM ARRAY        
        $pdf->AddPage(); // membuat halaman baru
        $pdf->SetFont('Arial','B',18); // setting jenis font yang akan digunakan
        $pdf->SetTextColor(74,74,74); // set warna
        // mencetak string 
        $pdf->Cell(0,10,'LAPORAN PERBULAN',0,5,'C'); 
        $pdf->SetFont('Arial','B',16); // setting jenis font yang akan digunakan
        $pdf->Cell(0,10,'Riddessain',0,5,'C');
        $pdf->Cell(10,2,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(20,10,'Laporan Barang',0,0,'L');
        $pdf->Cell(10,10,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(17,10,'Bulan :',0,0,'R');
        switch ($bulan) {
        case "01":
            $pdf->Cell(0,10,'Januari',0,0);
            break;
        case "02":
            $pdf->Cell(0,10,'Februari',0,0);
            break;
        case "03":
            $pdf->Cell(0,10,'Maret',0,0);
            break;
        case "04":
            $pdf->Cell(0,10,'April',0,0);
            break;
        case "05":
            $pdf->Cell(0,10,'Mei',0,0);
            break;
        case "06":
            $pdf->Cell(0,10,'Juni',0,0);
            break;
        case "07":
            $pdf->Cell(0,10,'Juli',0,0);
            break;
        case "08":
            $pdf->Cell(0,10,'Agustus',0,0);
            break;
        case "09":
            $pdf->Cell(0,10,'September',0,0);
            break;
        case "10":
            $pdf->Cell(0,10,'Oktober',0,0);
            break;
        case "11":
            $pdf->Cell(0,10,'November',0,0);
            break;
        case "12":
            $pdf->Cell(0,10,'Desember',0,0);
            break;
        default:
        $pdf->Cell(0,10,'Tidak Terpilih',0,0);
        }
        $pdf->Cell(10,15,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFillColor(0,0,195);// set warna fill
        $pdf->SetTextColor(245,245,245); // set teks warna
        $pdf->SetDrawColor(255,255,255);
        $pdf->Cell(15,10,'No',1,0,'C',1);
        $pdf->Cell(70,10,'Nama Barang',1,0,'C',1);
        $pdf->Cell(35,10,'Kategori',1,0,'C',1);
        $pdf->Cell(15,10,'Stok',1,0,'C',1);
        $pdf->Cell(35,10,'Harga Beli (HB)',1,0,'C',1);
        $pdf->Cell(35,10,'Sub(HB) (Rp.)',1,0,'C',1);
        $pdf->Cell(35,10,'Harga Jual (HJ)',1,0,'C',1);
        $pdf->Cell(35,10,'Sub(HJ) (Rp.)',1,0,'C',1);
        $pdf->Cell(10,10,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetTextColor(74,74,74); // set warna
        $pdf->SetFont('Arial','',12);
        $no = 1;
        foreach ($barang as $b){
            $pdf->SetFillColor(194,194,255);// set warna fill
            $pdf->Cell(15,10,$no++,1,0,'C',1);
            $pdf->Cell(70,10,$b->nama_barang,1,0,'L',1);
            $pdf->Cell(35,10,$b->nama_kategori,1,0,'L',1);
            $pdf->Cell(15,10,$b->stok,1,0,'C',1);
            $pdf->Cell(35,10,number_format($b->harga_beli, 0 , '' , '.' ),1,0,'R',1);
            $pdf->Cell(35,10,number_format($b->harga_jual, 0 , '' , '.' ),1,0,'R',1);
            $pdf->Cell(35,10,number_format($b->harga_beli*$b->stok, 0 , '' , '.' ),1,0,'R',1); 
            $pdf->Cell(35,10,number_format($b->harga_jual*$b->stok, 0 , '' , '.' ),1,1,'R',1); 
        }
        $pdf->Output();
    }

    public function perbulan()
    {
        $url['title'] = "Laporan Perbulan";
        
        $this->load->view('Tamplate/header', $url);
        $this->load->view('Tamplate/sidebar');
        $this->load->view('Laporan/v_perbulan');
        $this->load->view('Tamplate/footer');
    }

    public function cetak_perbulan(){
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('d-m-Y');
        
        $bulan = $this->input->post('bulan');

        $tampil = $this->m_transaksi->laporan_transaksi($bulan);
        $jumlah = $this->m_transaksi->jumlah($bulan);
        $barang_terjual = $this->m_transaksi->barang_terjual($bulan);
        $j = $this->m_transaksi->jumlah_barang_terjual($bulan);

        $pdf = new FPDF('L','mm', 'A4'); //SETTING UKURAN KERTAS DI DALAM ARRAY   

        $pdf->AddPage(); // membuat halaman baru
        $pdf->SetFont('Arial','B',18); // setting jenis font yang akan digunakan
        $pdf->SetTextColor(74,74,74); // set warna
        // mencetak string 
        $pdf->Cell(0,10,'LAPORAN PERBULAN',0,5,'C'); 
        $pdf->SetFont('Arial','B',16); // setting jenis font yang akan digunakan
        $pdf->Cell(0,10,'Riddessain',0,5,'C');
        $pdf->Cell(10,2,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(20,10,'Laporan Transaksi ',0,0,'L');
        $pdf->Cell(10,10,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(17,10,'Bulan :',0,0,'R');
        switch ($bulan) {
        case "01":
            $pdf->Cell(0,10,'Januari',0,0);
            break;
        case "02":
            $pdf->Cell(0,10,'Februari',0,0);
            break;
        case "03":
            $pdf->Cell(0,10,'Maret',0,0);
            break;
        case "04":
            $pdf->Cell(0,10,'April',0,0);
            break;
        case "05":
            $pdf->Cell(0,10,'Mei',0,0);
            break;
        case "06":
            $pdf->Cell(0,10,'Juni',0,0);
            break;
        case "07":
            $pdf->Cell(0,10,'Juli',0,0);
            break;
        case "08":
            $pdf->Cell(0,10,'Agustus',0,0);
            break;
        case "09":
            $pdf->Cell(0,10,'September',0,0);
            break;
        case "10":
            $pdf->Cell(0,10,'Oktober',0,0);
            break;
        case "11":
            $pdf->Cell(0,10,'November',0,0);
            break;
        case "12":
            $pdf->Cell(0,10,'Desember',0,0);
            break;
        default:
        $pdf->Cell(0,10,'Tidak Terpilih',0,0);
        }
        $pdf->Cell(10,15,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFillColor(0,0,195);// set warna fill
        $pdf->SetTextColor(245,245,245); // set teks warna
        $pdf->SetDrawColor(255,255,255);
        $pdf->Cell(15,10,'No',1,0,'C',1);
        $pdf->Cell(80,10,'No. Transaksi',1,0,'C',1);
        $pdf->Cell(45,10,'Tanggal',1,0,'C',1);
        $pdf->Cell(45,10,'Subtotal (Rp.)',1,0,'C',1);
        $pdf->Cell(45,10,'Diskon (Rp.)',1,0,'C',1);
        $pdf->Cell(45,10,'Total (Rp.)',1,0,'C',1);
        $pdf->Cell(10,10,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetTextColor(74,74,74); // set warna
        $pdf->SetFont('Arial','',12);
        $no = 1;
        foreach ($tampil as $items){
            $pdf->SetFillColor(194,194,255);// set warna fill
            $pdf->Cell(15,10,$no++,1,0,'C',1);
            $pdf->Cell(80,10,$items->kd_transaksi,1,0,'L',1);
            $pdf->Cell(45,10,date('d-m-Y', strtotime($items->tanggal_transaksi)),1,0,'C',1);
            $pdf->Cell(45,10,number_format($items->subtotal, 0 , '' , '.' ),1,0,'R',1);
            $pdf->Cell(45,10,number_format($items->diskon, 0 , '' , '.' ),1,0,'R',1); 
            $pdf->Cell(45,10,number_format($items->total, 0 , '' , '.' ),1,1,'R',1); 
        }
        $pdf->SetFillColor(71,71,255);// set warna fill
        $pdf->SetTextColor(245,245,245); // set teks warna
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(140,10,'Grand Total',0,0,'C',1);
        $pdf->Cell(45,10,number_format($jumlah->subtotal, 0 , '' , '.' ),1,0,'R',1);
        $pdf->Cell(45,10,number_format($jumlah->diskon, 0 , '' , '.' ),1,0,'R',1);
        $pdf->Cell(45,10,number_format($jumlah->total, 0 , '' , '.' ),1,0,'R',1);
        $pdf->Cell(10,10,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat 
        $pdf->Cell(140,10,'',0,0,'C',1);
        $pdf->Cell(45,10,number_format($jumlah->subtotal, 0 , '' , '.' ),1,0,'C',1);
        $pdf->Cell(90,10,number_format($jumlah->total+$jumlah->diskon, 0 , '' , '.' ),1,0,'C',1);
        $pdf->Cell(10,10,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat 
       
        // end laporan transaksi
        
        $pdf->AddPage(); // membuat halaman baru
        $pdf->SetFont('Arial','B',18); // setting jenis font yang akan digunakan
        $pdf->SetTextColor(74,74,74); // set warna
        // mencetak string 
        $pdf->Cell(0,10,'LAPORAN PERBULAN',0,5,'C'); 
        $pdf->SetFont('Arial','B',16); // setting jenis font yang akan digunakan
        $pdf->Cell(0,10,'Riddessain',0,5,'C');
        $pdf->Cell(10,2,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(20,10,'Laporan Barang Terjual ',0,0,'L');
        $pdf->Cell(10,10,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(17,10,'Bulan :',0,0,'R');
        switch ($bulan) {
        case "01":
            $pdf->Cell(0,10,'Januari',0,0);
            break;
        case "02":
            $pdf->Cell(0,10,'Februari',0,0);
            break;
        case "03":
            $pdf->Cell(0,10,'Maret',0,0);
            break;
        case "04":
            $pdf->Cell(0,10,'April',0,0);
            break;
        case "05":
            $pdf->Cell(0,10,'Mei',0,0);
            break;
        case "06":
            $pdf->Cell(0,10,'Juni',0,0);
            break;
        case "07":
            $pdf->Cell(0,10,'Juli',0,0);
            break;
        case "08":
            $pdf->Cell(0,10,'Agustus',0,0);
            break;
        case "09":
            $pdf->Cell(0,10,'September',0,0);
            break;
        case "10":
            $pdf->Cell(0,10,'Oktober',0,0);
            break;
        case "11":
            $pdf->Cell(0,10,'November',0,0);
            break;
        case "12":
            $pdf->Cell(0,10,'Desember',0,0);
            break;
        default:
        $pdf->Cell(0,10,'Tidak Terpilih',0,0);
        }
        $pdf->Cell(10,15,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFillColor(0,0,195);// set warna fill
        $pdf->SetTextColor(245,245,245); // set teks warna
        $pdf->SetDrawColor(255,255,255);
        $pdf->Cell(15,10,'No',1,0,'C',1);
        $pdf->Cell(65,10,'Nama Barang',1,0,'C',1);
        $pdf->Cell(15,10,'Qty',1,0,'C',1);  
        $pdf->Cell(45,10,'Harga Beli (HB) (Rp.)',1,0,'C',1);       
        $pdf->Cell(45,10,'Harga Jual (HJ) (Rp.)',1,0,'C',1);       
        $pdf->Cell(45,10,'Subtotal (HB) (Rp.)',1,0,'C',1);        
        $pdf->Cell(45,10,'Subtotal (HJ) (Rp.)',1,0,'C',1);
        $pdf->Cell(10,10,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetTextColor(74,74,74); // set warna
        $pdf->SetFont('Arial','',12);
        $no = 1;
        foreach ($barang_terjual as $b){
            $pdf->SetFillColor(194,194,255);// set warna fill
            $pdf->Cell(15,10,$no++,1,0,'C',1);
            $pdf->Cell(65,10,$b->nama_barang,1,0,'L',1);
            $pdf->Cell(15,10,$b->jumlah,1,0,'C',1);  
            $pdf->Cell(45,10,number_format($b->harga_beli, 0 , '' , '.' ),1,0,'R',1);
            $pdf->Cell(45,10,number_format($b->harga_jual, 0 , '' , '.' ),1,0,'R',1);
            $pdf->Cell(45,10,number_format($b->harga_beli*$b->jumlah, 0 , '' , '.' ),1,0,'R',1);             
            $pdf->Cell(45,10,number_format($b->sub_harga_jual, 0 , '' , '.' ),1,1,'R',1); 
        }
        $pdf->SetFillColor(71,71,255);// set warna fill
        $pdf->SetTextColor(245,245,245); // set teks warna
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(80,10,'Grand Total',1,0,'C',1);
        $pdf->Cell(15,10,$j->jumlah,1,0,'C',1);        
        $pdf->Cell(45,10,number_format($j->harga_beli, 0 , '' , '.' ),1,0,'R',1);
        $pdf->Cell(45,10,number_format($j->harga_jual, 0 , '' , '.' ),1,0,'R',1);
        $pdf->Cell(45,10,number_format($j->sub_harga_beli, 0 , '' , '.' ),1,0,'R',1);         
        $pdf->Cell(45,10,number_format($j->sub_harga_jual, 0 , '' , '.' ),1,0,'R',1); 
        $pdf->Cell(10,10,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat 
        $pdf->Cell(185,10,'Profit Penjualan',0,0,'C',1);
        $pdf->Cell(90,10,number_format($j->sub_harga_jual-$j->sub_harga_beli, 0 , '' , '.' ),1,0,'C',1);
        $pdf->Cell(10,10,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat 
       
        // $pdf->Cell(50,3,'=========================================================================',0,1,'C');
        // $pdf->SetFont('Arial','B',4); // setting jenis font yang akan digunakan
        // // mencetak string 
        // $pdf->Cell(0,2,'Terimakasih sudah berbelanja di kami.',0,1,'C'); 
        $pdf->Output();
    }
    
   
    
 

}
