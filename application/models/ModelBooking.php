<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelBooking extends CI_Model
{
    public function getData($table)
    {
        return $this->db->get($table)->row();
    }
    public function getDataWhere($table, $where)
    {
        $this->db->where($where);
        return $this->db->get($table);
    }

    public function getOrderByLimit($table, $order, $limit)
    {
        $this->db->order_by($order, 'desc');
        $this->db->limit($limit);
        return $this->db->get($table);
    }

    public function joinOrder($where)
    {
        $this->db->select('*');
        $this->db->from('booking bo');
        $this->db->join('booking_detail d', 'd.id_booking=bo.id_booking');
        $this->db->join('kontrak bu ', 'bu.id=d.id_kontrak');
        $this->db->where($where);
        return $this->db->get();
    }

    public function simpanDetail($where = null)
    {
        $sql = "INSERT INTO booking_detail (id_booking,id_kontrak) SELECT booking.id_booking,tempo.id_kontrak FROM booking, tempo WHERE tempo.id_user=booking.id_user AND booking.id_user='$where'";
        $this->db->query($sql);
    }

    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function updateData($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }

    public function deleteData($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function find($where)
    {
        //Query mencari record berdasarkan ID-nya
        $this->db->limit(1);
        return $this->db->get('kontrak', $where);
    }
    public function findD($where)
    {
        //Query mencari record berdasarkan ID-nya
        $this->db->limit(1);
        return $this->db->get('user', $where);
    }
    public function kosongkanData($table)
    {
        return $this->db->truncate($table);
    }
    public function createTemp()
    {
        $this->db->query('CREATE TABLE IF NOT EXISTS tempo(id_booking varchar(12), tgl_booking DATETIME, email_user varchar(128), id_kontrak int)');
    }
    public function selectJoin()
    {
        $this->db->select('*');
        $this->db->from('booking');
        $this->db->join('booking_detail', 'booking_detail.id_booking=booking.id_booking');
        $this->db->join('kontrak', 'booking_detail.id_kontrak=kontrak.id');
        return $this->db->get();
    }

    public function showtemp($where)
    {
        return $this->db->get('tempo', $where);
    }
    public function booking($where)
    {
        return $this->db->get('booking', $where);
    }
    public function kodeOtomatis($tabel, $key)
    {
        $this->db->select('right(' . $key . ',3) as kode', false);
        $this->db->order_by($key, 'desc');
        $this->db->limit(1);
        $query = $this->db->get($tabel);
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = date('dmY') . $kodemax;
        return $kodejadi;
    }
    public function getTempo()
    {
        return $this->db->get('tempo');
    }
    public function getBook()
    {
        return $this->db->get('booking');
    }
}
//     public function getTransfer()
//     {
//         $query = "SELECT '*'
//                   FROM `rekening` JOIN `user`
//                   ON `rekening`.`id_user` = `user`.`id`
//                 ";
//         return $this->db->query($query)->result_array();
//     }
//     public function rekeningWhere($where)
//     {
//         return $this->db->get_where('rekening', $where);
//     }
//     public function simpanRekening($data = null)
//     {
//         $this->db->insert('rekening', $data);
//     }
// }
