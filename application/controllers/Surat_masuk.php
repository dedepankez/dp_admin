<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_masuk extends CI_Controller
{
    //Memaksa ke controler login jika user iseng menuju url admin
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Suratmasuk_model', 'sm');
         $this->load->model('Site_model', 'st');
        
    }


    public function index()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Surat Masuk';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('surat_masuk/index');
        $this->load->view('templates/footer');
        $this->load->view('surat_masuk/js/surat_masuk_js');
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
                        <a href='surat_masuk/disposisi/$field->id' class='dropdown-item text-success'><i class='fas fa-vote-yea'></i> Disposisi</a>
                        <a href='surat_masuk/detail/$field->id' class='dropdown-item'><i class='fa fa-eye'></i> Detail</a>
                        <a href='surat_masuk/ubah/$field->id' class='dropdown-item text-warning'><i class='fa fa-edit'></i> Edit</a>
                        <a href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" class='dropdown-item text-danger' id='hapus-sm' data-id='$field->id'><i class='fa fa-trash'></i> Hapus</a>
                    </div>
                </div>";
                $image = "<div> <a href='surat_masuk/lihat_file/$field->id'>
                
                $field->file
                </a>
                 </div>";

                // Memanggil data dari tabel surat_masuk
                $row[] = $no;
                $row[] = $field->code;
                $row[] = $field->no_agenda;
                $row[] = $field->pengirim;
                $row[] = $field->no_surat;
                $row[] = date('d/m/Y', strtotime($field->tgl_surat));
                $row[] = $field->file==NULL?"<strong class='text-danger'>FILE KOSONG</strong>": $image;
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
            $data['klasifikasi'] = $this->sm->tampil_data_klasifikasi()->result_array();
            $this->template->render_page('surat_masuk/tambah', $data);
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
        redirect('surat_masuk');
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
            $data['klasifikasi'] = $this->sm->tampil_data_klasifikasi()->result_array();
            $data['config'] = $this->st->site_config();
            $this->template->render_page('surat_masuk/ubah', $data);
        } else {
            // jika validasi lolos, insert data
            $this->sm->ubah();
        }
    }

    public function disposisi($id)
    {
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Disposisi Surat',
                'disposisi' => $this->sm->getSuratMasuk($id),
                'isidis' => $this->sm->get_disposisi($id)
            ];
            $data['config'] = $this->st->site_config();
            $this->template->render_page('surat_masuk/disposisi', $data);
            
    }

    public function tambah_disposisi(){


        $id_surat_masuk = $this->input->post('id_surat_masuk');
        $perihal = $this->input->post('perihal');
        $tujuan = $this->input->post('tujuan');
        $isi = $this->input->post('isi');
        $sifat = $this->input->post('sifat');
        $batas_waktu = $this->input->post('batas_waktu');
        $catatan = $this->input->post('catatan');
        $created_at = $this->input->post('created_at');
        $data =array(
            'id_surat_masuk' => $id_surat_masuk,
            'perihal' => $perihal,
            'tujuan' => $tujuan,
            'isi' => $isi,
            'sifat' => $sifat,
            'batas_waktu' => $batas_waktu,
            'catatan' => $catatan,
            'created_at' => $created_at
    );
        $this->db->insert('disposisi',$data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Disposisi Telah Ditambahkan! </div>');
       redirect('dispo');

    }

    public function hapus_disposisi($id){
        
        $where  = array('id' =>$id );
        $this->load->model('Admin_model', 'admin');
        $this->admin->delete_user($where,'disposisi');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
             Disposisi Has been Delete! </div>');
            redirect('dispo');
    }


    public function lihat_file($id)
    {
        
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Galery File',
                'disposisi' => $this->sm->getSuratMasuk($id)
            ];
            $data['config'] = $this->st->site_config();
            $this->template->render_page('surat_masuk/lihat_file', $data);
    }

    public function lihat_disposisi($id)
    {
        
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Lembar Disposisi',
                'isidis' => $this->sm->get_disposisi($id),
                'join' => $this->sm->join($id)

            ];
            $data['config'] = $this->st->site_config();
            $this->load->view('surat_masuk/lihat_disposisi', $data);
    }

    public function cetak_disposisi($id)
    {
        
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Cetak Disposisi',
                'isidis' => $this->sm->get_disposisi($id),
                'join' => $this->sm->join($id)

            ];
            $data['config'] = $this->st->site_config();
            $this->load->view('surat_masuk/cetak_disposisi', $data);
    }


    public function agenda(){
        $this->load->library('pagination');

        //ambil data keywoard
        if($this->input->post('submit')){
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword',$data['keyword']);
        }else{
            $data['keyword'] = $this->session->userdata('keyword');
        }
        //config
        $this->db->like('no_agenda',$data['keyword']);
        $this->db->or_like('no_surat',$data['keyword']);
         $this->db->or_like('pengirim',$data['keyword']);
        $this->db->from('surat_masuk');
        $config['base_url'] = 'http://localhost/dp_admin/surat_masuk/agenda';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 3;

        // Styling nomor kanan dan kiri jika mau distyle
        // idupin script ini,, jika datanya banyak
        // $config['num_links'] = 5;

        //styling
        $config['full_tag_open']='<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']='</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open']='<li class="page-item">';
        $config['first_tag_close']='</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open']='<li class="page-item">';
        $config['last_tag_close']='</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open']='<li class="page-item">';
        $config['next_tag_close']='</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open']='<li class="page-item">';
        $config['prev_tag_close']='</li>';

        // styling active
        $config['cur_tag_open']='<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close']='</a></li>';

        // styling no active for digit
        $config['num_tag_open']='<li class="page-item">';
        $config['num_tag_close']='</li>';

        //atribut class
        $config['attributes'] = array('class'=>'page-link');


        ///initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['surat'] = $this->sm->page_getsurat($config['per_page'],$data['start'],$data['keyword']);
        $this->load->view('agenda/agenda_surat_masuk',$data);
    }

    public function cetak_agenda(){
        $data['surat'] = $this->db->get('surat_masuk')->result_array();
        $this->load->view('agenda/cetak',$data);
    }

    public function filter_period()
    {
        $data['title'] = 'Surat Masuk';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['tahun'] = $this->sm->gettahun();
        $data['config'] = $this->st->site_config();
            $this->template->render_page('surat_masuk/filter', $data);
            $this->load->view('surat_masuk/js/filter_js');
        

    }

    function filter(){
        $tanggalawal = $this->input->post('tanggalawal');
        $tanggalakhir = $this->input->post('tanggalakhir');
        $tahun1 = $this->input->post('tahun1');
        $bulanawal = $this->input->post('bulanawal');
        $bulanakhir = $this->input->post('bulanakhir');
        $tahun2 = $this->input->post('tahun2');
        $nilaifilter = $this->input->post('nilaifilter');


        if ($nilaifilter == 1) {
            
            $data['title'] = "Laporan Surat Masuk Periode Tanggal";
            $data['subtitle'] = "Dari tanggal : ".format_indo($tanggalawal).' Sampai tanggal : '.format_indo($tanggalakhir);
            $data['datafilter'] = $this->sm->filterbytanggal($tanggalawal,$tanggalakhir);
            $data['config'] = $this->st->site_config();
            $this->load->view('surat_masuk/print',$data);

        }elseif ($nilaifilter == 2) {
            
            $data['title'] = "Laporan Surat Masuk Periode Bulan";
            $data['subtitle'] = "Dari Bulan : ".bulan($bulanawal).' - '.bulan($bulanakhir).' '.$tahun1;
            $data['datafilter'] = $this->sm->filterbybulan($tahun1,$bulanawal,$bulanakhir);
            $data['config'] = $this->st->site_config();
            
            $this->load->view('surat_masuk/print',$data);

        }elseif ($nilaifilter == 3) {
            $data['config'] = $this->st->site_config();
            $data['title'] = "Laporan Surat Masuk Periode Tahun";
            $data['subtitle'] = ' Tahun : '.$tahun2;
            $data['datafilter'] = $this->sm->filterbytahun($tahun2);

            $this->load->view('surat_masuk/print',$data);

        }




    }
    

    
}