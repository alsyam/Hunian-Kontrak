<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed');
class ModelPesan extends CI_Model
{
    //manip table Pesan
    public function simpanPesan($data)
    {
        $this->db->insert('pesan', $data);
    }
    public function selectData($table, $where)
    {
        return $this->db->get($table, $where);
    }
    public function updateData($data, $where)
    {
        $this->db->update('pesan', $data, $where);
    }
    public function deleteData($tabel, $where)
    {
        $this->db->delete($tabel, $where);
    }
    public function joinData()
    {
        $this->db->select('*');
        $this->db->from('pesan');
        $this->db->join('detail_pesan', 'detail_pesan.no_pesan=pesan.no_pesan', 'Right');
        $this->db->join('user', 'user.id=pesan.id_user', 'Right');
        $this->db->join('kontrak', 'kontrak.id=detail_pesan.id_kontrak', 'Right');
        $this->db->join('konfirmasi', 'konfirmasi.id_user=user.id', 'Right');

        return $this->db->get()->result_array();
    }
    public function joinDataBo()
    {
        $this->db->select('*');
        $this->db->from('booking');
        $this->db->join('booking_detail', 'booking_detail.id_booking=booking.id_booking', 'Right');
        $this->db->join('user', 'user.id=booking.id_user', 'Right');
        $this->db->join('kontrak', 'kontrak.id=booking_detail.id_kontrak', 'Right');

        return $this->db->get()->result_array();
    }
    // public function joinKontrak()
    // {
    //     $this->db->select('*');
    //     $this->db->from('kontrak');
    //     $this->db->join('booking_detail', 'booking_detail.id_kontrak=kontrak.id', 'left');
    //     // $this->db->where('kontrak');

    //     return $this->db->get();
    // }
    public function joinKontrak()
    {
        $this->db->select('*');
        $this->db->from('booking_detail');
        $this->db->join('kontrak', 'kontrak.id=booking_detail.id_kontrak', 'right');

        return $this->db->get();
    }

    public function joinTiga()
    {
        $this->db->select('*');
        $this->db->from('kontrak');
        $this->db->join('booking_detail', 'booking_detail.id_kontrak=kontrak.id', 'left');
        $this->db->join('booking', 'booking.id_booking=booking_detail.id_booking', 'left');
        // $this->db->where('kontrak');

        return $this->db->get();
    }
    //     $this->db->select('*');
    // $this->db->where('sites.site_id', $site_id);
    // $this->db->from('sites');
    // $this->db->join('leader', 'sites.site_id = leader.site_id', 'outer');
    // $this->db->join('state', 'sites.site_id = state.site_id', 'outer')

    // $q = $this->db->get();
    //manip tabel detai pesan
    public function simpanDetail($idbooking, $nopesan)
    {
        $sql = "INSERT INTO detail_pesan (no_pesan,id_kontrak) SELECT pesan.no_pesan,booking_detail.id_kontrak FROM pesan, booking_detail WHERE booking_detail.id_booking=$idbooking AND pesan.no_pesan='$nopesan'";
        $this->db->query($sql);
    }
    public function simpanKonfir($data)
    {
        $this->db->insert('konfirmasi', $data);
    }
    public function updateKontrak($data, $where)
    {
        $this->db->update('kontrak', $data, $where);
    }
}
