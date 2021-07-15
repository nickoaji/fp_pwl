<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Url extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Url_model');
  }
  public function index()
  {
    $konten = $this->load->view('admin/list_url', null, true);
    $data_json = array(
      'konten' => $konten,
      'titel' => 'Url List',
    );
    echo json_encode($data_json);
  }
  public function list_url()
  {
    $data_url = $this->Url_model->get_url();
    $konten = '<thead class="thead-light"><tr>
                <th>Short Link</th>
                <th>Title</th>
                <th>Original Link</th>
                <th>Total Clicked</th>
              </tr></thead>';
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
  public function cari_data()
  {
    $title = $this->input->post('cari_title');
    $data_url = $this->Url_model->get_url($title);
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
