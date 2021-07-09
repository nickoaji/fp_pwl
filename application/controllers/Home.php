<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Home extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // $this->load->model('Url_model');
    // $this->load->model('Statistics_model');
  }
  public function index()
  {
    $this->load->view('template');
  }
}
