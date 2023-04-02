<?php
class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data = [
            'judul' => "Home",
            'sewa' => $this->ModelSewa->getKontrak()->result(),
        ];
        //jika sudah login dan jika belum login
        if ($this->session->userdata('email')) {
            $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
            $data['user'] = $user['nama'];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sewa/daftar', $data);
            $this->load->view('templates/footer');
        } else {
            $data['user'] = 'Pengunjung';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sewa/daftar', $data);
            $this->load->view('templates/footer');
        }
    }

    public function detailSewa()
    {
        $id = $this->uri->segment(3);

        $sewa = $this->db->query("SELECT*FROM kontrak  WHERE id='$id'")->result();
        // $kos = $this->ModelKos->getKos(['kos.id' => $id])->result();
        $data['judul'] = "Detail Kontrakan";
        foreach ($sewa as $s) {
            $data['id'] = $s->id;
            $data['luas_t'] = $s->luas_t;
            $data['luas_b'] = $s->luas_b;
            $data['listrik'] = $s->listrik;
            $data['deskripsi'] = $s->deskripsi;
            $data['no_telp'] = $s->no_telp;
            $data['harga'] = $s->harga;
            $data['durasi'] = $s->durasi;
            $data['alamat'] = $s->alamat;
            $data['image'] = $s->image;
            $data['image2'] = $s->image2;
            $data['image3'] = $s->image3;
            $data['ditempati'] = $s->ditempati;
            $data['dibooking'] = $s->dibooking;
            $data['stok'] = $s->stok;
        }
        if ($this->session->userdata('email')) {
            $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
            $data['user'] = $user['nama'];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sewa/detail-sewa', $data);
            $this->load->view('templates/footer');
        } else {
            $data['user'] = "Pengunjung";
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sewa/detail-sewa', $data);
            $this->load->view('templates/footer');
        }
    }

    public function konfirmasi()
    {
        // $id_booking = $this->uri->segment(3);
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $idku = $user['id'];
        $status = 'Sudah menempati';

        $this->db->set('status_konfir', $status);
        $this->db->where('id_user', $idku);
        $this->db->update('konfirmasi');
        $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-success" role="alert">Konfirmasi rumah telah berhasil. Terima Kasih!</div>');
        redirect(base_url() . 'home');
    }

    public function tentang()
    {
        $data = [
            'judul' => "Tentang"
        ];
        if ($this->session->userdata('email')) {
            $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
            $data['user'] = $user['nama'];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('home/tentang', $data);
            $this->load->view('templates/footer');
        } else {
            $data['user'] = 'Pengunjung';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('home/tentang', $data);
            $this->load->view('templates/footer');
        }
    }
    // public function tentang()
    // {
    //     $data = [
    //         'judul' => "Tentang Kami"
    //     ];
    //     if ($this->session->userdata('email')) {
    //         $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    //         $data['user'] = $user['nama'];
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('kos/tentang', $data);
    //         $this->load->view('templates/modal');
    //         $this->load->view('templates/footer');
    //     } else {
    //         $data['user'] = 'Pengunjung';
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('kos/tentang', $data);
    //         $this->load->view('templates/modal');
    //         $this->load->view('templates/footer');
    //     }
    // }
}
