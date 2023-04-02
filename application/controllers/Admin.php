<?php
class Admin extends CI_Controller
{

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('admin/index');
        $this->load->view('templates/footer');
    }
}
