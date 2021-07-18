<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  public function cek_user($username, $password)
  {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    return $this->db->get();
  }
  public function list_url($title = '', $hash = '')
  {
    $id = $this->session->userdata('id_user');

    $this->db->select('*');
    $this->db->where('user_id', $id);
    $this->db->from('urls');
    if ($title != '' && $title != null) {
      $this->db->like('title', $title);
    }
    if ($hash != '' && $hash != null) {
      $this->db->like('hash', $hash);
    }
    return $this->db->get();
  }
  function save_data($hash, $title, $original_link, $user_id, $image_name)
  {
    $data = array(
      'hash' => $hash,
      'title' => $title,
      'original_link' => $original_link,
      'user_id' => $user_id,
      'qr_code' => $image_name,
    );
    $this->db->insert('urls', $data);
  }
  function register($table, $data)
  {
    $this->db->insert($table, $data);
  }
  public function get_url($hash)
  {
    $this->db->select('*');
    $this->db->from('urls');
    $this->db->where('hash', $hash);
    return $this->db->get();
  }
  public function add_click($hash, $total_clicked)
  {
    $this->db->set('total_clicked', $total_clicked);
    $this->db->where('hash', $hash);
    $this->db->update('urls');
  }
  function delete_data($table, $hash)
  {
    $this->db->delete($table, array('hash' => $hash));
  }
  public function get_by_id($table, $hash)
  {
    return $this->db->get_where($table, array('hash' => $hash))->row();
  }
  public function update_data($original_link, $hash, $title, $image_name)
  {
    $data = array(
      'hash' => $hash,
      'title' => $title,
      'original_link' => $original_link,
      'qr_code' => $image_name,
    );
    $id = $this->session->userdata('id_user');
    $this->db->where('user_id', $id);
    $this->db->where('original_link', $original_link);
    return $this->db->update('urls', $data);
  }
}
