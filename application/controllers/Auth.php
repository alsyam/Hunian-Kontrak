<?php
class Auth extends CI_Controller
{

    public function index()
    {
        //jika statusnya sudah login, maka tidak bisa mengakses halaman login alias dikembalikan ke tampilan user
        if ($this->session->userdata('email')) {
            redirect('admin');
        }

        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email', [
            'required' => 'Email Harus diisi!!',
            'valid_email' => 'Email Tidak Benar!!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Kata Sandi Harus diisi!!'
        ]);
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Login';
            $data['user'] = '';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $email = htmlspecialchars($this->input->post(
            'email',
            true
        ));
        $password = $this->input->post('password', true);
        $user = $this->ModelUser->cekData(['email' => $email])->row_array();
        //jika usernya ada
        if ($user) {
            //jika user sudah aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('sewa');
                    } else {
                        if ($user['image'] == 'default.jpg') {
                            $this->session->set_flashdata(
                                'pesan',
                                '<div class="alert alert-info alert-message" role="alert">Silahkan Ubah Profile Anda untuk Ubah Photo Profil</div>'
                            );
                        }
                        redirect('home');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">User belum diaktifasi!!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>');
            redirect('auth');
        }
    }

    public function registrasi()
    {
        // if ($this->session->userdata('email')) {
        //     redirect('user');
        // }
        //membuat rule untuk inputan nama agar tidak boleh kosong dengan membuat pesan error dengan
        //bahasa sendiri yaitu 'Nama Belum diisi'
        $this->form_validation->set_rules(
            'nama',
            'Nama Lengkap',
            'required',
            [
                'required' => 'Nama Belum diisi!!'
            ]
        );
        //membuat rule untuk inputan email agar tidak boleh kosong, tidak ada spasi, format email harus valid
        //dan email belum pernah dipakai sama user lain dengan membuat pesan error dengan bahasa sendiri
        //yaitu jika format email tidak benar maka pesannya 'EmailTidak Benar!!'. jika email belum diisi,
        //maka pesannya adalah 'Email Belum diisi', dan jika email yang diinput sudah dipakai user lain,
        //maka pesannya 'Email Sudah dipakai'
        $this->form_validation->set_rules(
            'alamat',
            'Alamat Lengkap',
            'required',
            [
                'required' => 'Alamat Belum diisi!!'
            ]
        );
        $this->form_validation->set_rules(
            'no_telp',
            'No Telepon',
            'required',
            [
                'required' => 'No Telepon Belum diisi!!'
            ]
        );

        $this->form_validation->set_rules(
            'email',
            'Alamat Email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'valid_email' => 'Email Tidak Benar!!',
                'required' => 'Email Belum diisi!!',
                'is_unique' => 'Email Sudah Terdaftar!'
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'required' => 'Kata Sandi Belum diisi!!',
                'matches' => 'Kata Sandi Tidak Sama!!',
                'min_length' => 'Kata Sandi Terlalu Pendek'
            ]
        );
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');
        //jika jida disubmit kemudian validasi form diatas tidak berjalan, maka akan tetap berada di
        //tampilan registrasi. tapi jika disubmit kemudian validasi form diatas berjalan, maka data yang
        //diinput akan disimpan ke dalam tabel user
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Registrasi';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'alamat' => $this->input->post('alamat', true),
                'no_telp' => $this->input->post('no_telp', true),
                'rek' => 0,
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'tanggal_input' => time()
            ];
            $this->ModelUser->simpanData($data); //menggunakan model

            $this->session->set_flashdata('pesan', '<div
class="alert alert-success alert-message" role="alert">Selamat!!
akun member anda sudah dibuat. Silahkan Login</div>');
            redirect('auth');
        }
    }

    public function regisPemilik()
    {
        // if ($this->session->userdata('email')) {
        //     redirect('user');
        // }
        //membuat rule untuk inputan nama agar tidak boleh kosong dengan membuat pesan error dengan
        //bahasa sendiri yaitu 'Nama Belum diisi'
        $this->form_validation->set_rules(
            'nama',
            'Nama Lengkap',
            'required',
            [
                'required' => 'Nama Belum diisi!!'
            ]
        );
        //membuat rule untuk inputan email agar tidak boleh kosong, tidak ada spasi, format email harus valid
        //dan email belum pernah dipakai sama user lain dengan membuat pesan error dengan bahasa sendiri
        //yaitu jika format email tidak benar maka pesannya 'EmailTidak Benar!!'. jika email belum diisi,
        //maka pesannya adalah 'Email Belum diisi', dan jika email yang diinput sudah dipakai user lain,
        //maka pesannya 'Email Sudah dipakai'
        $this->form_validation->set_rules(
            'alamat',
            'Alamat Lengkap',
            'required',
            [
                'required' => 'Alamat Belum diisi!!'
            ]
        );
        $this->form_validation->set_rules(
            'no_telp',
            'No Telepon',
            'required',
            [
                'required' => 'No Telepon Belum diisi!!'
            ]
        );
        $this->form_validation->set_rules(
            'rek',
            'No Rekening',
            'required',
            [
                'required' => 'No Rekening Belum diisi!!'
            ]
        );

        $this->form_validation->set_rules(
            'email',
            'Alamat Email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'valid_email' => 'Email Tidak Benar!!',
                'required' => 'Email Belum diisi!!',
                'is_unique' => 'Email Sudah Terdaftar!'
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'required' => 'Kata Sandi Belum diisi!!',
                'matches' => 'Kata Sandi Tidak Sama!!',
                'min_length' => 'Kata Sandi Terlalu Pendek'
            ]
        );
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');
        //jika jida disubmit kemudian validasi form diatas tidak berjalan, maka akan tetap berada di
        //tampilan registrasi. tapi jika disubmit kemudian validasi form diatas berjalan, maka data yang
        //diinput akan disimpan ke dalam tabel user
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Registrasi Pemilik';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/regis-pemilik');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'alamat' => $this->input->post('alamat', true),
                'no_telp' => $this->input->post('no_telp', true),
                'rek' => $this->input->post('rek', true),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 3,
                'is_active' => 1,
                'tanggal_input' => time()
            ];
            $this->ModelUser->simpanData($data); //menggunakan model

            $this->session->set_flashdata('pesan', '<div
class="alert alert-success alert-message" role="alert">Selamat!!
akun member anda sudah dibuat. Silahkan Aktivasi Akun anda</div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        // $this->session->unset_userdata('id');
        // $this->session->unset_userdata('email');
        // $this->session->unset_userdata('role_id');
        $this->session->sess_destroy();

        $this->session->set_flashdata('pesan', '<div
class="alert alert-success alert-message" role="alert">Terima kasih telah berkunjung ke web kami</div>');
        redirect('auth');
    }
}
