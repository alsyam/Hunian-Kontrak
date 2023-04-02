<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ModelUser extends CI_Model
{
    public function simpanData($data = null)
    {
        $this->db->insert('user', $data);
    }
    public function cekData($where = null)
    {
        return $this->db->get_where('user', $where);
    }
    public function getUserWhere($where = null)
    {
        return $this->db->get_where('user', $where);
    }
    public function cekUserAccess($where = null)
    {
        $this->db->select('*');
        $this->db->from('access_menu');
        $this->db->where($where);
        return $this->db->get();
    }
    public function userJoin()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('role', 'role.id_role=user.role_id');
        return $this->db->get();
    }

    public function pesanJoin()
    {
        $this->db->select('*');
        $this->db->from('pesan');
        $this->db->join('user', 'user.id=pesan.id_user');
        $this->db->join('role', 'role.id_role=user.role_id');

        return $this->db->get();
    }
}
