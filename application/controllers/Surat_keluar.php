<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_keluar extends CI_Controller
{
    //Memaksa ke controler login jika user iseng menuju url admin
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Suratkeluar_model', 'sm');
         $this->load->model('Site_model', 'st');
        
    }


    public function index()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Surat Keluar';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('surat_keluar/index');
        $this->load->view('templates/footer');
        $this->load->view('surat_keluar/js/surat_keluar_js');
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
                        <a href='surat_keluar/detail/$field->id' class='dropdown-item'><i class='fa fa-eye'></i> Detail</a>
                        <a href='surat_keluar/ubah/$field->id' class='dropdown-item text-warning'><i class='fa fa-edit'></i> Edit</a>
                        <a href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" class='dropdown-item text-danger' id='hapus-sm' data-id='$field->id'><i class='fa fa-trash'></i> Hapus</a>
                    </div>
                </div>";
                $image = "<div> <a href='surat_keluar/lihat_file/$field->id'>
                
                $field->file
                </a>
                 </div>";
                $alamat = " DUSUN $field->dusun, $field->rt/$field->rw";

                // Memanggil data dari tabel surat_keluar
                $row[] = $no;
                $row[] = format_indo($field->created_at);
                $row[] = $field->no_surat;
                $row[] = $field->jenis_surat;
                $row[] = $field->pemohon;
                $row[] = $alamat;
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
            'title' => 'Detail Surat Keluar',
            'surat' => $this->sm->getSuratKeluar($id),
        ];
        $data['config'] = $this->st->site_config();
        $this->template->render_page('surat_keluar/detail', $data);
    }

    public function tambah()
    {
        
        $this->form_validation->set_rules('no_surat', 'No. Surat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Tambah Surat Keluar'
            ];
            $data['config'] = $this->st->site_config();
            $this->template->render_page('surat_keluar/tambah', $data);
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
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Ubah Surat Keluar',
                'surat' => $this->sm->getSuratKeluar($id)
            ];
            $data['config'] = $this->st->site_config();
            $this->template->render_page('surat_keluar/ubah', $data);
       
           
    }
     public function update(){

        $id = $this->input->post('id');
        $jenis_surat = $this->input->post('jenis_surat');
        $pemohon = $this->input->post('pemohon');
        $no_surat = $this->input->post('no_surat');
        $dusun = $this->input->post('dusun');
        $rt = $this->input->post('rt');
        $rw = $this->input->post('rw');
        $pengelola = $this->input->post('pengelola');
        $keterangan = $this->input->post('keterangan');

        //cek jika ada gambar yang akan di upload
            $upload_image = $_FILES['file']['name'];

            if ($upload_image) {
                $config['upload_path']          = './assets/img/upload';
                $config['allowed_types']        = 'gif|jpg|png|docx|doc|xls|xlxs|pdf';
                $config['max_size']             = 2000;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $old_image = $data['surat_keluar']['file'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/upload/' . $old_image);
                    }


                    $new_image = $this->upload->data('file_name');
                    $this->db->set('file', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $data  = array(
                'no_surat' => $no_surat,
                'jenis_surat' => $jenis_surat,
                'pemohon' => $pemohon,
                'dusun' => $dusun,
                'rt' => $rt,
                'rw' => $rw,
                'pengelola' => $pengelola,
                'keterangan' => $keterangan);
            
            $where = array('id'=>$id);
            
            $this->sm->update_user($where,$data,'surat_keluar');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Surat Keluar Has Been Edit! </div>');
            redirect('surat_keluar');
    }

    public function lihat_file($id)
    {
        
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Galery File',
                'sk' => $this->sm->getSuratKeluar($id)
            ];
            $data['config'] = $this->st->site_config();
            $this->template->render_page('surat_keluar/lihat_file', $data);
    }


    public function filter_period()
    {
        $data['title'] = 'Surat Keluar';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['tahun'] = $this->sm->gettahun();
        $data['config'] = $this->st->site_config();
            $this->template->render_page('surat_keluar/filter', $data);
            $this->load->view('surat_keluar/js/filter_js');
        

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
            
            $data['title'] = "Laporan Surat Keluar Periode Tanggal";
            $data['subtitle'] = "Dari tanggal : ".format_indo($tanggalawal).' Sampai tanggal : '.format_indo($tanggalakhir);
            $data['datafilter'] = $this->sm->filterbytanggal($tanggalawal,$tanggalakhir);
            $data['config'] = $this->st->site_config();
            $this->load->view('surat_keluar/print',$data);

        }elseif ($nilaifilter == 2) {
            
            $data['title'] = "Laporan Surat Keluar Periode Bulan";
            $data['subtitle'] = "Dari Bulan : ".bulan($bulanawal).' - '.bulan($bulanakhir).' '.$tahun1;
            $data['datafilter'] = $this->sm->filterbybulan($tahun1,$bulanawal,$bulanakhir);
            $data['config'] = $this->st->site_config();
            
            $this->load->view('surat_keluar/print',$data);

        }elseif ($nilaifilter == 3) {
            $data['config'] = $this->st->site_config();
            $data['title'] = "Laporan Surat Keluar Periode Tahun";
            $data['subtitle'] = ' Tahun : '.$tahun2;
            $data['datafilter'] = $this->sm->filterbytahun($tahun2);

            $this->load->view('surat_keluar/print',$data);

        }
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
        $this->db->like('pemohon',$data['keyword']);
        $this->db->or_like('no_surat',$data['keyword']);
         $this->db->or_like('dusun',$data['keyword']);
        $this->db->from('surat_keluar');
        $config['base_url'] = 'http://localhost/dp_admin/surat_keluar/agenda';
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
        $this->load->view('agenda/agenda_surat_keluar',$data);
    }

    public function cetak_agenda(){
        $data['surat'] = $this->db->get('surat_keluar')->result_array();
        $this->load->view('agenda/cetak_surat_keluar',$data);
    }
    
}