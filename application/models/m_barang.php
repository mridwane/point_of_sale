<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_barang extends CI_Model {

    var $table = 'barang as b'; //nama tabel dari database
    var $column_order = array(null, 'b.kd_barang','b.nama_barang','k.nama_kategori','b.harga_beli','b.harga_jual','b.stok'); //field yang ada di table user
    var $column_search = array('b.nama_barang','k.nama_kategori','b.stok'); //field yang diizin untuk pencarian 
    var $order = array('b.nama_barang' => 'asc'); // default order 

    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
        $this->db->join('kategori as k', 'k.kd_kategori = b.kd_kategori');
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_nama($nama)
    {
        $this->db->where('nama_barang',$nama);
        $query = $this->db->get('barang');
        return $query->num_rows();
    }

    public function get_barang($kd_barang)
    {
        $this->db->where('kd_barang',$kd_barang);
        $result = $this->db->get('barang')->row();
        return $result;
    }

    public function get_kd_barang($kd_barang)
    {
        $this->db->where('kd_barang',$kd_barang);
        $query = $this->db->get('barang');
        return $query->num_rows();
    }

    public function add_stok($kd_barang)
    {
        $this->db->where('kd_barang',$kd_barang);
        $result=$this->db->insert('barang',$data);
        return $result;
    }

    function ambil_barang(){
        $this->db->order_by('nama_barang', 'ASC');
        $query = $this->db->get('barang');
        return $query;  
    }

    function cek_stok(){
        $this->db->where('stok <', 5);
        $query = $this->db->get('barang')->row();
        return $query;  
    }
    function cek_stok_habis(){
        $this->db->where('stok <', 1);
        $query = $this->db->get('barang')->row();
        return $query;  
    }
 
    function add_barang($data)
    {
        $result=$this->db->insert('barang',$data);
        return $result;
    }

    function barang_masuk($data1)
    {
        $result=$this->db->insert('barang_masuk',$data1);
        return $result;
    }
 
    function update_barang($data,$kd_barang)
    {
        $this->db->set($data);
        $this->db->where('kd_barang', $kd_barang);
        $result=$this->db->update('barang');
        return $result;
    }

    function update_stok($stok,$kd_barang)
    {
        $this->db->set($data);
        $this->db->where('kd_barang', $kd_barang);
        $result=$this->db->update('barang');
        return $result;
    }
 
    function delete_barang($kd_barang)
    {        
        $this->db->where('kd_barang', $kd_barang);
        $result=$this->db->delete('barang');
        return $result;
    }

    function laporan_barang_masuk($tgl_mulai,$tgl_akhir)
    {
        $this->db->where('tanggal >=', $tgl_mulai);
        $this->db->where('tanggal <=', $tgl_akhir);
        $this->db->join('barang ', 'barang.kd_barang = barang_masuk.kd_barang');
        return $this->db->get('barang_masuk')->result(); 
    }

    public function laporan_barang()
    {
        $this->db->select('*');
        $this->db->from('barang as b');
        $this->db->join('kategori as k', 'k.kd_kategori = b.kd_kategori');
        $hasil = $this->db->get();
        return $hasil->result();
    }

    public function stok_menipis()
    {
        $this->db->where('stok <=', 10);
        $result = $this->db->get('barang');
        return $result->result();
    }

    

}
?>