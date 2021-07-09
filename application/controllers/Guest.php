<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Guest extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Guest_model');
    // $this->load->model('Url_model');
    // $this->load->model('Statistics_model');
  }
  public function index()
  {
    $this->session->userdata('role_id');
    if ($this->session->userdata('role_id') != 2) {
      $this->load->view('guest/guest');
    } else {
      redirect('dasb');
    }
  }
  public function list_guest()
  {
    $data_guest = $this->Guest_model->get_guest();
    $konten = '<tr>
                <td>Hash</td>
                <td>Title</td>
                <td>Original Link</td>
                <td>Total Clicked</td>
              </tr>';
    foreach ($data_guest->result() as $key => $value) {
      $konten .= '<tr>
        <td><a href="' . $value->hash . '">' . 'http://localhost/fp_pwl/' . $value->hash . '</a></td>
        <td>' . $value->title . '</td>
        <td>' . $value->original_link . '</td>
        <td>' . $value->total_clicked . '</td>
      </tr>';
    }
    $data_json = array(
      'konten' => $konten,
    );
    echo json_encode($data_json);
  }
  public function form_create()
  {
    $this->load->view('guest/form_guest');
  }
  public function create_action()
  {
    $this->db->trans_start();
    $arr_input = array(
      'hash' => uniqid() . 'guest', // creates a random key
      'title' => $this->input->post('title'),
      'original_link' => $this->input->post('url'),
    );

    $this->Guest_model->insert_data($arr_input);

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $data_output = array('sukses' => 'tidak', 'pesan' => 'Gagal Input Data Barang');
    } else {
      $this->db->trans_commit();
      $data_output = array('sukses' => 'ya', 'pesan' => 'Berhasil Input Data Barang');
    }
    echo json_encode($data_output);
  }
  public function redirect($hash)
  {

    $url_data = $this->Guest_model->get_url($hash);
    if ($url_data->result() == null) {

      $this->load->view('not_found');
    } else {
      foreach ($url_data->result() as $key => $value) {
      }
      $this->Guest_model->add_click($value->hash, $value->total_clicked + 1);
      redirect($value->original_link);
      exit();
    }
  }
  public function cari_guest()
  {
    $cari_title = $this->input->post('cari_title');
    $cari_url = $this->input->post('cari_url');
    $data_guest = $this->Guest_model->get_guest($cari_title, $cari_url);
    $konten = '<tr>
    <td>Hash</td>
    <td>Title</td>
    <td>Original Link</td>
    <td>Total Clicked</td>
    </tr>';
    foreach ($data_guest->result() as $key => $value) {
      $konten .= '<tr>
      <td>' . $value->hash . '</td>
      <td>' . $value->title . '</td>
      <td>' . $value->original_link . '</td>
      <td>' . $value->total_clicked . '</td>
      </tr>';
    }
    $data_json = array(
      'konten' => $konten,
    );
    echo json_encode($data_json);
  }
}
