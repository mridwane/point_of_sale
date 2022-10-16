<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_offline extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('m_product');
        $this->load->model('m_member');
        $this->load->model('m_transaksi_offline');
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
        view('TransaksiOffline/v_transaksi_offline', $data);
    }

    public function add_cart()
    {
        $barcode = html_escape($this->input->post('kd_barang'));
        $data = $this->m_product->get_product($barcode);
        $data1 = array(
            'id' => $data->ccode,
            'name' => $data->cname,
            'qty'     => 1,
            'price'   => $data->price,
            'barcode' => $data->barcode,
            'discount' => $data->discount,
            
        );

        $insert = $this->cart->insert($data1);
		echo json_encode($insert);
    }

    public function remove_item()
    {
        //$rowid = $this->input->post('kd_barang'); -- test
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
            $total_discount = $items['discount'] * $items["qty"];
			$row = [];
			$row[] = $no;
			$row[] = $items["name"];
			$row[] = 'Rp. ' . number_format( $items['price'], 0 , '' , '.' );
			$row[] = '<b id="'.$items['barcode'].'">'.$items["qty"].'</b>';
            $row[] = 'Rp. ' . number_format( $items['discount'], 0 , '' , '.' );
            $row[] = 'Rp. ' . number_format( $total_discount, 0 , '' , '.' );
            $row[] = 'Rp. ' . number_format( $items['subtotal'] - $total_discount, 0 , '' , '.' );
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

    function show_subtotal(){ //Fungsi untuk menampilkan Cart
        $output = '';
        $output .= '<input type="text" class="form-control custom-radius custom-shadow text-14" maxlength="25" id="subtotalval" readonly value="Rp. '.number_format($this->cart->total(), 0 , '' , '.' ).'">';
        return $output;
    }
 
    function load_subtotal(){ //load data cart
        echo $this->show_subtotal();
    }

    function show_grandtotal(){ //Fungsi untuk menampilkan Cart
        $total_discount = 0;
        foreach ($this->cart->contents() as $items){
            
            $total_discount += $items['discount'] * $items["qty"];
            // $gd = $gd + $total_discount;
        }
        $subtotal = $this->cart->total();
        $gp = $subtotal - $total_discount;

        $output = '';
        $output .= '<input type="number" id="pay" value="'.$gp.'" hidden><h1 class="text-dark float-right font-weight-bold">Rp. '.number_format($gp, 0 , '' , '.' ).'</h1>';
        return $output;
    }
 
    function load_grandtotal(){ //load data cart
        echo $this->show_grandtotal();
    }

    function show_discount(){ //Fungsi untuk menampilkan Cart
        $total_discount = 0;
        foreach ($this->cart->contents() as $items){
            
            $total_discount += $items['discount'] * $items["qty"];
            // $gd = $gd + $total_discount;
        }
            $output = '';
            $output .= '<input type="text" class="form-control custom-radius custom-shadow text-14" maxlength="25" id="discountval" readonly value="Rp. '.number_format($total_discount, 0 , '' , '.' ).'">';
            return $output;
    }
 
    function load_discount(){ //load data cart
        echo $this->show_discount();
    }


    public function cek_stok()
    {
        $ccode = html_escape($this->input->post('kd_barang'));
		$data = $this->m_product->get_product($ccode);
		$stock = $data->qty_stock;
        $buffer = $data->qty_buffer;
        $results = $stock - $buffer;
        echo $results;
    }

    public function get_member()
    {
        $member_number = html_escape($this->input->post('member_number'));
		$member = $this->m_member->get_member($member_number);
		// echo $data->stok;
        $data = array(
            'member_id' => $member->member_id,
            'member_name'   => $member->member_name,
            'member_area' => $member->member_area,
        );
        echo json_encode($data);
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
        $cname = $this->session->userdata('cname');
        $company_name = $this->session->userdata('company_name');
        $company_address = $this->session->userdata('company_address');
        date_default_timezone_set('Asia/Jakarta');
        $tanggalDB = date('Y-m-d');
        $tanggal = date('d/m/y');
        $waktu = date('H:i:s');
        $ufd = date("Y-m-d H:i:s");
        $tgl_struk = date("d-m-Y H:i:s");
        
        $checkMemberID = $this->input->post('memberId');
        if (empty($checkMemberID)){
            $memberId = NULL;
            $paymentType = 1;
        }
        else {
            $memberId = $this->input->post('memberId');
            $paymentType = 2;
        }
        $cash = $this->input->post('cash');
        $convertCash = str_replace(".","",str_replace("Rp.", "", $cash));        
        $changes = $this->input->post('changes');
        $convertChanges = str_replace(".","",str_replace("Rp.", "", $changes));
        $amount = $this->cart->total();
        $qty_rows = count($this->cart->contents());
        $discount = 0;        
        foreach ($this->cart->contents() as $i)
        {
            $discount += $i['discount'] * $i["qty"];
            $total = $amount - $discount;           
        }     
        
        // simpan ke wssales
        $wssales = array(            
            'cdate'  => $tanggalDB, 
            'fid_member' => $memberId,
            'fid_status'  => 9, 
            'fid_payment'  => $paymentType, 
            'amount' => $amount,
            'discount'  => $discount, 
            'total'  => $total, 
            'paid' => $convertCash,
            'refund' => $convertChanges,
            'qty' => $qty_rows,
            'ufc' => $cname,
            'ufd' => $ufd,
        );
        $transac_save = $this->m_transaksi_offline->save_transaksi($wssales);
        $fid_sales = $this->db->insert_id();     

        // simpan ke wssales_detail
        foreach ($this->cart->contents() as $item)
        {
            $sub_amount = $item['price']*$item['qty'];
            $sub_discount = $item['discount']*$item['qty'];
            $sub_total = $sub_amount-$sub_discount;

            $wssales_detail = array(
                'fid_sales' => $fid_sales,
                'fid_product' => (int)$item['id'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'sub_amount' => $sub_amount,
                'sub_discount' => $sub_discount,
                'sub_total' => $sub_total,
                'ufc' => $cname,
                'ufd' => $ufd,
            );
            $this->m_transaksi_offline->save_detail_transaksi($wssales_detail);
        }

        // cetak struk
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
        $printer->text("No.Trans : ".$fid_sales."\n");
        $printer->text("Cashier : ".$cname."\n");
        $printer->text("Date : ".$tgl_struk."\n");        

        // Membuat tabel
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->selectPrintMode(Escpos\Printer::MODE_FONT_B);
        $printer->text("------------------------------------------\n");
        $printer->text(buatBaris5Kolom("Product", "Qty", "Price", "Disc", "Subtotal"));
        $printer->text("------------------------------------------\n");

        $total_discount = 0;
        foreach ($this->cart->contents() as $a)
        {
            $total_discount_prod = $a['discount'] * $a["qty"];
            $total_discount += $a['discount'] * $a["qty"];
            $sub_total = $a['subtotal'] - $total_discount_prod;
            $printer->text(buatBaris5Kolom($a['name'], $a['qty'], $a['price'], $total_discount_prod, $sub_total));
        }

        $subtotal = $this->cart->total();
        $gp = $subtotal - $total_discount;
        
        $printer->text("------------------------------------------\n");
        $printer->text(buatBaris5Kolom('', '', '', "Total", $gp));
        $printer->text(buatBaris5Kolom('', '', '', "Cash", $convertCash));
        $printer->text(buatBaris5Kolom('', '', '', "Refund", $convertChanges));
        $printer->text("\n");

         // Pesan penutup
        $printer->initialize();
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text("Terima kasih telah berbelanja\n");

        $printer->feed(3); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)
        $printer->close();
    }
    
    

}
