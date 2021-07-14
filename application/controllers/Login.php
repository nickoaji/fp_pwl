<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Login extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->library('session');
    $this->load->library('form_validation');
  }
  public function index()
  {
    $this->load->view('login');
  }
  public function cek_login()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $cek = $this->User_model->cek_user($username, sha1($password));
    if ($cek->num_rows() > 0) {
      $data_json = array('sukses' => 'Ya', 'pesan' => 'Sukses Login !!!', 'user' => $cek->row_array());
    } else {
      $data_json = array('sukses' => 'Tidak', 'pesan' => 'Username atau Password Tidak Terdaftar !!!');
    }
    echo json_encode($data_json);
  }
  public function setSession()
  {
    $this->load->library('session');

    $id_user = $this->input->post('id_user');
    $uname_user = $this->input->post('uname_user');
    $role_id = $this->input->post('role_id');

    $this->session->set_userdata('id_user', $id_user);
    $this->session->set_userdata('uname_user', $uname_user);
    $this->session->set_userdata('role_id', $role_id);
  }
  public function logout()
  {
    $this->session->sess_destroy();
    redirect('login');
  }
}
