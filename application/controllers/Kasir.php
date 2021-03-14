<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{
    //Memaksa ke controler login jika user iseng menuju url admin
    public function __construct()

    {
        parent::__construct();

       
        $this->load->model('Kasir_model', 'kasir'); 
        $this->load->model('Master_model', 'sm');
        $this->load->model('Ordermeja_model', 'om');
        $this->load->model('Site_model','st');
       
    }


    public function index()
    {
        $data['title'] = 'Kasir';
        $data['config'] = $this->st->site_config();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');
        $data['total'] = $this->admin->count_auto('order_meja');
        $data['order']= $this->kasir->getall();
        $data['tt']= $this->kasir->transaksi_terakhir();
        $data['to']= $this->kasir->transaksi_order();
        $data["sum1"] = $this->kasir->get_sum1();
        $data["sum2"] = $this->kasir->get_sum2();
        $data['totalsub'] = $this->admin->count_auto('transaksi_kasir');
    
        
       
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kasir/index', $data);
        $this->load->view('templates/footer');
        

    }
     public function cek_ordermeja(){
        $data['title'] = 'Kasir Order Meja';
        $data['user'] = $this->db->get_where('user', ['email' =>
        
        $this->session->userdata('email')])->row_array();
        $data['config'] = $this->st->site_config();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kasir/cek_ordermeja');
        $this->load->view('templates/footer');
        $this->load->view('kasir/js/kasir_js');
        
       
    }
    public function ambilData()
    {
        // jika ada request ajax yang dikirimkan
        if ($this->input->is_ajax_request() == true) {
            // ambil data dari table
            $list = $this->kasir->get_datatables();
            $data = [];
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = [];

                // tkasirbol aksi
                $btnAction = "<div class=\"dropdown\">
                    <button class=\"btn btn-sm btn-info dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        <i class=\"fa fa-fw fa-list\"></i>
                    </button>
                    <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                        <a href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" class='dropdown-item' id='hapus-sm' data-id='$field->id'><strong class='text-warning'>ACC</strong></a></a>
                        <a href='konfirmasi_meja/$field->id_meja' class='dropdown-item'><strong class='text-danger'>Kunci Meja</strong></a>
                        <a href='detail_cekout/$field->id' class='dropdown-item'><strong class='text-primary'>Lihat nota</strong></a>
                        <a href='konfirmasi_lunas/$field->id' class='dropdown-item'<strong class='text-primary'>Lunasi</strong></a>
                        
                    </div>
                </div>";
                $btnActionlunas = "<div class=\"dropdown\">
                    <button class=\"btn btn-sm btn-info dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        <i class=\"fa fa-fw fa-list\"></i>
                    </button>
                    <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                        <a href='open_meja/$field->id_meja' class='dropdown-item'><strong class='text-warning'>Open Meja</strong></a>
                        <a href='detail_cekout/$field->id' class='dropdown-item'><strong class='text-primary'>Lihat nota</strong></a>
                        
                    </div>
                </div>";

                
                $image = "<div> <a href='../assets/img/bukti_pembayaran/$field->bukti'>
                
                <img src='../assets/img/bukti_pembayaran/$field->bukti'  width='50px' height='40px' class='img-thumbnail'>
                </a>
                 </div>";
                $image2 = "<div> <a href='../assets/img/bukti_pembayaran/$field->bukti_lunas'>
                
                <img src='../assets/img/bukti_pembayaran/$field->bukti_lunas'  width='50px' height='40px' class='img-thumbnail'>
                </a>
                 </div>";
               


                // Memanggil data dari tabel order_meja
                $row[] = $no;
                $row[] = $field->jeneng;
                $row[] = $field->no_meja;
                $row[] = $field->tp;
                $row[] = $field->bayar+$field->bayar_lunas==$field->harga? "<a class='text-success font-bold'>Lunas</a>" : "<a class='text-primary font-bold'>DP</a>";
                $row[] = $field->status_order == 1? "<a class='text-warning font-bold'>Belum Di ACC</a>" : "<a class='text-success font-bold'>Terkonfirmasi</a>";
                $row[] = $field->tanggal;
                $row[] = $field->jam;
                $row[] = 'Rp. '.number_format($field->bayar+$field->bayar_lunas ,0,',','.');
                $row[] = $image;
                $row[] = $field->bukti_lunas ==NULL && $field->bayar+$field->bayar_lunas==$field->harga?"Lunas Tanpa DP":$image2;


                $row[] =  $field->status_meja != 0? "<a class='text-danger'>Meja Terkunci</a>" : "<a class='alert-success'>Meja Terbuka</a>";
                $row[] = $field->bayar+$field->bayar_lunas==$field->harga?$btnActionlunas :$btnAction;
                $data[] = $row;
            }

            $output = [
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->kasir->count_all(),
                "recordsFiltered" => $this->kasir->count_filtered(),
                "data" => $data,
            ];
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }
    
    

    public function konfirmasi_meja($id){
        
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'title' => 'Konfirmasi Meja',
            'meja' => $this->sm->getmeja($id),
        ];
        $data['config'] = $this->st->site_config();
        $this->template->render_page('kasir/konfirmasi_meja', $data);
        
    }
    public function update_status_meja()
    {
            $id = $this->input->post('id');
            $status = $this->input->post('status');      
            $data  = array('status' => $status );
            $where = array('id'=>$id);
            $this->load->model('Master_model', 'meja');
            $this->meja->update_meja($where,$data,'meja');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Meja Has Been BOOKED! </div>');
            redirect('kasir/cek_ordermeja');
        
        }

    public function open_meja($id){
        
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'title' => 'Konfirmasi Meja',
            'meja' => $this->sm->getmeja($id),
        ];
        $data['config'] = $this->st->site_config();
        $this->template->render_page('kasir/open_meja', $data);
        
    }
    public function update_open_meja()
    {
            $id = $this->input->post('id');
            $status = $this->input->post('status');      
            $data  = array('status' => $status );
            $where = array('id'=>$id);
            $this->load->model('Master_model', 'meja');
            $this->meja->update_meja($where,$data,'meja');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Meja Has Been Open! </div>');
            redirect('kasir/cek_ordermeja');
        
        }
        public function update_status_order()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status_order');      
        $data  = array('status_order' => $status );
        $where = array('id'=>$id);
        $this->load->model('Master_model', 'meja');
        $this->meja->update_meja($where,$data,'order_meja');;
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Order Has Been Confirmated! </div>');
        redirect('kasir/cek_ordermeja');
    }

    public function konfirmasi_lunas($id)
    {
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'title' => 'Konfirmasi Pelunasan',
            'order' => $this->kasir->getstatuskonfirm($id),
            'join' => $this->kasir->join_meja($id),
            
        ];

        $data['config'] = $this->st->site_config();
        $this->template->render_page('kasir/konfirmasi_lunas', $data);
    }
    
    public function update_status_lunas()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status_order');
        $bayar_lunas = $this->input->post('bayar_lunas');
        $created_at = $this->input->post('created_at');

        $data  = array(
            'status_order' => $status,
            'bayar_lunas' => $bayar_lunas,
            'created_at' => $created_at


         );
        $where = array('id'=>$id);
        $this->load->model('Master_model', 'meja');
        $this->meja->update_meja($where,$data,'order_meja');;
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Order Has Been Confirmated! </div>');
        redirect('kasir/cek_ordermeja');
    }
        public function detail_cekout($id)
        {
            
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Lihat Nota Pemesan',
                'order' => $this->kasir->getbyid($id),
            ];
            $data['config'] = $this->st->site_config();
            $this->template->render_page('kasir/cekout', $data);
        }
    
    public function cetak_notameja($id){
        $data['title'] = 'Nota Pemesanan Meja';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['order']= $this->kasir->getbyid($id);
        
        $this->load->view('kasir/cetak_notameja',$data);
        
    }

    // report order_meja
    public function filter(){

        $this->form_validation->set_rules('startdate', 'Field diatas', 'required');
        $this->form_validation->set_rules('enddate', 'Field diatas', 'required');

        if ($this->form_validation->run() == false) {
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Report Reservasi Meja',
            ];
    
            $this->template->render_page('report/filter', $data);
        } else {
            $startdate = $this->input->post('startdate', true);
            $enddate = $this->input->post('enddate', true);

                $data = [
                    'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                    'title' => 'Report Reservasi Meja',
                    'order' => $this->kasir->getSmByDate([$startdate, $enddate])
                ];
                $data['config'] = $this->st->site_config();
                $this->template->render_page('report/filter', $data);
        }
    }
    //print all
    public function print(){
        $data['print']= $this->kasir->print("order_meja")->result();
        $this->load->view('report/print',$data);
    }
    // debug
    public function print_period()
    {

            $startdate = $this->input->post('startdate', true);
            $enddate = $this->input->post('enddate', true);

                $data = [
                    'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                    'title' => 'Report Reservasi Meja',
                    'order' => $this->kasir->print_period([$startdate, $enddate])
                ];
                $data['config'] = $this->st->site_config();
                $this->load->view('report/print_period', $data);
        }
    public function print_period_pdf(){
        
        $this->load->library('pdf');
    
        // Convert to PDF
        $startdate = $this->input->post('startdate', true);
        $enddate = $this->input->post('enddate', true);

                $data = [
                    'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                    'title' => 'Report Reservasi Meja',
                    'order' => $this->kasir->print_period([$startdate, $enddate])
                ];

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "order_periode.pdf";
        $this->pdf->load_view('report/print_period_pdf.html', $data);
    }
    
    
