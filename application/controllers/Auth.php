<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_users');
		$this->load->model('m_company');
	}

	public function index()
	{
		$data = array(
			'title' => 'Login',
			'style' => 'login'
		);
		view('Auth/v_login', $data);
	}

	public function register()
	{
		$url['title'] = "Register";
		$this->load->view('Auth/register', $url);
	}

	public function cek_username()
	{         
		$clogin = html_escape($this->input->post('username'));
		$cekUser = $this->m_users->get_username($clogin);
		if ($cekUser > 0)
		{
			echo "username";
		}
	}

	// public function proses_register()
	// {
	// 	$karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    //     $shuffle10  = substr(str_shuffle($karakter), 0, 10);
    //     $shuffle5  = substr(str_shuffle($karakter), 0, 5);
	// 	$date = date('dmYhis');
	// 	$waktu_reg = date('Y-m-d');
	// 	$kd_user = $shuffle10.$date.$shuffle5;

	// 	$nama = html_escape($this->input->post('nama'));
	// 	$clogin = html_escape($this->input->post('username'));
	// 	$akses = html_escape($this->input->post('akses'));
	// 	$password = html_escape($this->input->post('pass1'));
	// 	$passhash = password_hash($password, PASSWORD_DEFAULT);
	// 	$foto_default = "Default.png";

	// 	$data = array(
	// 		'kd_user' => $kd_user,
	// 		'username' => $clogin,
	// 		'nama_user' => $nama,
	// 		'password' => $passhash,
	// 		'kd_role' => $akses,
	// 		'waktu_reg' => $waktu_reg,
	// 		'foto' => $foto_default
	// 		);			
	// 		$this->m_users->save($data);
	// 	$this->session->set_flashdata('flash', 'berhasil mendaftar');
	// 	redirect('Auth');
	// }

	public function proses_login()
	{
		$clogin = html_escape($this->input->post('username'));
		$password = html_escape(md5($this->input->post('password')));

		$data = $this->m_users->get_users($clogin);
		$company = $this->m_company->get_company();
		if(empty($data))
		{
			$this->session->set_flashdata('flash', 'username salah');
			redirect('Auth');
		}
		else
		{
			if($data->active == 0)
			{
				$this->session->set_flashdata('flash', 'status nonaktif');
				redirect('Auth');
			}
			else
			{
				if($password == $data->password)
				{		
					$seq = $data->seq;	
					// $cek_role = $data->kd_role;	
					
					$this->session->set_userdata('seq', $seq);
					$this->session->set_userdata('cname', $data->cname);		
					$this->session->set_userdata('clogin', $clogin);	
					$this->session->set_userdata('company_name', $company->cname);
					$this->session->set_userdata('company_address', $company->caddress);
					$this->session->set_userdata('company_city', $company->city);
					$this->session->set_userdata('is_login',TRUE);	
					redirect('Dashboard');				
				}
				else
				{
					$this->session->set_flashdata('flash', 'password salah');
					redirect('Auth');
				}
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
        redirect('Auth');
	}

}
