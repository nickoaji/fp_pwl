<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
  public function list_user($username = '')
  {
    $this->db->select('users.id as id_user, users.username, COUNT(urls.hash) as jumlah_link,roles.deskripsi');
    $this->db->from('users');
    $this->db->join('urls', 'urls.user_id=users.id');
    $this->db->join('roles', 'users.role_id=roles.id');
    $this->db->group_by('username');
    if ($username != '' && $username != null) {
      $this->db->like('username', $username);
    }
    return $this->db->get();
  }
  function delete_data($table, $id)
  {
    $this->db->delete($table, array('id' => $id));
  }
}
