<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTransaksi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('m_transaksi_offline');
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
            'sub_title' => "Data Transaksi",
		);
        view('DataMaster/v_transaksi_list', $data);
    }

    public function cek_transaksi()
	{         
		$tanggal = html_escape($this->input->post('tanggal'));
		$cekTransaksi = $this->m_transaksi_offline->cek_penjualan($tanggal);
		if ($cekTransaksi > 0)
		{
			echo "ada";
		}
    }

    function get_data_transaksi()
    {
        $list = $this->m_transaksi_offline->get_datatables();
        $data = array();
        $no = 1;
        foreach ($list as $field) {
            $row = array();
            $row[] = $no++;
            $row[] = $field->seq;
            $row[] = $field->cdate;
            $row[] = '<input type="button" class="btn btn-primary btn-rounded receipt" data-seq="'.$field->seq.'" value="Print Struk">
                        <input type="button" class="btn btn-warning btn-rounded pdf"  data-seq="'.$field->seq.'" target="_blank" value="Download PDF">';
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_transaksi_offline->count_all(),
            "recordsFiltered" => $this->m_transaksi_offline->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function print_receipt(){
        // varible data
        $cname = $this->session->userdata('cname');
        $company_name = $this->session->userdata('company_name');
        $company_address = $this->session->userdata('company_address');
        $tgl_struk = date("d-m-Y H:i:s");
        $seq = html_escape($this->input->post('seq'));
        $sales = $this->m_transaksi_offline->get_sales($seq);

        // me-load library escpos
        $this->load->library('escpos');

        // membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
        $connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS58");

        // membuat objek $printer agar dapat di lakukan fungsinya
        $printer = new Escpos\Printer($connector);        

        // membuat fungsi untuk membuat 1 baris tabel, agar dapat dipanggil berkali-kali dgn mudah
        function buatBaris5Kolom($kolom1, $kolom2, $kolom3, $kolom4, $kolom5) {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 12;
            $lebar_kolom_2 = 4;
            $lebar_kolom_3 = 7;
            $lebar_kolom_4 = 6;
            $lebar_kolom_5 = 9;

            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
            $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);
            $kolom5 = wordwrap($kolom5, $lebar_kolom_5, "\n", true);

            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);
            $kolom4Array = explode("\n", $kolom4);
            $kolom5Array = explode("\n", $kolom5);

            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array), count($kolom5Array));

            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();

            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");

                // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
                $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);
                $hasilKolom5 = str_pad((isset($kolom5Array[$i]) ? $kolom5Array[$i] : ""), $lebar_kolom_5, " ", STR_PAD_LEFT);

                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4 . " " . $hasilKolom5;
            }

            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode("\n", $hasilBaris) . "\n";
        }   

        // Membuat judul
        $printer->initialize();
        $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
        $printer->text($company_name."\n");
        $printer->initialize();
        $printer->text($company_address."\n");
        $printer->text("\n");

        // Data transaksi
        $printer->initialize();
        $printer->text("No.Trans : ".$seq."\n");
        $printer->text("Cashier : ".$cname."\n");
        $printer->text("Date : ".$tgl_struk."\n");        

        // Membuat tabel
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->selectPrintMode(Escpos\Printer::MODE_FONT_B);
        $printer->text("------------------------------------------\n");
        $printer->text(buatBaris5Kolom("Product", "Qty", "Price", "Disc", "Subtotal"));
        $printer->text("------------------------------------------\n");

        foreach ($sales as $item)
        {
            $printer->text(buatBaris5Kolom($item->product_name, $item->qty, intval($item->price), intval($item->disc), intval($item->sub_total)));
            
            $total = intval($item->total);
            $paid = intval($item->paid);
            $refund = intval($item->refund);
        }

        // $subtotal = $this->cart->total();
        // $gp = $subtotal - $total_discount;
        
        $printer->text("------------------------------------------\n");
        $printer->text(buatBaris5Kolom('', '', '', "Total", $total));
        $printer->text(buatBaris5Kolom('', '', '', "Cash", $paid));
        $printer->text(buatBaris5Kolom('', '', '', "Refund", $refund));
        $printer->text("\n");

         // Pesan penutup
        $printer->initialize();
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text("Terima kasih telah berbelanja\n");

        $printer->feed(3); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)
        $printer->close();
    }

    public function images_pdf() {
        $this->load->library('pdf');
        $pdf = new FPDF(); //SETTING UKURAN KERTAS DI DALAM ARRAY   
        $pdf->AddPage(); 
        $pdf->Image(base_url().'assets/images/logo.png', 10, 10); 
        $pdf->Output();
    }

    public function receipt_pdf(){

        $this->load->library('pdf');

        $cname = $this->session->userdata('cname');
        $company_name = $this->session->userdata('company_name');
        $company_address = $this->session->userdata('company_address');
        $tgl_struk = date("d-m-Y H:i:s");
        $seq = html_escape($this->input->post('seq'));
        $sales = $this->m_transaksi_offline->get_sales($seq);
        $pdf = new FPDF('P','mm',array(58,100)); //SETTING UKURAN KERTAS DI DALAM ARRAY        
        $pdf->SetMargins(5, 5);
        $pdf->AddPage(); // membuat halaman baru
        $pdf->SetFont('Arial','B',6); // setting jenis font yang akan digunakan
        // mencetak string 
        $pdf->Image(base_url().'assets/images/logo1.png', 5, 5, -1200);         
        $pdf->Cell(0,2,$company_name,0,1,'C');
        $pdf->Cell(2,2,'',0,1);
        $pdf->SetFont('Arial','B',5); // setting jenis font yang akan digunakan
        $pdf->Cell(0,3,$company_address,0,1,'C');
        $pdf->Cell(5,2,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(15,5,'No.Trans :',0,0,'L');
        $pdf->Cell(27,5,$seq,0,1);
        $pdf->Cell(15,5,'Cashier :',0,0,'L');
        $pdf->Cell(27,5,$cname,0,1);
        $pdf->Cell(15,5,'Date :',0,0,'L');
        $pdf->Cell(27,5,$tgl_struk,0,1,'L');
        $pdf->Cell(5,2,'',0,1);
        $pdf->Cell(54,3,'-------------------------------------------------------------------------------------------------',0,1,'C');
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(14,3,'Product',0,0);
        $pdf->Cell(6,3,'Qty',0,0,'C');
        $pdf->Cell(10,3,'Price',0,0,'R');
        $pdf->Cell(10,3,'Disc',0,0,'R');
        $pdf->Cell(10,3,'Subtotal',0,1,'R');
        $pdf->Cell(54,3,'-------------------------------------------------------------------------------------------------',0,1,'C'); 
        $pdf->SetFont('Arial','B',7);

        $total = 0;
        $paid = 0;
        $refund = 0;
        foreach ($sales as $item){
            $pdf->Cell(14,5,$item->product_name,0,0);
            $pdf->Cell(6,5,$item->qty,0,0,'C');
            $pdf->Cell(10,5,intval($item->price),0,0,'R');
            $pdf->Cell(10,5,intval($item->disc),0,0,'R');
            $pdf->Cell(10,5,intval($item->sub_total),0,1,'R');

            $total = intval($item->total);
            $paid = intval($item->paid);
            $refund = intval($item->refund);
        }
        // total
        $pdf->Cell(54,3,'-------------------------------------------------------------------------------------------------',0,1,'C'); 
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(14,5,'',0,0);
        $pdf->Cell(6,5,'',0,0);
        $pdf->Cell(10,5,'',0,0,'C');
        $pdf->Cell(10,5,'Total',0,0,'R');
        $pdf->Cell(10,5,$total,0,1,'R');
        $pdf->Cell(14,5,'',0,0);
        $pdf->Cell(6,5,'',0,0);
        $pdf->Cell(10,5,'',0,0,'C');
        $pdf->Cell(10,5,'Cash',0,0,'R');
        $pdf->Cell(10,5,$paid,0,1,'R');
        $pdf->Cell(14,5,'',0,0);
        $pdf->Cell(6,5,'',0,0);
        $pdf->Cell(10,5,'',0,0,'C');
        $pdf->Cell(10,5,'Refund',0,0,'R');
        $pdf->Cell(10,5,$refund,0,1,'R');
        $pdf->SetFont('Arial','B',6); // setting jenis font yang akan digunakan
        // mencetak string 
        $pdf->Cell(8,2,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(0,2,'Terima kasih telah berbelanja.',0,1,'C'); 
        $pdf->Output('I', "Receipt_$seq.pdf", true);
        // $pdf->Output();
    }

   

}