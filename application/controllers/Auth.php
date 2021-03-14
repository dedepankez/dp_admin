<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    //Method Constructer
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Site_model','st');
    }
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['config'] = $this->st->site_config();
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header1', $data);
            $this->load->view('auth/login1');
            $this->load->view('templates/auth_footer1');
        } else {
            //validasi succes
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        // jika usernya ada
        if ($user) {

            //jika user aktif
            if ($user['is_active'] == 1) {

                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    //cek role id
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {

                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong Password! </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            This Email Has Not Been Activated! </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email Is Not Registered! </div>');
            redirect('auth');
        }
    }




    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This Email Already Registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match !',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['config'] = $this->st->site_config();
            $data['title'] = 'Registration';
            $this->load->view('templates/auth_header1', $data);
            $this->load->view('auth/registration1');
            $this->load->view('templates/auth_footer1');
        } else {
            echo 'Data Berhasil Ditambahkan !';
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()

            ];
            $this->db->insert('user', $data);
            // $this->_sendEmail();
            $this->session->set_flashdata('message', '<small class="alert alert-success" role="alert">
            Congratulation Your Account Has Been Created, Please Login! </small>');
            redirect('auth');
        }
    }

    // private  function _sendEmail()
    // {
    //     $config =  [
    //         'mailtype'  => 'html',
    //         'charset'   => 'utf-8',
    //         'protocol'  => 'smtp',
    //         'smtp_host' => 'smtp.gmail.com',
    //         'smtp_user' => 'derinhoalvarez@gmail.com',  // Email gmail
    //         'smtp_pass'   => 'Pankez74',  // Password gmail
    //         'smtp_crypto' => 'tsl',
    //         'smtp_port'   => 587,
    //         'crlf'    => "\r\n",
    //         'newline' => "\r\n"

    //     ];

    //     $this->load->library('email', $config);

    //     $this->email->from('derinhoalvarez@gmail.com', 'Dp_Admin');
    //     $this->email->to('dedeiir111213@gmail.com');
    //     $this->email->subject('Test');
    //     $this->email->message('Hello World!');

    //     if ($this->email->send()) {
    //         return true;
    //     } else {
    //         echo $this->email->print_debugger();
    //         die;
    //     }
    // }






    public function logout()
    {

        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            You Have Been Logged Out! </div>');
        redirect('frontend');
    }


    public function blocked()
    {

        $this->load->view('auth/blocked');
    }
}