// end report order_meja


// report_m_kasir
        public function filter_mkasir(){

        $this->form_validation->set_rules('startdate', 'Field diatas', 'required');
        $this->form_validation->set_rules('enddate', 'Field diatas', 'required');

        if ($this->form_validation->run() == false) {
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Report M-Kasir',
            ];
    
            $this->template->render_page('report_m_kasir/filter', $data);
        } else {
            $startdate = $this->input->post('startdate', true);
            $enddate = $this->input->post('enddate', true);

                $data = [
                    'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                    'title' => 'Report M-Kasir',
                    'meja' => $this->kasir->getSmByDatemkasir([$startdate, $enddate])
                ];
                $data['config'] = $this->st->site_config();
                $this->template->render_page('report_m_kasir/filter', $data);
        }
    }
    
    public function print_period_mkasir()
    {

            $startdate = $this->input->post('startdate', true);
            $enddate = $this->input->post('enddate', true);

                $data = [
                    'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                    'title' => 'Report M-Kasir',
                    'kasir' => $this->kasir->print_period_mkasir([$startdate, $enddate])
                ];
        
                $this->load->view('report_m_kasir/print_period', $data);
        }


   public function chart_harga(){

    $data['config'] = $this->st->site_config();
    $data['title'] = 'GRAFIK HARGA PRODUCT';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('chart/index',$data);
    $this->load->view('templates/footer');
    $this->load->view('chart/js/index_js');
    
    
   }

   public function chart_penjualan(){

    $data['config'] = $this->st->site_config();
    $data['title'] = 'GRAFIK PENJUALAN';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('chart/penjualan',$data);
    $this->load->view('templates/footer');
    $this->load->view('chart/js/penjualan_js');
    
    
   }
   public function chart_order(){

    $data['config'] = $this->st->site_config();
    $data['title'] = 'GRAFIK ORDER MEJA';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('chart/order',$data);
    $this->load->view('templates/footer');
    $this->load->view('chart/js/order_js');
    
    
   }

}