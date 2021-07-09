<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guest_model extends CI_Model
{
  public function get_guest($cari_title = '', $cari_url = '')
  {
    $this->db->select('*');
    $this->db->from('urls_guest');
    if ($cari_title != '' && $cari_title != null) {
      $this->db->like('title', $cari_title);
    }
    if ($cari_url != '' && $cari_url != null) {
      $this->db->like('original_link', $cari_url);
    }
    return $this->db->get();
  }
  public function insert_data($data)
  {
    $this->db->insert('urls_guest', $data);
  }
  public function get_url($hash)
  {
    $this->db->select('*');
    $this->db->from('urls_guest');
    $this->db->where('hash', $hash . 'guest');
    return $this->db->get();
  }
  public function add_click($hash, $total_clicked)
  {
    $this->db->set('total_clicked', $total_clicked);
    $this->db->where('hash', $hash);
    $this->db->update('urls_guest');
  }
}
