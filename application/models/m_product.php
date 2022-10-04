<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_product extends CI_Model {

    var $table = 'wsproduct as p'; //nama tabel dari database
    var $column_order = array(null, 'p.cname','pt.cname','p.price','p.qty_stock','u.cname','s.cname'); //field yang ada di table product
    var $column_search = array('p.cname'); //field yang diizin untuk pencarian 
    var $order = array('p.cname' => 'asc'); // default order 

    private function _get_datatables_query()
    {
        $this->db->select('p.cname as product_name, pt.cname as product_type_name, p.price, p.qty_stock, u.cname as uom_name, s.cname as status');
        $this->db->from($this->table);
        $this->db->join('wsproduct_type as pt', 'pt.ccode = p.fid_type');        
        $this->db->join('wsuom as u', 'u.ccode = p.fid_uom');       
        $this->db->join('wsstatus_product as s', 's.ccode = p.fid_status');
                
        
        
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

    // public function get_nama($cname)
    // {
    //     $this->db->where('cname',$cname);
    //     $query = $this->db->get($this->table);
    //     return $query->num_rows();
    // }

    // public function get_barang($ccode)
    // {
    //     $this->db->where('ccode',$ccode);
    //     $result = $this->db->get($this->table)->row();
    //     return $result;
    // }

    // public function get_ccode($ccode)
    // {
    //     $this->db->where('ccode',$ccode);
    //     $query = $this->db->get($this->table);
    //     return $query->num_rows();
    // }

    // function cek_stok(){
    //     $this->db->where('stok <', 5);
    //     $query = $this->db->get($this->table)->row();
    //     return $query;  
    // }
    // function cek_stok_habis(){
    //     $this->db->where('stok <', 1);
    //     $query = $this->db->get($this->table)->row();
    //     return $query;  
    // }

    // public function stok_menipis()
    // {
    //     $this->db->where('stok <=', 10);
    //     $result = $this->db->get($this->table);
    //     return $result->result();
    // }

    // public function add_stok($ccode)
    // {
    //     $this->db->where('ccode',$ccode);
    //     $result=$this->db->insert($this->table,$data);
    //     return $result;
    // }

    // function ambil_barang(){
    //     $this->db->order_by('nama_barang', 'ASC');
    //     $query = $this->db->get('barang');
    //     return $query;  
    // }

    
 
    // function add_barang($data)
    // {
    //     $result=$this->db->insert('barang',$data);
    //     return $result;
    // }

    // function barang_masuk($data1)
    // {
    //     $result=$this->db->insert('barang_masuk',$data1);
    //     return $result;
    // }
 
    // function update_barang($data,$ccode)
    // {
    //     $this->db->set($data);
    //     $this->db->where('ccode', $ccode);
    //     $result=$this->db->update('barang');
    //     return $result;
    // }

    // function update_stok($stok,$ccode)
    // {
    //     $this->db->set($data);
    //     $this->db->where('ccode', $ccode);
    //     $result=$this->db->update('barang');
    //     return $result;
    // }
 
    // function delete_barang($ccode)
    // {        
    //     $this->db->where('ccode', $ccode);
    //     $result=$this->db->delete('barang');
    //     return $result;
    // }

    // function laporan_barang_masuk($tgl_mulai,$tgl_akhir)
    // {
    //     $this->db->where('tanggal >=', $tgl_mulai);
    //     $this->db->where('tanggal <=', $tgl_akhir);
    //     $this->db->join('barang ', 'barang.ccode = barang_masuk.ccode');
    //     return $this->db->get('barang_masuk')->result(); 
    // }

    // public function laporan_barang()
    // {
    //     $this->db->select('*');
    //     $this->db->from('barang as b');
    //     $this->db->join('kategori as k', 'k.kd_kategori = b.kd_kategori');
    //     $hasil = $this->db->get();
    //     return $hasil->result();
    // }

    

    

}
?>