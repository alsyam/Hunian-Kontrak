<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }
    public function index()
    {
        $data['judul'] = 'Profil';
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $user['nama'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    public function anggota()
    {
        $data['judul'] = 'Data Anggota';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $user['nama'];
        // $data['anggota'] = $this->db->get('user')->result_array();
        // $data['pesan'] = $this->db->get('pesan')->result_array();
        $data['anggota'] = $this->ModelUser->userJoin()->result_array();
        $data['pesan'] = $this->ModelUser->pesanJoin()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/anggota', $data);
        $this->load->view('templates/footer');
    }
    public function ubahProfil()
    {
        $data['judul'] = 'Ubah Profil';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $user['nama'];
        $this->form_validation->set_rules(
            'nama',
            'Nama Lengkap',
            'required|trim',
            [
                'required' => 'Nama tidak Boleh Kosong'
            ]
        );
        $this->form_validation->set_rules(
            'alamat',
            'Alamat Lengkap',
            'required|trim',
            [
                'required' => 'Alamat tidak Boleh Kosong'
            ]
        );
        $this->form_validation->set_rules(
            'no_telp',
            'No Telepon',
            'required|trim',
            [
                'required' => 'No Telepon tidak Boleh Kosong'
            ]
        );
        // if ($this->form_validation->run() == false) {
        //     $this->load->view('templates/header', $data);
        //     $this->load->view('templates/topbar', $data);
        //     $this->load->view('user/ubah-profil', $data);
        //     $this->load->view('templates/footer');
        // } else {
        //     $nama = $this->input->post('nama', true);
        //     $email = $this->input->post('email', true);
        //     $alamat = $this->input->post('alamat', true);
        //     $no_telp = $this->input->post('no_telp', true);
        //     //jika ada gambar yang akan diupload
        //     $upload_image = $_FILES['image']['name'];
        //     if ($upload_image) {
        //         $config['upload_path'] = './assets/img/profile/';
        //         $config['allowed_types'] = 'gif|jpg|png';
        //         $config['max_size'] = '3000';
        //         $config['max_width'] = '1024';
        //         $config['max_height'] = '1000';
        //         $config['file_name'] = 'pro' . time();
        //         $this->load->library('upload', $config);
        //         if ($this->upload->do_upload('image')) {
        //             $gambar_lama = $data['user']['image'];
        //             if ($gambar_lama != 'default.jpg') {
        //                 unlink(FCPATH . 'assets/img/profile/' .
        //                     $gambar_lama);
        //             }
        //             $gambar_baru = $this->upload->data('file_name');
        //             $this->db->set('image', $gambar_baru);
        //         } else {
        //         }
        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/profile/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();
        //memuat atau memanggil library upload
        $this->load->library('upload', $config);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/ubah-profil', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
                $gambar = $image['file_name'];
            } else {
                $gambar = $this->input->post('old_pict', TRUE);
            }
            $nama = $this->input->post('nama', true);
            $alamat = $this->input->post('alamat', true);
            $email = $this->input->post('email', true);
            $no_telp = $this->input->post('no_telp', true);
            $image = $gambar;



            $this->db->set('nama', $nama);
            $this->db->set('alamat', $alamat);
            $this->db->set('no_telp', $no_telp);
            $this->db->set('image', $image);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Profil Berhasil diubah </div>');
            redirect('user');
        }
    }

    // laporan

    // public function laporan_anggota()
    // {
    //     $data['judul'] = 'Laporan Data Anggota';
    //     $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    //     $this->db->where('role_id', 1);
    //     $data['anggota'] = $this->db->get('user')->result_array();
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('laporan/laporan_anggota', $data);
    //     $this->load->view('templates/footer');
    // }
    public function cetak_laporan_anggota()
    {
        // $data['laporan'] = $this->db->get('user')->result_array();
        $data['anggota'] = $this->ModelUser->userJoin()->result_array();
        $data['pesan'] = $this->ModelUser->pesanJoin()->result_array();
        $this->load->view('user/laporan-print-anggota', $data);
    }
    public function export_excel_anggota()
    {
        $data = array(
            'title' => 'Laporan Data Anggota',
            // 'laporan' => $this->db->get('user')->result_array(),
        );
        $data['anggota'] = $this->ModelUser->userJoin()->result_array();
        $data['pesan'] = $this->ModelUser->pesanJoin()->result_array();
        $this->load->view('user/export-excel-anggota', $data);
    }
}
    // public function laporan_anggota_pdf()
    // {
    //     $this->load->library('dompdf_gen');

    //     $data['laporan'] = $this->db->get('user')->result_array();;

    //     $this->load->view('user/laporan-pdf-anggota', $data);

    //     $paper_size = 'A4'; // ukuran kertas
    //     $orientation = 'landscape'; //tipe format kertas potrait atau landscape
    //     $html = $this->output->get_output();

    //     $this->dompdf->set_paper($paper_size, $orientation);
    //     //Convert to PDF
    //     $this->dompdf->load_html($html);
    //     $this->dompdf->render();
    //     $this->dompdf->stream("laporan data anggota.pdf", array('Attachment' => 0));
    //     // nama file pdf yang di hasilkan

    // }
