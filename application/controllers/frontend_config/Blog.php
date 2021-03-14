<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
    //Memaksa ke controler login
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('front_config/Blog_model', 'blog');
        $this->load->model('Site_model','st');
         $this->load->model('Front_model', 'fm');
        $this->load->library('pagination');
    }

    public function detail($id)
    {
        $data['rp'] = $this->blog->recent_post();
        $data['config'] = $this->fm->front_config();
        $data['menu'] = $this->fm->front_menu();
        $data['sosmed'] = $this->fm->front_sosmed();
        $data['blog'] = $this->fm->front_blog();
        $data['kategori'] = $this->fm->front_kategori();
        $where = array('id' =>$id);
        $data['blog'] = $this->blog->edit_blog($where,'front_blog')->row_array();
        $data['join'] = $this->blog->join_blog($id);
        $data['title_url'] = "Blog";
        $this->template->front_page('frontend/blog/detail',$data);
    }

    ///backend

    public function kategori_backend(){

        $data['config'] = $this->st->site_config();
        $data['title'] = 'Front Kategori';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        // load library
        $this->load->library('pagination');

        //ambil data keywoard
        if($this->input->post('submit')){
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword',$data['keyword']);
        }else{
            $data['keyword'] = $this->session->userdata('keyword');
        }
        //config
        $this->db->like('kategori',$data['keyword']);
        $this->db->from('front_kategori');
        $config['base_url'] = 'http://localhost/dp_admin/frontend_config/blog/kategori_backend';
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
        $data['start'] = $this->uri->segment(4);
        $data['kategori'] = $this->blog->page_getkategori($config['per_page'],$data['start'],$data['keyword']);
        

        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() == false) {

            $this->template->render_page('frontend_config/kategori/index',$data);
        } else {
            $this->db->insert('front_kategori', ['kategori' => $this->input->post('kategori')]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Kategori Added! </div>');
            redirect('frontend_config/blog/kategori_backend');
        }
    }

    public function delete_kategori_backend($id){

        $where  = array('id' =>$id );
        $this->blog->delete_blog($where,'front_kategori');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
             Kategori Has been Delete! </div>');
            redirect('frontend_config/blog/kategori_backend');
    }

    public function edit_kategori_backend($id){
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Edit Kategori';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['edit'] = $this->blog->edit_blog($where,'front_kategori')->row_array();
        $this->template->render_page('frontend_config/kategori/edit',$data);
        
    }
    public function update_kategori_backend(){
            $id = $this->input->post('id');
            $kategori = $this->input->post('kategori');
            $data  = array(
                'kategori' => $kategori );
            $where = array('id'=>$id);
            $this->blog->update_blog($where,$data,'front_kategori');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Kategori Has Been Edit! </div>');
            redirect('frontend_config/blog/kategori_backend');
    }

    ///kategori backend end


    // blog backend start

    public function index()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Front Blog';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('frontend_config/blog/index',$data);
        $this->load->view('frontend_config/blog/js/blog_js');
    }
    public function ambilData()
    {
        // jika ada request ajax yang dikirimkan
        if ($this->input->is_ajax_request() == true) {
            // ambil data dari table
            $list = $this->blog->get_datatables();
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
                        
                        <a href='blog/detail/$field->id' class='dropdown-item'>Detail</a>
                        <a href='blog/edit_blog/$field->id' class='dropdown-item'>Edit</a>
                        <a href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" class='dropdown-item' id='hapus-sm' data-id='$field->id'>Hapus</a>
                    </div>
                </div>";
                $image = "<div> <a href='../assets/img/frontend/blog/$field->image'>
                
                <img src='../assets/img/frontend/blog/$field->image'  width='50px' height='40px' class='img-thumbnail'>
                </a>
                 </div>";
                // Memanggil data dari tabel surat_masuk
                $row[] = $no;
                $row[] = $field->kat;
                $row[] = $field->title;
                $row[] = $image;
                $row[] = $field->created_by;
                $row[] = $field->created_at;
                $row[] = $btnAction;
                $data[] = $row;
            }

            $output = [
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->blog->count_all(),
                "recordsFiltered" => $this->blog->count_filtered(),
                "data" => $data,
            ];
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }
    
    public function tambah_blog()
    {
        
        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Tambah Blog',
                'kategori' => $this->db->get('front_kategori')->result_array()
            ];
            $data['config'] = $this->st->site_config();
            $this->template->render_page('frontend_config/blog/tambah', $data);
        } else {
            // jika validasi lolos, insert data
            $this->blog->insert();
        }
    }
    public function hapus_blog()
    {
        $id = $this->input->post('id');
        $data['blog'] = $this->blog->getblogid($id);

        $data['config'] = $this->st->site_config();
        
        $this->db->delete('front_blog', ['id' => $id]);
        $this->session->set_flashdata('msg', 'dihapus.');

        // Hapus file di folder uploads
        unlink(FCPATH . './assets/img/frontend/blog/' . $data['blog']['image']);
        redirect('frontend_config/blog');
    }
    public function edit_blog($id)
    {
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title' => 'Edit Blog',
                'blog' => $this->blog->getblogid($id),
                'kategori' => $this->db->get('front_kategori')->result_array()
            ];
            $data['config'] = $this->st->site_config();
            $this->template->render_page('frontend_config/blog/edit', $data);
       
           
    }
     public function update_blog(){
        $data['front_blog'] = $this->fm->front_blog();
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $id_kategori = $this->input->post('id_kategori');
        $content = $this->input->post('content');
        $created_by = $this->input->post('created_by');

        //cek jika ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path']          = './assets/img/frontend/blog';
                $config['allowed_types']        = 'gif|jpg|png|docx|doc|xls|xlxs|pdf';
                $config['max_size']             = 10000;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['front_blog']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/frontend/blog/' . $old_image);
                    }


                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $data  = array(
                'id_kategori' => $id_kategori,
                'title' => $title,
                'content' => $content,
                'created_by' => $created_by);
            
            
            $where = array('id'=>$id);
            
            $this->blog->update_blog($where,$data,'front_blog');
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">
            Blog Has Been Edit! </div>');
            redirect('frontend_config/blog/index');
    }
}