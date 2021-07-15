<?php
defined('BASEPATH') or exit('No direct script access allowed');



class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
  }
  public function index()
  {
    // $this->session->userdata('role_id');
    // if ($this->session->userdata('role_id') == 2) {
    //   $this->load->view('user/user_dasb');
    // } else {
    //   redirect('login');
    // }
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
  public function list_url()
  {
    $data_url = $this->User_model->list_url();
    $konten = '<thead class="thead-light"><tr>
                <th>Short Link</th>
                <th>Title</th>
                <th>Original Link</th>
                <th>Total Clicked</th>
                <th>Aksi</th>
              </tr></thead>';
    foreach ($data_url->result() as $key => $value) {
      $konten .= '<tr>
        <td><a href="' . $value->hash . '">' . 'http://localhost/fp_pwl/' . $value->hash . '</a></td>
        <td>' . $value->title . '</td>
        <td>' . $value->original_link . '</td>
        <td>' . $value->total_clicked . '</td>
        <td><a data="' . $value->hash . '" class="linkHapusUrl">Hapus</a> 
        | <a data="' . $value->hash . '" class="linkEditUrl" >Edit</a></td>
      </tr>';
    }
    $data_json = array(
      'konten' => $konten,
    );
    echo json_encode($data_json);
  }
  function save()
  {
    $data = array(
      'hash' => uniqid(), // creates a random key
      'title'     => $this->input->post('ttl'),
      'original_link'    => $this->input->post('url'),
      'user_id' => $this->session->userdata('id_user')
    );
    $this->User_model->save_data('urls', $data);
  }

  public function redirect($hash)
  {

    $url_data = $this->User_model->get_url($hash);
    if ($url_data->result() == null) {

      $this->load->view('not_found');
    } else {
      foreach ($url_data->result() as $key => $value) {
      }
      $this->User_model->add_click($value->hash, $value->total_clicked + 1);
      redirect($value->original_link);
      exit();
    }
  }
  function delete()
  {
    $hash = $this->input->post('hash');
    $data = $this->User_model->delete_data('urls', $hash);
  }
  function get_update()
  {
    $hash = $this->input->get('hash');
    $data = $this->User_model->get_by_id('urls', $hash);
    echo json_encode($data);
  }
  function update()
  {
    $original_link = $this->input->post('original_link');
    $data = array(
      'hash' => $this->input->post('hash'),
      'title'     => $this->input->post('title'),
    );

    $this->User_model->update_data('urls', $data, $original_link);
  }
  public function cari_data()
  {
    $title = $this->input->post('cari_title');
    $hash = $this->input->post('cari_url');
    $data_url = $this->User_model->list_url($title, $hash);
    $konten = '<thead class="thead-light"><tr>
                <th>Short Link</th>
                <th>Title</th>
                <th>Original Link</th>
                <th>Total Clicked</th>
                <th>Aksi</th>
              </tr></thead>';
    foreach ($data_url->result() as $key => $value) {
      $konten .= '<tr>
        <td><a href="' . $value->hash . '">' . 'http://localhost/fp_pwl/' . $value->hash . '</a></td>
        <td>' . $value->title . '</td>
        <td>' . $value->original_link . '</td>
        <td>' . $value->total_clicked . '</td>
        <td><a data="' . $value->hash . '" class="linkHapusUrl">Hapus</a> 
        | <a data="' . $value->hash . '" class="linkEditUrl" >Edit</a></td>
      </tr>';
    }
    $data_json = array(
      'konten' => $konten,
    );
    echo json_encode($data_json);
  }
}
