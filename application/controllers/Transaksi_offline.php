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
            'discount' => $data->discount,
            
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
            $total_discount = $items['discount'] * $items["qty"];
			$row = [];
			$row[] = $no;
			$row[] = $items["name"];
			$row[] = 'Rp. ' . number_format( $items['price'], 0 , '' , '.' );
			$row[] = '<b id="'.$items['id'].'">'.$items["qty"].'</b>';
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
		echo $data->stok;
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

        // $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        // $shuffle  = substr(str_shuffle($karakter), 0, 3);        
        // $no_transaksi = $shuffle.'/'.$singkatan.'/'.date('dmyHis');
        
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
        
        $seqmax = $this->m_transaksi_offline->get_seqmax(); 
        $fid_sales = $seqmax->seq;        

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
        //     $pdf = new FPDF('P','mm',array(90,70)); //SETTING UKURAN KERTAS DI DALAM ARRAY        
        //     $pdf->AddPage(); // membuat halaman baru
        //     $pdf->SetFont('Arial','B',6); // setting jenis font yang akan digunakan
        //     // mencetak string 
        //     $pdf->Cell(0,2,$company_name,0,1,'C'); 
        //     $pdf->SetFont('Arial','B',4); // setting jenis font yang akan digunakan
        //     $pdf->Cell(0,3,$company_address,0,1,'C');
        //     $pdf->Cell(5,2,'',0,1); // Memberikan space kebawah agar tidak terlalu rapat
        //     $pdf->SetFont('Arial','B',4);
        //     $pdf->Cell(6,3,'Kasir:',0,0,'L');
        //     $pdf->Cell(27,3,'',0,0);
        //     $pdf->Cell(6,3,'Tgl :',0,0,'L');
        //     $pdf->Cell(10,3,$tanggal,0,1,'R');
        //     $pdf->Cell(6,3,$cname,0,0,'L');
        //     $pdf->Cell(27,3,'',0,0);
        //     // $pdf->Cell(27,3,'Ridwan',0,0);
        //     $pdf->Cell(6,3,'Waktu :',0,0,'L');
        //     $pdf->Cell(10,3,$waktu,0,1,'R');
        //     $pdf->Cell(50,3,'=========================================================================',0,1,'C');
        //     $pdf->SetFont('Arial','B',4);
        //     $pdf->Cell(25,3,'Nama Product',0,0);
        //     $pdf->Cell(5,3,'qty',0,0,'C');
        //     $pdf->Cell(10,3,'Harga',0,0,'C');
        //     $pdf->Cell(10,3,'Subtotal',0,1,'C');
        //     $pdf->Cell(50,3,'-------------------------------------------------------------------------------------------------------',0,1,'C'); 
        //     $pdf->SetFont('Arial','B',4);
        //     foreach ($this->cart->contents() as $items){
        //         $pdf->Cell(25,4,$items["name"],0,0);
        //         $pdf->Cell(5,4,$items["qty"],0,0,'C');
        //         $pdf->Cell(10,4,number_format( $items['price'], 0 , '' , '.' ),0,0,'R');
        //         $pdf->Cell(10,4,number_format( $items['subtotal'], 0 , '' , '.' ),0,1,'R'); 
        //     }
        //     // total
        //     $pdf->Cell(50,1,'-------------------------------------------------------------------------------------------------------',0,1,'C'); 
        //     $pdf->SetFont('Arial','B',4);
        //     $pdf->Cell(20,3,'',0,0);
        //     $pdf->Cell(5,3,'',0,0,'C');
        //     $pdf->Cell(10,3,'Subtotal :',0,0,'L');
        //     $pdf->Cell(15,3,'Rp. '.number_format(10000000, 0 , '' , '.' ),0,1,'R'); 
        //     $pdf->Cell(20,3,'',0,0);
        //     $pdf->Cell(5,3,'',0,0,'C');
        //     $pdf->Cell(10,3,'Diskon :',0,0,'L');
        //     $pdf->Cell(15,3,'Rp. '.number_format($discount, 0 , '' , '.' ),0,1,'R');
        //     $pdf->Cell(20,3,'',0,0);
        //     $pdf->Cell(5,3,'',0,0,'C');
        //     $pdf->Cell(10,3,'Total :',0,0,'L');
        //     $pdf->Cell(15,3,'Rp. '.number_format(10000000, 0 , '' , '.' ),0,1,'R');  
        //     $pdf->Cell(20,3,'',0,0);
        //     $pdf->Cell(5,3,'',0,0,'C');
        //     $pdf->Cell(10,3,'Tunai :',0,0,'L');
        //     $pdf->Cell(15,3,'Rp. '.number_format($convertCash, 0 , '' , '.' ),0,1,'R');
        //     $pdf->Cell(50,3,'-------------------------------------------------------------------------------------------------------',0,1,'C'); 
        //     $pdf->Cell(20,3,'',0,0);
        //     $pdf->Cell(5,3,'',0,0,'C');
        //     $pdf->Cell(10,3,'Kembali :',0,0,'L');
        //     $pdf->Cell(15,3,'Rp. '.number_format($convertChanges, 0 , '' , '.' ),0,1,'R');
        
        //     $pdf->Cell(50,3,'=========================================================================',0,1,'C');
        //     $pdf->SetFont('Arial','B',4); // setting jenis font yang akan digunakan
        //     // mencetak string 
        //     $pdf->Cell(0,2,'Terimakasih sudah berbelanja.',0,1,'C'); 
        //     $pdf->Output();
    }
    
 

}
