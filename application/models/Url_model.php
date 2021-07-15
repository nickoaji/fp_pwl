<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Url_model extends CI_Model
{
  public function get_url($title = '')
  {
    $this->db->select('*');
    $this->db->from('urls_guest');
    if ($title != '' && $title != null) {
      $this->db->like('title', $title);
    }
    return $this->db->get();
  }
}
