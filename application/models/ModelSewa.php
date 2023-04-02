<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ModelSewa extends CI_Model
{
    //manajemen buku
    public function getKontrak()
    {
        return $this->db->get('kontrak');
    }
    public function kontrakWhere($where)
    {
        return $this->db->get_where('kontrak', $where);
    }
    public function simpanKontrak($data = null)
    {
        $this->db->insert('kontrak', $data);
    }
    public function updateKontrak($data = null, $where = null)
    {
        $this->db->update('kontrak', $data, $where);
    }
    public function hapusKontrak($where = null)
    {
        $this->db->delete('kontrak', $where);
    }
    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where) && count($where) > 0) {
            $this->db->where($where);
        }
        $this->db->from('kontrak');
        return $this->db->get()->row($field);
    }

    // //manajemen kategori
    // public function getKategori()
    // {
    //     return $this->db->get('kategori');
    // }
    // public function kategoriWhere($where)
    // {
    //     return $this->db->get_where('kategori', $where);
    // }
    // public function simpanKategori($data = null)
    // {
    //     $this->db->insert('kategori', $data);
    // }
    // public function hapusKategori($where = null)
    // {
    //     $this->db->delete('kategori', $where);
    // }
    // public function updateKategori($where = null, $data = null)
    // {
    //     $this->db->update('kategori', $data, $where);
    // }

    // public function getJoin()
    // {
    //     $query = "SELECT *
    //               FROM `kos` JOIN `kategori`
    //               ON `kos`.`id_kategori` = `kategori`.`id_kategori`
    //             ";
    //     return $this->db->query($query)->result_array();
    // }
    // // join
    public function joinDua($where)
    {
        $this->db->select('*');
        $this->db->from('booking_detail');
        $this->db->join('kos', 'kos.id = booking_detail.id_kos', 'left');
        $this->db->where($where);
        return $this->db->get();
    }
}
