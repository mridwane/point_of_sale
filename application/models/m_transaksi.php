<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_transaksi extends CI_Model {

    function save_transaksi($data)
    {
        $result=$this->db->insert('transaksi',$data);
        return $result;
    }

    function save_detailTransaksi($data1)
    {
        $result=$this->db->insert('detail_transaksi',$data1);
        return $result;
    }

    public function list_penjualan($tanggal)
    {
        $this->db->select('b.nama_barang');
        $this->db->select_sum('dt.jumlah');
        $this->db->from('detail_transaksi as dt');
        $this->db->join('barang as b', 'b.kd_barang = dt.kd_barang');
        $this->db->join('transaksi as t', 't.kd_transaksi = dt.kd_transaksi');
        $this->db->where('t.tanggal_transaksi', $tanggal);
        $this->db->group_by('b.nama_barang');
        $hasil = $this->db->get();
        return $hasil->result();
    }

    function laporan_transaksi($bulan)
    {
        $this->db->where('MONTH(tanggal_transaksi)', $bulan);
        return $this->db->get('Transaksi')->result(); 
    }

    public function jumlah($bulan)
    {
        $this->db->select_sum('subtotal');
        $this->db->select_sum('diskon');
        $this->db->select_sum('total');
        $this->db->where('MONTH(tanggal_transaksi)', $bulan);
        $result = $this->db->get('transaksi')->row();
        return $result;
    }

    public function barang_terjual($bulan)
    {
        $this->db->select('b.nama_barang, b.harga_jual, b.harga_beli');
        $this->db->select_sum('dt.sub_harga_jual');
        $this->db->select_sum('dt.jumlah');
        $this->db->from('detail_transaksi as dt');
        $this->db->join('barang as b', 'b.kd_barang = dt.kd_barang');
        $this->db->join('transaksi as t', 't.kd_transaksi = dt.kd_transaksi');
        $this->db->where('MONTH(t.tanggal_transaksi)', $bulan);
        $this->db->group_by('b.nama_barang');
        $hasil = $this->db->get();
        return $hasil->result();
    }

    public function jumlah_barang_terjual($bulan)
    {

        $this->db->select_sum('b.harga_jual');
        $this->db->select_sum('b.harga_beli');
        $this->db->select_sum('dt.sub_harga_beli');
        $this->db->select_sum('dt.sub_harga_jual');
        $this->db->select_sum('dt.jumlah');
        $this->db->from('detail_transaksi as dt');
        $this->db->join('barang as b', 'b.kd_barang = dt.kd_barang');
        $this->db->join('transaksi as t', 't.kd_transaksi = dt.kd_transaksi');
        $this->db->where('MONTH(t.tanggal_transaksi)', $bulan);
        $hasil = $this->db->get()->row();
        return $hasil;
    }

    public function total_transaksi()
    {
        $sekarang = date('Y-m-d');
        $this->db->select('COUNT(kd_transaksi) as total_transaksi');
        $this->db->where('tanggal_transaksi', $sekarang);
        $hasil = $this->db->get('transaksi');
        return $hasil->result();
    }

    public function total_barang_terjual()
    {
        $sekarang = date('Y-m-d');
        
        $this->db->select_sum('dt.jumlah');
        $this->db->from('detail_transaksi as dt');
        $this->db->join('transaksi as t', 't.kd_transaksi = dt.kd_transaksi');
        $this->db->where('t.tanggal_transaksi', $sekarang);
        $hasil = $this->db->get()->row();
        return $hasil;
    }

    public function list_barang_terjual()
    {
        $kemarin = date('Y-m-d', strtotime("-4 day", strtotime(date("Y-m-d"))));

        $this->db->select('b.nama_barang, k.nama_kategori, dt.jumlah');
        $this->db->select_sum('dt.sub_harga_beli', 'total');
        $this->db->from('detail_transaksi as dt');        
        $this->db->join('barang as b', 'b.kd_barang = dt.kd_barang');
        $this->db->join('transaksi as t', 't.kd_transaksi = dt.kd_transaksi');
        $this->db->join('kategori as k', 'k.kd_kategori = b.kd_kategori');
        $this->db->where('t.tanggal_transaksi', $kemarin);
        $this->db->order_by('dt.jumlah', 'DESC');
        $this->db->limit('5');
        $this->db->group_by('b.nama_barang');
        $hasil = $this->db->get();
        return $hasil->result();
    }

    public function cek_penjualan($tanggal)
    {
        $this->db->where('tanggal_transaksi',$tanggal);
        $query = $this->db->get('transaksi');
        return $query->num_rows();
    }
    

}
?>