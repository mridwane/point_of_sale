<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_transaksi_offline extends CI_Model {

    function save_transaksi($wssales)
    {
        $result=$this->db->insert('wssales',$wssales);
        return $result;
    }

    function save_detail_transaksi($wssales_detail)
    {
        $result=$this->db->insert('wssales_detail',$wssales_detail);
        return $result;
    }

    public function check_seqmax()
    {
        $query = $this->db->get('wssales');
        return $query->num_rows();
    }

    public function get_seqmax()
    {
        $this->db->select_max('seq');
        $query = $this->db->get('wssales');
        return $query->row();
    }

    public function cek_penjualan($tanggal)
    {
        $this->db->where('cdate',$tanggal);
        $query = $this->db->get('wssales');
        return $query->num_rows();
    }

    public function list_penjualan($tanggal)
    {
        $this->db->select('p.cname');
        $this->db->select_sum('sd.qty');
        $this->db->from('wssales_detail as sd');
        $this->db->join('wsproduct as p', 'p.ccode = sd.fid_product');
        $this->db->join('wssales as s', 's.seq = sd.fid_sales');
        $this->db->where('s.cdate', $tanggal);
        $this->db->group_by('p.cname');
        $hasil = $this->db->get();
        return $hasil->result();
    }

    public function list_transaksi($tanggal)
    {
        $this->db->select('*');
        $this->db->from('wssales');
        $this->db->where('cdate', $tanggal);
        $hasil = $this->db->get();
        return $hasil->result();
    }

    public function total_sales()
    {
        $now = date('Y-m-d');
        $this->db->select('COUNT(seq) as total_sales');
        $this->db->where('cdate', $now);
        $hasil = $this->db->get('wssales');
        return $hasil->result();
    }    

    public function total_barang_terjual()
    {
        $now = date('Y-m-d');        
        $this->db->select_sum('sd.qty');
        $this->db->from('wssales_detail as sd');
        $this->db->join('wssales as s', 's.seq = sd.fid_sales');
        $this->db->where('s.cdate', $now);
        $hasil = $this->db->get()->row();
        return $hasil;
    }

    public function list_barang_terjual()
    {
        $kemarin = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));

        $this->db->select('p.cname');
        $this->db->select_sum('sd.qty');
        $this->db->from('wssales_detail as sd');
        $this->db->join('wsproduct as p', 'p.ccode = sd.fid_product');
        $this->db->join('wssales as s', 's.seq = sd.fid_sales');
        $this->db->where('s.cdate', $kemarin);        
        $this->db->order_by('sd.qty', 'DESC');
        $this->db->limit('5');
        $this->db->group_by('p.cname');
        $hasil = $this->db->get();
        return $hasil->result();
    }

    var $table = 'wssales'; //nama tabel dari database
    var $column_order = array(null, 'seq','cdate'); //field yang ada di table product
    var $column_search = array('seq'); //field yang diizin untuk pencarian 
    var $order = array('seq' => 'Desc'); // default order 

    private function _get_datatables_query()
    {
        $this->db->from($this->table);  
        
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

    public function get_sales($seq)
    {
        $this->db->select('p.cname as product_name, sd.qty as qty, sd.price as price, sd.sub_discount as disc, sd.sub_total, s.total as total, s.paid as paid, s.refund as refund');
        $this->db->from('wssales_detail as sd');
        $this->db->join('wssales as s', 's.seq = sd.fid_sales');
        $this->db->join('wsproduct as p', 'p.ccode = sd.fid_product');
        $this->db->where('s.seq',$seq);
        $query = $this->db->get();
        return $query->result();
    }

    
    

}
?>