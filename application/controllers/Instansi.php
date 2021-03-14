<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instansi extends CI_Controller
{
    //Memaksa ke controler login jika user iseng menuju url admin
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Site_model', 'st');
    }


    public function index()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Instansi';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('instansi/index', $data);
        $this->load->view('templates/footer');
    }
    public function update_instansi(){

            $id = $this->input->post('id');
            $nama_instansi = $this->input->post('nama_instansi');
            $kepala_instansi = $this->input->post('kepala_instansi');
            $email_instansi = $this->input->post('email_instansi');
            $telp_instansi = $this->input->post('telp_instansi');
            $alamat_instansi = $this->input->post('alamat_instansi');


            $upload_image = $_FILES['logo_instansi']['name'];

            if ($upload_image) {
                $config['upload_path']          = './assets/img/profile';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('logo_instansi')) {
                    $old_image = $data['site_config']['logo_instansi'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }


                    $new_image = $this->upload->data('file_name');
                    $this->db->set('logo_instansi', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data  = array(
                'nama_instansi' => $nama_instansi,
                'email_instansi' => $email_instansi,
                'kepala_instansi' => $kepala_instansi,
                'telp_instansi' => $telp_instansi,
                'alamat_instansi' => $alamat_instansi



            );
            $where = array('id'=>$id);
            $this->load->model('Admin_model', 'admin');
            $this->admin->update_user($where,$data,'site_config');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Instansi Has Been Edit! </div>');
            redirect('instansi');
        
    }

     

}