<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dispo extends CI_Controller
{
    //Memaksa ke controler login jika user iseng menuju url admin
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dispo_model', 'sm');
         $this->load->model('Site_model', 'st');
        
    }


    public function index()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Disposisi';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('disposisi/index');
        $this->load->view('templates/footer');
        $this->load->view('disposisi/js/dispo_js');
    }
    public function ambilData()
    {
       

        // jika ada request ajax yang dikirimkan
        if ($this->input->is_ajax_request() == true) {
            // ambil data dari table

            $list = $this->sm->get_datatables();
            $data = [];
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = [];

                // tombol aksi
                $btnAction = "<div class=\"dropdown\">
                    <button class=\"btn btn-sm btn-info dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        <i class=\"fa fa-fw fa-list\"></i>
                    </button>
                    <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                        
                        <a href='surat_masuk/lihat_disposisi/$field->id' class='dropdown-item'><i class='fa fa-eye'></i> Detail</a>
                        <a href='surat_masuk/cetak_disposisi/$field->id' class='dropdown-item text-warning'><i class='fa fa-print'></i> Cetak</a>
                        <a href='dispo/hapus_disposisi/$field->id' class='dropdown-item text-danger'><i class='fa fa-trash'></i> Hapus</a>
                        
                    </div>
                </div>";
                

                // Memanggil data dari tabel surat_masuk
                $row[] = $no;
                $row[] = $field->agenda;
                $row[] = $field->no;
                $row[] = $field->kurir;
                $row[] = $field->tujuan;
                $row[] = $field->sifat;
                $row[] = $btnAction;
                $data[] = $row;
            }

            $output = [
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->sm->count_all(),
                "recordsFiltered" => $this->sm->count_filtered(),
                "data" => $data,
            ];
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    public function detail($id)
    {
        
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'title' => 'Detail Surat Masuk',
            'surat' => $this->sm->getSuratMasuk($id),
        ];
        $data['config'] = $this->st->site_config();
        $this->template->render_page('surat_masuk/detail', $data);
    }


    public function hapus_disposisi($id){
        
        $where  = array('id' =>$id );
        $this->load->model('Admin_model', 'admin');
        $this->admin->delete_user($where,'disposisi');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
             Disposisi Has been Delete! </div>');
            redirect('dispo');
    }

    public function cetak(){
        $data['dispo'] = $this->sm->join_dispo();
        $this->load->view('agenda/disposisi_cetak',$data);
    }

    
}