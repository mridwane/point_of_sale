<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_member extends CI_Model {   

    public function get_member($member_number)
    {
        $this->db->select('m.seq as member_id, m.cname as member_name, a.cname as member_area');
        $this->db->join('msarea as a', 'a.ccode = m.fid_area');
        $this->db->where('m.ccode', $member_number);
        $result = $this->db->get('msmember as m')->row();
        return $result;
    }


}
?>