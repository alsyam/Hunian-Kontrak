<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');
date_default_timezone_set('Asia/Jakarta');
class Booking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model(['ModelBooking', 'ModelUser']);
    }
    public function index()
    {
        $id = ['bo.id_user' => $this->uri->segment(3)];
        // $id_user = $this->session->userdata('id_user');
        $data['booking'] = $this->ModelBooking->joinOrder($id)->result();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $idku =  $user['id'];
        // $data['idku'] =  $user['id'];
        foreach ($user as $a) {
            $data = [
                'image' => $user['image'],
                'user' => $user['nama'],
                'email' => $user['email'],
                'tanggal_input' => $user['tanggal_input']
            ];
        }
        $dtb = $this->ModelBooking->showtemp(['id_user' => $idku])->num_rows();
        $dtbook = $this->ModelBooking->booking(['id_user' => $idku])->num_rows();
        // if ($dtbook == 1) {
        //     $this->session->set_flashdata('pesan', '<div class="alert alert-massege alert-danger" role="alert">Silahkan Menghubungi Konfirmasi Ke Admin di Menu Kontak <br> Atau dalam 1x24 akan di hubungi oleh Admin</div>');
        //     redirect(base_url());
        // }
        if ($dtb == null) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-massege alert-danger" role="alert">Belum melakukan booking</div>');
            redirect(base_url());
        } else {
            // $data['tempo'] = $this->ModelBooking->getTempo()->result_array();
            $data['tempo'] = $this->db->query("select*from tempo where id_user='$idku'")->result_array();
            // $data['tempo'] = $this->db->query("select image, luas_t, luas_b, listrik, alamat, no_telp, deskripsi, harga,id_kontrak from tempo where id_user='$idku'")->result_array();
        }

        $this->form_validation->set_rules('bank_rek', 'Nama Bank', 'required|min_length[3]', [
            'required' => 'Nama Bank harus diisi',
            'min_length' => 'Nama Bank terlalu pendek'
        ]);
        $this->form_validation->set_rules(
            'no_rek',
            'No Rekening',
            'required|numeric',
            [
                'required' => 'No Rekening harus diisi',
                'numeric' => 'Yang diisi Harus Angka'
            ]
        );
        // $this->form_validation->set_rules(
        //     'image',
        //     'Bukti',
        //     'required'
        // );

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './style/img/bukti/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']    = '2048';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        // $config['max_size'] = '6000';
        // $config['max_width'] = '4048';
        // $config['max_height'] = '2024';
        $config['file_name'] = 'img' . time();
        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $data['judul'] = "Data Booking";
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('booking/index', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
                // echo "Gagal Upload";
                // die();
            } else {
                $gambar = $this->input->post('image', TRUE);
            }


            $data = [
                // 'id_booking' => $this->ModelBooking->kodeOtomatis('booking', 'id_booking'),
                // 'nama' => $this->input->post('nama', true),
                'bank_rek' => $this->input->post('bank_rek', true),
                'no_rek' => $this->input->post('no_rek', true),
                'image' => $gambar
            ];
            $this->ModelBooking->insertData('rekening', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Telah Berhasil Menambahkan Bukti Transfer</div>');
            redirect('booking');
        }
    }

    public function tambahBooking()
    {
        $id_kontrak = $this->uri->segment(3);
        //memilih data rumah yang untuk dimasukkan ke tabel tempo/keranjang melaluivariabel $isi
        $d = $this->db->query("Select*from kontrak where id='$id_kontrak'")->row();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $idku =  $user['id'];
        // $ci = get_instance();
        // $id = $ci->session->userdata('id');

        //berupa data2 yang akan disimpan ke dalam tabel tempo/keranjang
        $isi = [
            'tgl_booking' => date('Y-m-d H:i:s'),
            'id_user' => $user['id'],
            'id_pemilik' => $d->id_user,
            'email_user' => $this->session->userdata('email'),
            'id_kontrak' => $id_kontrak,
            'luas_b' => $d->luas_b,
            'luas_t' => $d->luas_t,
            'listrik' => $d->listrik,
            'alamat' => $d->alamat,
            'deskripsi' => $d->deskripsi,
            'no_telp' => $d->no_telp,
            'harga' => $d->harga,
            'durasi' => $d->durasi,
            'image' => $d->image
        ];
        //cek apakah rumah yang di klik booking sudah ada di keranjang
        // $temp = $this->ModelBooking->getDataWhere('tempo', ['id_kontrak' => $id_kontrak])->num_rows();
        $temp = $this->ModelBooking->getDataWhere('tempo', ['id_user' => $idku])->num_rows();
        // //cek jika sudah memasukan 1 kos untuk dibooking dalam keranjang
        $tempouser = $this->db->query("select*from tempo where id_user ='$idku'")->num_rows();
        // $tempuser = $this->ModelBooking->getTempo($userid)->row_array();
        // $tempuser = $this->db->query("SELECT*FROM tempo WHERE id_user ='$userid'")->num_rows();
        //cek jika masih ada booking kos yang belum diambil
        // $userid = $this->session->userdata('id_user');
        // $databooking = $this->db->query("select*from booking where id_user='$userid'")->num_rows();
        if ($this->db->query("select*from booking where id_user='$idku'")->num_rows() > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Masih Ada booking kos sebelumnya yang belum ditempati.</div>');
            redirect(base_url());
        }
        //jika rumah yang akan dibooking sudah mencapai 1 item
        // if ($tempouser >= 1) {
        //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Booking Kos Tidak Boleh Lebih dari 1</div>');
        //     redirect('home');
        // }
        //jika buku yang diklik booking sudah ada di keranjang
        // if ($temp > 0) {
        //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Rumah ini Sudah anda booking </div>');
        //     redirect(base_url() . 'home');
        // }

        if ($tempouser == 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Booking rumah tidak boleh lebih dari 1 </div>');
            redirect('home');
            // if ($this->ModelBooking->getTempo($this->session->userdata('id_user'))->row_array() > 1) {
            //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Booking rumah tidak boleh lebih dari 1 </div>');
            //     redirect('home');
        }
        if ($temp > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Rumah ini Sudah anda booking </div>');
            redirect(base_url() . 'home');
        }
        if ($d->stok < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Rumah sedang ditempati </div>');
            redirect('home');
        }
        //membuat tabel tempo jika belum ada
        // $this->ModelBooking->createTemp();
        $this->ModelBooking->insertData('tempo', $isi);
        //pesan ketika berhasil memasukkan rumah ke keranjang
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Rumah berhasil ditambahkan ke keranjang </div>');
        redirect(base_url() . 'home');
    }
    public function hapusbooking()
    {
        $id_kontrak = $this->uri->segment(3);
        // $id_user = $this->session->userdata('id_user');
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $idku =  $user['id'];

        $this->ModelBooking->deleteData(['id_user' => $idku], 'tempo');
        $kosong = $this->db->query("select*from tempo where id_user='$idku'")->num_rows();
        if ($kosong < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-massege alert-danger" role="alert">Tidak Ada Rumah dikeranjang</div>');
            redirect(base_url());
        } else {
            redirect(base_url() . 'booking');
        }
    }
    public function bookingSelesai($where)
    {
        $d = $this->db->query("Select*from tempo where id_user='$where'")->row();
        //mengupdate stok dan dibooking di tabel kontak saat proses booking diselesaikan
        $this->db->query("UPDATE kontrak, tempo SET kontrak.dibooking=kontrak.dibooking+1, kontrak.stok=kontrak.stok-1 WHERE kontrak.id=tempo.id_kontrak");
        $tglsekarang = date('Y-m-d');
        $this->form_validation->set_rules('waktu', 'Waktu', 'required');
        if ($this->form_validation->run() == false) {
            redirect('booking');
        } else {

            $isibooking = [
                'id_booking' => $this->ModelBooking->kodeOtomatis('booking', 'id_booking'),
                'tgl_booking' => date('Y-m-d H:m:s'),
                // 'batas_ambil' => date('Y-m-d', strtotime('+1 days', strtotime($tglsekarang))),
                'batas_ambil' => $this->input->post('waktu', TRUE),
                'id_user' => $where,
                'id_pemilik' => $d->id_pemilik
            ];

            //menyimpan ke tabel booking dan detail booking, dan mengosongkan tabel temporari
            $this->ModelBooking->insertData('booking', $isibooking);
            $this->ModelBooking->simpanDetail($where);
            $this->ModelBooking->kosongkanData('tempo');
            redirect(base_url() . 'booking/transfer');
        }
    }
    public function info()
    {
        $where = $this->session->userdata('id_user');
        $data['user'] = $this->session->userdata('nama');
        $data['judul'] = "Selesai Booking";
        $data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result();
        $data['items'] = $this->db->query("select*from booking bo, booking_detail d, kontrak ko where d.id_booking=bo.id_booking and d.id_kontrak=ko.id and bo.id_user='$where'")->result_array();

        // $this->form_validation->set_rules('bank_rek', 'Nama Bank', 'required|min_length[3]', [
        //     'required' => 'Nama Bank harus diisi',
        //     'min_length' => 'Nama Bank terlalu pendek'
        // ]);
        // $this->form_validation->set_rules(
        //     'no_rek',
        //     'No Rekening',
        //     'required|numeric',
        //     [
        //         'required' => 'No Rekening harus diisi',
        //         'numeric' => 'Yang diisi Harus Angka'
        //     ]
        // );
        // // $this->form_validation->set_rules(
        // //     'image',
        // //     'Bukti',
        // //     'required'
        // // );

        // //konfigurasi sebelum gambar diupload
        // $config['upload_path'] = './style/img/bukti/';
        // $config['allowed_types'] = 'jpg|png|jpeg';
        // $config['max_size']    = '2048';
        // $config['max_width'] = '1024';
        // $config['max_height'] = '1000';
        // // $config['max_size'] = '6000';
        // // $config['max_width'] = '4048';
        // // $config['max_height'] = '2024';
        // $config['file_name'] = 'img' . time();
        // $this->load->library('upload', $config);

        // if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('booking/info-booking', $data);
        $this->load->view('templates/footer');
        //     } else {
        //         if ($this->upload->do_upload('image')) {
        //             $image = $this->upload->data();
        //             $gambar = $image['file_name'];
        //             // echo "Gagal Upload";
        //             // die();
        //         } else {
        //             $gambar = $this->input->post('image', TRUE);
        //         }


        //         $data = [
        //             'id_booking' => $this->ModelBooking->kodeOtomatis('booking_detail', 'id_booking'),
        //             'nama' => $this->input->post('nama', true),
        //             'bank_rek' => $this->input->post('bank_rek', true),
        //             'no_rek' => $this->input->post('no_rek', true),
        //             'image' => $gambar
        //         ];
        //         $this->ModelBooking->insertData('rekening', $data);
        //         $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Telah Berhasil Menambahkan Bukti Transfer dan Segera Hubungi Admin</div>');
        //         redirect('booking/info');
        // }
    }
    public function exportToPdf()
    {
        $id_user = $this->session->userdata('id_user');
        $data['user'] = $this->session->userdata('nama');
        $data['judul'] = "Cetak Bukti Booking";
        $data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result();
        $data['items'] = $this->db->query("select*from booking bo, booking_detail d, kontrak bu where d.id_booking=bo.id_booking and d.id_kontrak=bu.id and bo.id_user='$id_user'")->result_array();

        $this->load->library('dompdf_gen');

        $this->load->view('booking/bukti-pdf', $data);

        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("bukti-booking-$id_user.pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan
    }


    public function transfer()
    {
        // $where = $this->session->userdata('id_user');
        // $data['user'] = $this->session->userdata('nama');
        // $data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result();
        $data['judul'] = "Selesai Booking";
        $data['pengguna'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $user['nama'];
        $idku = $user['id'];
        $data['items'] = $this->db->query("select*from booking bo, booking_detail d, kontrak ko where d.id_booking=bo.id_booking and d.id_kontrak=ko.id and bo.id_user='$idku'")->result_array();
        $booking = $this->db->query("select*from booking where id_user='$idku'")->row_array();
        $id_booking = $booking['id_booking'];
        $this->form_validation->set_rules('nama_rek', 'Nama', 'required|min_length[3]', [
            'required' => 'Nama harus diisi',
            'min_length' => 'Nama terlalu pendek'
        ]);
        $this->form_validation->set_rules('bank_rek', 'Nama Bank', 'required|min_length[3]', [
            'required' => 'Nama Bank harus diisi',
            'min_length' => 'Nama Bank terlalu pendek'
        ]);
        $this->form_validation->set_rules(
            'no_rek',
            'No Rekening',
            'required|numeric',
            [
                'required' => 'No Rekening harus diisi',
                'numeric' => 'Yang diisi Harus Angka'
            ]
        );
        $this->form_validation->set_rules(
            'no_telp',
            'No Telepon',
            'required|numeric',
            [
                'required' => 'No Telepon harus diisi',
                'numeric' => 'Yang diisi Harus Angka'
            ]
        );

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/bukti/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();
        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('booking/transfer', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('bukti')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
                // echo "Gagal Upload";
                // die();
            } else {
                $gambar = $this->input->post('bukti', TRUE);
            }


            $data = [
                'id_booking' => $id_booking,
                'id_pemesan' => $idku,
                'nama_rek' => $this->input->post('nama_rek', true),
                'bank_rek' => $this->input->post('bank_rek', true),
                'no_rek' => $this->input->post('no_rek', true),
                'no_telp' => $this->input->post('no_telp', true),
                'bukti' => $gambar
            ];
            $this->ModelBooking->insertData('rekening', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Telah Berhasil Menambahkan Bukti Transfer dan Segera Hubungi Admin</div>');
            redirect('home');
        }
    }

    public function cetak_bukti()
    {
        $data['judul'] = "Cetak Bukti";
        $data['pengguna'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $user['nama'];
        $idku = $user['id'];
        $data['items'] = $this->db->query("select*from booking bo, booking_detail d, kontrak ko where d.id_booking=bo.id_booking and d.id_kontrak=ko.id and bo.id_user='$idku'")->result_array();
        $data['rek'] = $this->db->query("select*from rekening where id_pemesan='$idku'")->row_array();

        $this->load->view('booking/bukti_booking', $data);
    }
}
