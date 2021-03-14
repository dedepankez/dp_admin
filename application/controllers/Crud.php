<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud extends CI_Controller
{
    //Memaksa ke controler login jika user iseng menuju url admin
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model', 'sm');
         $this->load->model('Site_model', 'st');
        
    }


    public function example()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Crud Examples';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('crud/index');
        $this->load->view('templates/footer');
        $this->load->view('crud/js/crud_js');
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
                        
                        <a href='detail/$field->id' class='dropdown-item'>Detail</a>
                        <a href='ubah/$field->id' class='dropdown-item'>Edit</a>
                        <a href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" class='dropdown-item' id='hapus-sm' data-id='$field->id'>Hapus</a>
                    </div>
                </div>";

                // Memanggil data dari tabel surat_masuk
                $row[] = $no;
                $row[] = $field->no_agenda;
                $row[] = $field->pengirim;
                $row[] = $field->no_surat;
                $row[] = date('d/m/Y', strtotime($field->tgl_surat));
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
        $this->template->render_page('crud/detail', $data);
    }

    public function tambah()
    {
        
        $this->form_validation->set_rules('no_agenda', 'No. Agenda', 'required|numeric|is_unique[surat_masuk.no_agenda]');
        $this->form_validation->set_rules('no_surat', 'No. Surat', 'required');
        $this->form_validation->set_rules('pengirim', 'Pengirim', 'required');
        $this->form_validation->set_rules('isi', 'Isi Ringkas', 'required|max_length[300]');
        $this->form_validation->set_rules('tgl_surat', 'Tanggal Surat', 'required');
        $this->form_validation->set_rules('tgl_diterima', 'Tanggal Diterima', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Tambah Surat Masuk'
            ];
            $data['config'] = $this->st->site_config();
            $this->template->render_page('crud/tambah', $data);
        } else {
            // jika validasi lolos, insert data
            $this->sm->insert();
        }
    }

    public function hapus()
    {
        $id = $this->input->post('id');
        $data['surat'] = $this->sm->getSuratMasuk($id);

        $data['config'] = $this->st->site_config();
        
        $this->db->delete('surat_masuk', ['id' => $id]);
        $this->session->set_flashdata('msg', 'dihapus.');

        // Hapus file di folder uploads
        unlink(FCPATH . './uploads/' . $data['surat']['file']);
        redirect('crud/example');
    }

    public function Ubah($id)
    {
        $noAgenda = $this->input->post('no_agenda');
        $sm = $this->sm->getSuratMasuk($id);
        if ($sm['no_agenda'] == $noAgenda) {
            $ruleAgenda = 'required|numeric';
        } else {
            $ruleAgenda = 'required|numeric|is_unique[surat_masuk.no_agenda]';
        }
        $this->form_validation->set_rules('no_agenda', 'No. Agenda', $ruleAgenda);
        $this->form_validation->set_rules('no_surat', 'No. Surat', 'required');
        $this->form_validation->set_rules('pengirim', 'Pengirim', 'required');
        $this->form_validation->set_rules('isi', 'Isi Ringkas', 'required|max_length[300]');
        $this->form_validation->set_rules('tgl_surat', 'Tanggal Surat', 'required');
        $this->form_validation->set_rules('tgl_diterima', 'Tanggal Diterima', 'required');

        if ($this->form_validation->run() == FALSE) {

            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Ubah Surat Masuk',
                'surat' => $this->sm->getSuratMasuk($id)
            ];
            $data['config'] = $this->st->site_config();
            $this->template->render_page('crud/ubah', $data);
        } else {
            // jika validasi lolos, insert data
            $this->sm->ubah();
        }
    }

    // filter per tanggal
        public function filter(){

        $this->form_validation->set_rules('startdate', 'Field diatas', 'required');
        $this->form_validation->set_rules('enddate', 'Field diatas', 'required');

        if ($this->form_validation->run() == false) {
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Report Example',
            ];
            $data['config'] = $this->st->site_config();
            $this->template->render_page('crud/filter', $data);
        } else {
            $startdate = $this->input->post('startdate', true);
            $enddate = $this->input->post('enddate', true);

                $data = [
                    'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                    'title' => 'Report Example',
                    'surat_masuk' => $this->sm->getSmByDate([$startdate, $enddate])
                ];
                $data['config'] = $this->st->site_config();
                $this->template->render_page('crud/filter', $data);
        }
    }




//print all
    public function print(){
        $data['print']= $this->sm->print_crud("surat_masuk")->result();
        $this->load->view('crud/print',$data);
    }
    // debug
    public function print_period()
    {

            $startdate = $this->input->post('startdate', true);
            $enddate = $this->input->post('enddate', true);
            $data['config'] = $this->st->site_config();
                $data = [
                    'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                    'title' => 'Report Example',
                    'surat_masuk' => $this->sm->print_period([$startdate, $enddate])
                ];
        
                $this->load->view('crud/print_period', $data);
        }
    

    
        
    

    
}