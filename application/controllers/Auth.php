<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_users');
		
	}

	public function index()
	{
		$url['title'] = "Login";
		$this->load->view('Auth/login', $url);
	}

	public function register()
	{
		$url['title'] = "Register";
		$this->load->view('Auth/register', $url);
	}

	public function cek_username()
	{         
		$username = html_escape($this->input->post('username'));
		$cekUser = $this->m_users->get_username($username);
		if ($cekUser > 0)
		{
			echo "username";
		}
	}

	public function proses_register()
	{
		$karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $shuffle10  = substr(str_shuffle($karakter), 0, 10);
        $shuffle5  = substr(str_shuffle($karakter), 0, 5);
		$date = date('dmYhis');
		$waktu_reg = date('Y-m-d');
		$kd_user = $shuffle10.$date.$shuffle5;

		$nama = html_escape($this->input->post('nama'));
		$username = html_escape($this->input->post('username'));
		$akses = html_escape($this->input->post('akses'));
		$password = html_escape($this->input->post('pass1'));
		$passhash = password_hash($password, PASSWORD_DEFAULT);
		$foto_default = "Default.png";

		$data = array(
			'kd_user' => $kd_user,
			'username' => $username,
			'nama_user' => $nama,
			'password' => $passhash,
			'kd_role' => $akses,
			'waktu_reg' => $waktu_reg,
			'foto' => $foto_default
			);			
			$this->m_users->save($data);
		$this->session->set_flashdata('flash', 'berhasil mendaftar');
		redirect('Auth');
	}

	public function proses_login()
	{
		$username = html_escape($this->input->post('username'));
		$password = html_escape($this->input->post('password'));

		$data = $this->m_users->get_users($username);
		if(empty($data))
		{
			$this->session->set_flashdata('flash', 'username salah');
			redirect('Auth');
		}
		else
		{
			if($data->req == 0)
			{
				$this->session->set_flashdata('flash', 'belum terdaftar');
				redirect('Auth');
			}
			else if($data->status == 0)
			{
				$this->session->set_flashdata('flash', 'status nonaktif');
				redirect('Auth');
			}
			else
			{
				if(password_verify($password, $data->password))
				{		
					$kd_user = $data->kd_user;	
					$cek_role = $data->kd_role;	
					
					$this->session->set_userdata('kd_user', $kd_user);
					$this->session->set_userdata('nama', $data->nama_user);	
					$this->session->set_userdata('kd_role', $data->kd_role);	
					$this->session->set_userdata('username', $username);
					$this->session->set_userdata('foto', $data->foto);		
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
