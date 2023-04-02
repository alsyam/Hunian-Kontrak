<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Sewa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model(['ModelUser', 'ModelSewa', 'ModelPesan']);
    }
    //manajemen Kos
    public function index()
    {
        $data['judul'] = 'Data Kontrakan';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['sewa'] = $this->ModelSewa->getKontrak()->result_array();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $user['nama'];
        $this->form_validation->set_rules('luas_t', 'Luas Tanah', 'required', [
            'required' => 'Luas Tanah harus diisi'
        ]);
        $this->form_validation->set_rules('luas_b', 'Luas Bangunan', 'required', [
            'required' => 'Luas Bangunan harus diisi'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[3]', [
            'required' => 'Alamat harus diisi',
            'min_length' => 'Alamat terlalu pendek'
        ]);
        $this->form_validation->set_rules('listrik', 'Listrik', 'required|min_length[3]', [
            'required' => 'Listrik harus diisi',
            'min_length' => 'Listrik terlalu pendek'
        ]);
        $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required|min_length[3]', [
            'required' => 'No. Telepon harus diisi',
            'min_length' => 'No. Telepon terlalu pendek'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|min_length[10]', [
            'required' => 'Deskripsi harus diisi',
            'min_length' => 'Deskripsi terlalu pendek'
        ]);
        $this->form_validation->set_rules(
            'harga',
            'Harga ',
            'required|min_length[6]|numeric',
            [
                'required' => 'Harga harus diisi',
                'min_length' => 'Harga terlalu pendek',
                'numeric' => 'Hanya boleh diisi angka'
            ]
        );
        $this->form_validation->set_rules(
            'stok',
            'Stok',
            'required|numeric',
            [
                'required' => 'Stok harus diisi',
                'numeric' => 'Yang anda masukan bukan angka'
            ]
        );
        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();
        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sewa/index', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            }
            if ($this->upload->do_upload('image2')) {
                $image1 = $this->upload->data();
                $gambar2 = $image1['file_name'];
            }
            if ($this->upload->do_upload('image3')) {
                $image2 = $this->upload->data();
                $gambar3 = $image2['file_name'];
            } else {
                $gambar = $this->input->post('image', TRUE);
                $gambar2 = $this->input->post('image2', TRUE);
                $gambar3 = $this->input->post('image3', TRUE);
            }
            $data = [
                'id_user' => $user['id'],
                'luas_b' => $this->input->post('luas_b', true),
                'luas_t' => $this->input->post('luas_t', true),
                'listrik' => $this->input->post('listrik', true),
                'deskripsi' => $this->input->post('deskripsi', true),
                'alamat' => $this->input->post('alamat', true),
                'no_telp' => $this->input->post('no_telp', true),
                'harga' => $this->input->post('harga', true),
                'durasi' => $this->input->post('durasi', true),
                'stok' => $this->input->post('stok', true),
                'ditempati' => 0,
                'dibooking' => 0,
                'image' => $gambar,
                'image2' => $gambar2,
                'image3' => $gambar3
            ];
            $this->ModelSewa->simpanKontrak($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Telah berhasil menambahkan rumah</div>');
            redirect('sewa');
        }
    }

    public function ubahSewa()
    {
        $data['judul'] = 'Ubah Data Kontrakan';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['sewa'] = $this->ModelSewa->kontrakWhere(['id' => $this->uri->segment(3)])->row_array();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $user['nama'];
        $this->form_validation->set_rules('luas_t', 'Luas Tanah', 'required', [
            'required' => 'Luas Tanah harus diisi'
        ]);
        $this->form_validation->set_rules('luas_b', 'Luas Bangunan', 'required', [
            'required' => 'Luas Bangunan harus diisi'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[3]', [
            'required' => 'Alamat harus diisi',
            'min_length' => 'Alamat terlalu pendek'
        ]);
        $this->form_validation->set_rules('listrik', 'Listrik', 'required|min_length[3]', [
            'required' => 'Listrik harus diisi',
            'min_length' => 'Listrik terlalu pendek'
        ]);
        $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required|min_length[3]', [
            'required' => 'No. Telepon harus diisi',
            'min_length' => 'No. Telepon terlalu pendek'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|min_length[10]', [
            'required' => 'Deskripsi harus diisi',
            'min_length' => 'Deskripsi terlalu pendek'
        ]);
        $this->form_validation->set_rules(
            'harga',
            'Harga ',
            'required|min_length[6]|numeric',
            [
                'required' => 'Harga harus diisi',
                'min_length' => 'Harga terlalu pendek',
                'numeric' => 'Hanya boleh diisi angka'
            ]
        );
        $this->form_validation->set_rules(
            'stok',
            'Stok',
            'required|numeric',
            [
                'required' => 'Stok harus diisi',
                'numeric' => 'Yang anda masukan bukan angka'
            ]
        );
        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
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
            $this->load->view('sewa/ubah_sewa', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            }
            if ($this->upload->do_upload('image2')) {
                $image1 = $this->upload->data();
                $gambar2 = $image1['file_name'];
            }
            if ($this->upload->do_upload('image3')) {
                $image2 = $this->upload->data();
                $gambar3 = $image2['file_name'];
            } else {
                $gambar = $this->input->post('image', TRUE);
                $gambar2 = $this->input->post('image2', TRUE);
                $gambar3 = $this->input->post('image3', TRUE);
                //     $gambar = $image['file_name'];
                // } else {
                //     $gambar = $this->input->post('old_pict', TRUE);
            }
            $data = [
                'luas_b' => $this->input->post('luas_b', true),
                'luas_t' => $this->input->post('luas_t', true),
                'listrik' => $this->input->post('listrik', true),
                'deskripsi' => $this->input->post('deskripsi', true),
                'alamat' => $this->input->post('alamat', true),
                'no_telp' => $this->input->post('no_telp', true),
                'harga' => $this->input->post('harga', true),
                'durasi' => $this->input->post('durasi', true),
                'stok' => $this->input->post('stok', true),
                'image' => $gambar,
                'image2' => $gambar2,
                'image3' => $gambar3
            ];
            $this->ModelSewa->updateKontrak($data, ['id' => $this->uri->segment(3)]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Data rumah berhasil diubah</div>');
            redirect('sewa');
        }
    }
    public function hapusKontrak()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelSewa->hapusKontrak($where);
        redirect('sewa');
    }

    //laporan


    public function cetak_laporan_sewa()
    {
        $data['sewa'] = $this->ModelSewa->getKontrak()->result_array();

        $this->load->view('sewa/laporan_print_rumah', $data);
    }

    public function export_excel_sewa()
    {
        $data = array('title' => 'Laporan Penyewaan', 'sewa' => $this->ModelSewa->getKontrak()->result_array());

        $this->load->view('sewa/laporan_excel_rumah', $data);
    }
    // public function laporan_kos_pdf()

    // {
    //     $this->load->library('dompdf_gen');

    //     $data['kos'] = $this->ModelKos->getKos()->result_array();

    //     $this->load->view('kos/laporan_pdf_kos', $data);

    //     $paper_size = '4A';
    //     $orientiation = 'landscape';
    //     $html = $this->output->get_output();

    //     $this->dompdf->set_paper($paper_size, $orientiation);

    //     $this->dompdf->load_html($html);
    //     $this->dompdf->render();
    //     $this->dompdf->stream("laporan_data_kos.pdf", array('Attachment' => 0));
    // }
}
