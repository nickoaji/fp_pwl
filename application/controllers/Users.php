<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Users_model');
  }
  public function index()
  {
    $konten = $this->load->view('admin/list_user', null, true);
    $data_json = array(
      'konten' => $konten,
      'titel' => 'List Semua User Yang Terdaftar',
    );
    echo json_encode($data_json);
  }
  public function list_user()
  {
    $data_user = $this->Users_model->list_user();
    $konten = '<thead class="thead-light"><tr>
                <th>Username</th>
                <th>Roles</th>
                <th>Jumlah Link</th>
                <th>Aksi</th>
              </tr></thead>';
    foreach ($data_user->result() as $key => $value) {
      $konten .= '<tr>
        <td>' . $value->username . '</td>
        <td>' . $value->deskripsi . '</td>
        <td>' . $value->jumlah_link . '</td>
        <td><a data="' . $value->id_user . '" class="linkHapusUser">Hapus</a> 
        </td>
      </tr>';
    }
    $data_json = array(
      'konten' => $konten,
    );
    echo json_encode($data_json);
  }
  public function cari_data()
  {
    $username = $this->input->post('cari_username');
    $data_user = $this->Users_model->list_user($username);
    $konten = '<thead class="thead-light"><tr>
                <th>Username</th>
                <th>Roles</th>
                <th>Jumlah Link</th>
                <th>Aksi</th>
              </tr></thead>';
    foreach ($data_user->result() as $key => $value) {
      $konten .= '<tr>
        <td>' . $value->username . '</td>
        <td>' . $value->deskripsi . '</td>
        <td>' . $value->jumlah_link . '</td>
        <td><a data="' . $value->id_user . '" class="linkHapusUser">Hapus</a> 
        </td>
      </tr>';
    }
    $data_json = array(
      'konten' => $konten,
    );
    echo json_encode($data_json);
  }
  function delete()
  {
    $id = $this->input->post('id_user');
    $data = $this->Users_model->delete_data('users', $id);
  }
}
