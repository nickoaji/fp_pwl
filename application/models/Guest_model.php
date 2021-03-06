<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guest_model extends CI_Model
{
  public function get_guest($title = '')
  {
    $this->db->select('*');
    $this->db->from('urls_guest');
    if ($title != '' && $title != null) {
      $this->db->like('title', $title);
    }
    return $this->db->get();
  }
  function save_data($hash, $title, $original_link, $image_name)
  {
    $data = array(
      'hash' => $hash,
      'title' => $title,
      'original_link' => $original_link,
      'qr_code' => $image_name,
    );
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
