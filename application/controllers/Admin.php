<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function index()
  {
    switch ($this->session->userdata('role_id')) {
      case '1':
        $this->load->view('admin/dasb');
        break;
      case '2':
        $this->load->view('user/user_dasb');
        break;
      default:
        $this->load->view('guest/guest');
        break;
    }
  }
}
