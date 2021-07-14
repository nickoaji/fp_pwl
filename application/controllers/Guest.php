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
      redirect('user');
    }
  }
  public function list_guest()
  {
    $data_guest = $this->Guest_model->get_guest();
    $konten = '<thead class="thead-light"><tr>
                <th>Short Link</th>
                <th>Title</th>
                <th>Original Link</th>
                <th>Total Clicked</th>
              </tr></thead>';
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
  function save()
  {
    $data = array(
      'hash' => uniqid(), // creates a random key
      'title'     => $this->input->post('ttl'),
      'original_link'    => $this->input->post('url'),
    );
    $this->Guest_model->save_data('urls_guest', $data);
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

  public function cari_data()
  {
    $title = $this->input->post('cari_title');
    $data_url = $this->Guest_model->get_guest($title);
    $konten = '<tr>
                <td>Short Link</td>
                <td>Title</td>
                <td>Original Link</td>
                <td>Total Clicked</td>            
              </tr>';
    foreach ($data_url->result() as $key => $value) {
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
}
