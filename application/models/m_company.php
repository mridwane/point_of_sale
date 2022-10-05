<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_company extends CI_Model {   

    public function get_company()
    {
        $result = $this->db->get('mscompany')->row();
        return $result;
    }


}
?>