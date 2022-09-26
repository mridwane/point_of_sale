<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_user extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('m_users');
        if(empty($this->session->userdata('is_login')))
        {
			redirect('Auth');
		}
    }

    public function manajemen_user()
    {
        if($this->session->userdata('kd_role') == 2)
        {            
            $keluar = $this->session->sess_destroy();
            redirect('Auth');
		}
        $url['title'] = "Manajemen User";
        $this->load->view('Tamplate/header', $url);
        $this->load->view('Tamplate/sidebar');
        $this->load->view('PengaturanUser/v_manajemen_user');
        $this->load->view('Tamplate/footer');
    }

    public function permintaan_reg()
    {
        if($this->session->userdata('kd_role') == 2)
        {            
            $keluar = $this->session->sess_destroy();
            redirect('Auth');
		}
        $data['req'] = $this->m_users->tampil_permintaan_registrasi(); 

        $url['title'] = "Permintaan Registrasi";
        $this->load->view('Tamplate/header', $url);
        $this->load->view('Tamplate/sidebar');
        $this->load->view('PengaturanUser/v_permintaan_registrasi',$data);
        $this->load->view('Tamplate/footer');
    }

    function get_data_user()
    {
        $list = $this->m_users->get_datatables();
        $data = array();
        $no = 1;
        foreach ($list as $field) {
            $row = array();
            $row[] = $no++;
            $row[] = $field->nama_user;
            $row[] = $field->username;
            $row[] = $field->nama_akses;
            if($field->status == 1)
            {
                $row[] = '<a href="javascript:void(0);" class="btn btn-success btn-rounded nonaktif" data-kd_user="'.$field->kd_user.'" data-nama="'.$field->nama_user.'"><i class="fas fa-power-off"></i> Aktif</a>';
            }
            else
            {
                $row[] = '<a href="javascript:void(0);" class="btn btn-secondary btn-rounded aktif" data-kd_user="'.$field->kd_user.'" data-nama="'.$field->nama_user.'"><i class="fas fa-power-off"></i> NonAktif</a>';
            }
            $row[] = '<a href="javascript:void(0);" class="btn btn-info btn-rounded reset_user" data-kd_user="'.$field->kd_user.'" data-nama="'.$field->nama_user.'"><i class="fas fa-sync"></i></a>'; 
            $row[] = '<a href="javascript:void(0);" class="btn btn-danger btn-rounded delete_user" data-kd_user="'.$field->kd_user.'" data-nama="'.$field->nama_user.'"><i class="fas fa-trash"></i></a>'; 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_users->count_all(),
            "recordsFiltered" => $this->m_users->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function reset_password(){
        $kd_user = html_escape($this->input->post('kd_user'));
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $password  = substr(str_shuffle($karakter), 0, 8);
        $new = password_hash($password, PASSWORD_DEFAULT);
        $data1 = array(
			'password' => $new,
			);
        $this->m_users->update_user($kd_user, $data1);
        echo json_encode($password);        
    } 

    public function delete(){
        $kd_user = html_escape($this->input->post('kd_user'));
        $data = $this->m_users->delete_users($kd_user);
        echo json_encode($data);        
    } 
    
    public function ganti_password()
    {
        $url['title'] = "Ganti Password";
        $this->load->view('Tamplate/header', $url);
        $this->load->view('Tamplate/sidebar');
        $this->load->view('PengaturanUser/v_ganti_password');
        $this->load->view('Tamplate/footer');
    }
    
    // proses ganti password
    public function proses_password()
    {
        $passold = html_escape($this->input->post('passold'));
        $passnew = html_escape($this->input->post('passnew'));
        $kd_user = $this->session->userdata('kd_user');
        $username = $this->session->userdata('username');

        $passData = $this->m_users->get_users($username);

        if(password_verify($passold, $passData->password))
		{
            $passhash = password_hash($passnew, PASSWORD_DEFAULT);
            $data1 = array(
                'password' => $passhash,
                );			
            $this->m_users->update_user($kd_user, $data1); 
            $this->session->sess_destroy();        
            redirect('Auth');
            $this->session->set_flashdata('flash', 'berhasil update');  
        }
        else
        {
            $this->session->set_flashdata('flash', 'gagal update');
            redirect('Profil/ganti_password');
        }
    }

    public function konfirmasi(){
        $kd_user = html_escape($this->input->post('kd_user'));
        $isi = array(
			'req' => 1,
            'status' => 1,
			);
        $data = $this->m_users->konfirmasi_register($kd_user, $isi);
        echo json_encode($data); 
    } 

    public function update_status(){
        $kd_user = html_escape($this->input->post('kd_user'));
        $status = html_escape($this->input->post('status'));
        $isi = array(
            'status' => $status,
			);
        $data = $this->m_users->status_update($kd_user, $isi);
        echo json_encode($data); 
    }

    public function tampil_req(){
        $data = $this->m_users->tampil_permintaan_registrasi();
        echo json_encode($data); 
    } 
    
 

}
