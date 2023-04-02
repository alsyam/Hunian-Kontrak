<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed');
class Pesan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['ModelUser', 'ModelBooking', 'ModelSewa', 'ModelPesan']);
        cek_login();
        cek_user();
    }
    public function index()
    {
        $data['judul'] = "Data Pesan";
        $data['pesan'] = $this->ModelPesan->joinData();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $user['nama'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pesan/index', $data);
        $this->load->view('templates/footer');
    }
    public function konfir()
    {
        $data['judul'] = "Data Pesan";
        $data['konfirmasi'] = $this->db->query("select*from konfirmasi")->result_array();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $user['nama'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pesan/konfir', $data);
        $this->load->view('templates/footer');
    }
    public function daftarBooking()
    {
        $data['judul'] = "Daftar Booking";
        $data['pesan'] = $this->ModelPesan->joinDataBo();
        // $data['pesan'] = $this->db->query("select*from booking")->result_array();
        // $data['sewa'] = $this->db->query("select*from kontrak")->row_array();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $id = $user['id'];
        // $data['pesan'] = $this->ModelPesan->joinData()->result_array();
        // $data['kontrak'] = $this->ModelPesan->joinKontrak()->row_array();
        // $data['kontrak'] = $this->db->query("select*from booking_detail , kontrak  where booking_detail.id_kontrak=kontrak.id and kontrak.id_user='$id'")->row_array();
        // $data['kontrak'] = $this->db->query("SELECT*FROM booking_detail LEFT JOIN kontrak ON booking_detail.id_kontrak=kontrak.id");
        // $data['kon'] = $this->ModelPesan->joinTiga()->result_array();
        $data['user'] = $user['nama'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('booking/daftar_booking', $data);
        $this->load->view('templates/footer');
    }
    public function bookingDetail()
    {
        // $where = ['id_booking' => $this->uri->segment(3)];
        // $data['bukti'] = $this->ModelPesan->getData('rekening',['id_booking' => $this->uri->segment(3)]);
        $id_booking = $this->uri->segment(3);
        $data['judul'] = "Booking Detail";
        // $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        // $data['pengguna'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $user['nama'];
        // $idku = $user['id'];
        $pemesan = $this->db->query("select*from booking where id_booking='$id_booking'")->row_array();
        $data['booking'] = $pemesan['id_booking'];
        $data['items'] = $this->db->query("select*from booking bo, booking_detail d, kontrak ko where d.id_booking=bo.id_booking and d.id_kontrak=ko.id and bo.id_booking='$id_booking'")->result_array();
        // $data['rek'] = $this->db->query("select*from rekening where id_pemesan='$idku'")->row_array();
        // $data['bukti'] = $this->db->query("SELECT*FROM rekening WHERE id_booking='$id_booking'")->result();
        // $data['agt_booking'] = $this->db->query("select*from booking b, user u where b.id_user=u.id and b.id_booking='$id_booking'")->result_array();
        // $data['detail'] = $this->db->query("select*from booking_detail, kontrak where booking_detail.id_kos=kontrak.id and d.id_booking='$id_booking'")->result_array();
        // $data['bukti'] = $this->db->query("select image, bank_rek, no_rek from rekening where id_booking='$id_booking'")->result_array();
        // $data['bukti'] = $this->db->query("SELECT*FROM rekening, booking_detail where booking_detail.id_booking=rekening.id_booking and rekening.id_booking='$id_booking'")->result_array();
        // $data['bukti'] = $this->db->query("select image,bank_rek,no_rek from rekening where id_booking='$id_booking'")->result_array();
        // $data['bukti'] = $this->ModelPesan->joinBuk($id);
        // $bukti = $this->ModelPesan->joinRek(['rekening.id_booking' => $id_booking])->result();
        // $data['bukti'] = $this->ModelPesan->joinRek(['rekening.id_booking' => $id_booking])->result();
        // foreach ($bukti as $fields) {
        //     $data['bank_rek'] = $fields->bank_rek;
        //     $data['no_rek'] = $fields->no_rek;
        //     $data['image'] = $fields->image;
        // }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('booking/booking_detail', $data);
        $this->load->view('templates/footer');
    }
    public function hapusBooking()
    {
        $where = $this->uri->segment(3);
        // $d = $this->db->query("Select id_kontrak from booking_detail where id_booking='$where'")->row_array();
        $detail = $this->ModelPesan->joinDataBo(['id_booking' => $where]);
        $id = $detail['id_kontrak'];
        $this->ModelPesan->deleteData('booking', ['id_booking' => $where]);
        $this->ModelPesan->deleteData('booking_detail', ['id_booking' => $where]);
        $this->ModelPesan->deleteData('rekening', ['id_booking' => $where]);
        // $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        // $id = $user['id'];
        // $k = $this->db->query("Select*from kontrak where id_user='$id'")->row();
        // $dibooking = $k['dibooking'];
        // $stok = $k['stok'];
        // $data = [
        //     'stok' => $stok + 1,
        //     'dibooking' => $dibooking - 1
        // ];
        // $this->ModelPesan->updateKontrak($data, ['id' => $d]);


        // $this->ModelPesan->deleteData('kontrak', ['id_booking' => $where]);
        $this->db->query("UPDATE kontrak SET kontrak.dibooking=kontrak.dibooking-1, kontrak.stok=kontrak.stok+1 WHERE kontrak.id='$id'");
        redirect('pesan/daftarBooking');
    }
    public function pesanAct()
    {
        $id_booking = $this->uri->segment(3);
        // $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        // $idku = $user['id'];
        // $du = $this->db->query("SELECT*FROM kontrak WHERE id_user='$idku'")->row();
        $lama = $this->input->post('lama', TRUE);
        $bo = $this->db->query("SELECT*FROM booking WHERE id_booking='$id_booking'")->row();
        $tglsekarang = date('Y-m-d');
        $no_pesan = $this->ModelBooking->kodeotomatis('pesan', 'no_pesan');
        // $pemilik = $this->db->get('booking', ['id_booking' => $id_booking]);

        $databooking = [
            'no_pesan' => $no_pesan,
            'id_booking' => $id_booking,
            'tgl_pesan' => $tglsekarang,
            'id_user' => $bo->id_user,
            'tgl_kembali' => date('Y-m-d', strtotime('+' . $lama . ' days', strtotime($bo->batas_ambil))),
            'tgl_pengembalian' => '0000-00-00',
            'status' => 'Ditempati',
            'id_pemilik' => $bo->id_pemilik,
            'w_mulai' => $bo->batas_ambil
        ];
        $datakonfir = [
            'no_pesan' => $no_pesan,
            'id_user' => $bo->id_user,
            'status_konfir' => 'Belum menempati',
        ];
        $this->ModelPesan->simpanPesan($databooking);
        $this->ModelPesan->simpanKonfir($datakonfir);
        $this->ModelPesan->simpanDetail($id_booking, $no_pesan);
        //hapus Data booking yang  diambil untuk disewa
        $this->ModelPesan->deleteData('booking', ['id_booking' => $id_booking]);
        $this->ModelPesan->deleteData('booking_detail', ['id_booking' => $id_booking]);
        $this->ModelPesan->deleteData('rekening', ['id_booking' => $id_booking]);
        //$this->db->query("DELETE FROM booking WHERE id_booking='$id_booking'");
        //update dibooking dan dipinjam pada tabel buku saat buku yang dibooking diambil untuk dipinjam
        // $bd = $this->db->query("SELECT*FROM booking_detail WHERE id_booking='$id_booking'")->row();

        // $this->db->set('ditempati+1', 'dibooking-1');
        // $this->db->where('id', $bd->id_kontrak);
        // $this->db->update('kontrak');
        $this->db->query("UPDATE kontrak, detail_pesan SET kontrak.ditempati=kontrak.ditempati+1, kontrak.dibooking=kontrak.dibooking-1 WHERE kontrak.id=detail_pesan.id_kontrak");
        $this->db->query("UPDATE kontrak, booking_detail SET kontrak.ditempati=kontrak.ditempati+1, kontrak.dibooking=kontrak.dibooking-1 WHERE kontrak.id=booking_detail.id_kontrak");
        $this->db->query("UPDATE kontrak, pesan SET kontrak.ditempati=kontrak.ditempati+1, kontrak.dibooking=kontrak.dibooking-1 WHERE kontrak.id_user=pesan.id_pemilik");
        $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-success" role="alert">Data Pemesanan Berhasil Disimpan</div>');
        redirect(base_url() . 'pesan');
    }
    public function ubahStatus()
    {
        $id_kontrak = $this->uri->segment(3);
        $no_pesan = $this->uri->segment(4);
        $where = ['id_kontrak' => $this->uri->segment(3),];
        $tgl = date('Y-m-d');
        $status = 'Kosong';
        //update status menjadi kembali pada saat kos dikembalikan
        $this->db->query("UPDATE pesan, detail_pesan SET pesan.status='$status', pesan.tgl_pengembalian='$tgl' WHERE detail_pesan.id_kontrak='$id_kontrak' AND pesan.no_pesan='$no_pesan'");
        //update stok dan dipesan pada tabel kontrak
        $this->db->query("UPDATE kontrak, detail_pesan SET kontrak.ditempati=kontrak.ditempati-1, kontrak.stok=kontrak.stok+1 WHERE kontrak.id=detail_pesan.id_kontrak");
        $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-success" role="alert"></div>');
        redirect(base_url('pesan'));
    }

    // laporan

    public function cetak_laporan_pesan()
    {
        // $data['laporan'] = $this->db->query("select * from pesan p,detail_pesan d,
        //                         kos b,user u where d.id_kos=b.id and p.id_user=u.id
        //                         and p.no_pesan=d.no_pesan")->result_array();
        $data['laporan'] = $this->ModelPesan->joinData();

        $this->load->view('pesan/laporan_print_pesan', $data);
    }

    public function export_excel_pesan()
    {
        $data = array(
            'title' => 'Laporan Data Penyewaan Rumah',
            // 'laporan' => $this->db->query("select * from pesan p,detail_pesan d, kos b,user u where d.id_kos=b.id and p.id_user=u.id and p.no_pesan=d.no_pesan")->result_array()
        );
        $data['laporan'] = $this->ModelPesan->joinData();
        $this->load->view('pesan/laporan_excel_pesan', $data);
    }
}
