<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_users extends CI_Model {

    public function get_clogin($clogin)
    {
        $this->db->where('clogin',$clogin);
        $query = $this->db->get('zuser');
        return $query->num_rows();
    }

    // public function register($user)
    // {
    //     return $this->db->insert('zuser', $user);
    // }

    public function get_users($clogin)
    {
        $this->db->where('clogin',$clogin);
        $result = $this->db->get('zuser')->row();
        return $result;
    }

    public function update_status($status, $clogin)
    {
        $this->db->set('status', $status);
        $this->db->where('clogin', $clogin);
        $this->db->update('zuser');
    }

    // // Simpan ke database users
    // public function save($data)
    // {
    //     $this->db->insert('zuser', $data);
    // }

    // var $table = 'users as u'; //nama tabel dari database
    // var $column_order = array(null, 'u.seq', 'u.clogin','u.nama_user','r.nama_akses'); //field yang ada di table user
    // var $column_search = array('u.clogin','u.nama_user'); //field yang diizin untuk pencarian 
    // var $order = array('u.nama_user' => 'asc'); // default order 
    
    // private function _get_datatables_query()
    // {
         
    //     $this->db->from($this->table);
    //     $this->db->join('akses as r', 'r.kd_role = u.kd_role');
    //     $this->db->where('req', 1);
    //     $i = 0;
     
    //     foreach ($this->column_search as $item) // looping awal
    //     {
    //         if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
    //         {
                 
    //             if($i===0) // looping awal
    //             {
    //                 $this->db->group_start(); 
    //                 $this->db->like($item, $_POST['search']['value']);
    //             }
    //             else
    //             {
    //                 $this->db->or_like($item, $_POST['search']['value']);
    //             }
 
    //             if(count($this->column_search) - 1 == $i) 
    //                 $this->db->group_end(); 
    //         }
    //         $i++;
    //     }
         
    //     if(isset($_POST['order'])) 
    //     {
    //         $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    //     } 
    //     else if(isset($this->order))
    //     {
    //         $order = $this->order;
    //         $this->db->order_by(key($order), $order[key($order)]);
    //     }
    // }
 
    // function get_datatables()
    // {
    //     $this->_get_datatables_query();
    //     if($_POST['length'] != -1)
    //     $this->db->limit($_POST['length'], $_POST['start']);
    //     $query = $this->db->get();
    //     return $query->result();
    // }
 
    // function count_filtered()
    // {
    //     $this->_get_datatables_query();
    //     $query = $this->db->get();
    //     return $query->num_rows();
    // }
 
    // public function count_all()
    // {
    //     $this->db->from($this->table);
    //     return $this->db->count_all_results();
    // }

    // seq adalah kode user

    function delete_users($seq)
    {        
        $this->db->where('seq', $seq);
        $result=$this->db->delete('zuser');
        return $result;
    }

    public function update_user($seq, $data1)
    {
        $this->db->set($data1);
        $this->db->where('seq', $seq);
        $this->db->update('zuser');
    }

    public function tampil_permintaan_registrasi()
    {
        $this->db->from('users as u');
        $this->db->where('req', 0);
        $this->db->join('akses as r', 'r.kd_role = u.kd_role');
        $result = $this->db->get();
        return $result->result();
    }

    public function konfirmasi_register($seq, $isi)
    {
        $this->db->set($isi);
        $this->db->where('seq', $seq);
        $this->db->update('zuser');
    }

    public function status_update($seq, $isi)
    {
        $this->db->set($isi);
        $this->db->where('seq', $seq);
        $this->db->update('zuser');
    }



}
?>