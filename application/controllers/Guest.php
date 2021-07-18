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
    // $this->session->userdata('role_id');
    // if ($this->session->userdata('role_id') != 2) {
    //   $this->load->view('guest/guest');
    // } else {
    //   redirect('user');
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
  public function list_guest()
  {
    $data_guest = $this->Guest_model->get_guest();
    $konten = '<thead class="thead-light"><tr>
                <th>Short Link</th>
                <th>Title</th>
                <th>Original Link</th>
                <th>QR Code</th>
                <th>Total Clicked</th>
              </tr></thead>';
    foreach ($data_guest->result() as $key => $value) {
      $konten .= '<tr>
        <td><a href="' . $value->hash . '">' . 'http://localhost/fp_pwl/' . $value->hash . '</a></td>
        <td>' . $value->title . '</td>
        <td>' . $value->original_link . '</td>
        <td><img style="width: 100px;" src="http://localhost/fp_pwl/assets/images/' . $value->qr_code . '"></td>
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

    $hash = uniqid() . 'guest'; // creates a random key
    $title     = $this->input->post('ttl');
    $original_link    = $this->input->post('url');

    $this->load->library('ciqrcode');

    $config['cacheable']    = true; //boolean, the default is true
    $config['cachedir']     = './assets/'; //string, the default is application/cache/
    $config['errorlog']     = './assets/'; //string, the default is application/logs/
    $config['imagedir']     = './assets/images/'; //direktori penyimpanan qr code
    $config['quality']      = true; //boolean, the default is true
    $config['size']         = '1024'; //interger, the default is 1024
    $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
    $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)

    $this->ciqrcode->initialize($config);

    $image_name = $hash . '.png'; //buat name dari qr code sesuai dengan nim

    $params['data'] = 'http://localhost/fp_pwl/' . $hash; //data yang akan di jadikan QR CODE
    $params['level'] = 'H'; //H=High
    $params['size'] = 10;
    $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
    $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

    $this->Guest_model->save_data($hash, $title, $original_link, $image_name);
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
    $data_guest = $this->Guest_model->get_guest($title);
    $konten = '<thead class="thead-light"><tr>
                <th>Short Link</th>
                <th>Title</th>
                <th>Original Link</th>
                <th>QR Code</th>
                <th>Total Clicked</th>
              </tr></thead>';
    foreach ($data_guest->result() as $key => $value) {
      $konten .= '<tr>
        <td><a href="' . $value->hash . '">' . 'http://localhost/fp_pwl/' . $value->hash . '</a></td>
        <td>' . $value->title . '</td>
        <td>' . $value->original_link . '</td>
        <td><img style="width: 100px;" src="http://localhost/fp_pwl/assets/images/' . $value->qr_code . '"></td>
        <td>' . $value->total_clicked . '</td>
      </tr>';
    }
    $data_json = array(
      'konten' => $konten,
    );
    echo json_encode($data_json);
  }
}
