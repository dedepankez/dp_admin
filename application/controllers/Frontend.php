<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends CI_Controller
{
    //Memaksa ke controler login jika user iseng menuju url admin
    public function __construct()
    {
        parent::__construct();
         $this->load->model('Front_model', 'fm');
         $this->load->model('Site_model','st');
         $this->load->model('front_config/Blog_model', 'blog');
        
    }


    public function index()
    {
        $data['config'] = $this->fm->front_config();
        $data['quote'] = $this->fm->front_quote();
        $data['menu'] = $this->fm->front_menu();
        $data['sosmed'] = $this->fm->front_sosmed();
        $data['slider'] = $this->fm->front_slider();
        $data['kategori'] = $this->fm->front_kategori();
        $data['title_url'] = "Home";
        $this->template->front_page('frontend/index',$data);
    }

    public function blog()
    {
        $data['config'] = $this->fm->front_config();
        $data['menu'] = $this->fm->front_menu();
        $data['sosmed'] = $this->fm->front_sosmed();
        // $data['blog'] = $this->fm->front_blog();
        $data['kategori'] = $this->fm->front_kategori();
        $data['rp'] = $this->blog->recent_post();
        $data['title_url'] = "Blog";

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
        $this->db->like('title',$data['keyword']);
        $this->db->from('front_blog');
        $config['base_url'] = 'http://localhost/dp_admin/frontend/blog';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 1;

        // Styling nomor kanan dan kiri jika mau distyle
        // idupin script ini,, jika datanya banyak
        // $config['num_links'] = 5;

        //styling
        $config['full_tag_open']='<ul class="justify-content-center">';
        $config['full_tag_close']='</ul>';

        $config['first_link'] = 'First';
        $config['first_tag_open']='<li class="disable"><i class="icofont-rounded-left">';
        $config['first_tag_close']='</i></li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open']='<li class="disable"><i class="icofont-rounded-right">';
        $config['last_tag_close']='</i></li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open']='<li class="disable">';
        $config['next_tag_close']='</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open']='<li class="disable">';
        $config['prev_tag_close']='</li>';

        // styling active
        $config['cur_tag_open']='<li class="active"><a class="">';
        $config['cur_tag_close']='</a></li>';

        // styling no active for digit
        $config['num_tag_open']='<li class="disable">';
        $config['num_tag_close']='</li>';

        ///initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['blog'] = $this->blog->page_getblog($config['per_page'],$data['start'],$data['keyword']);


        $this->template->front_page('frontend/blog/index',$data);
    }

    public function blog_by_kategori($id)
    {
        $data['config'] = $this->fm->front_config();
        $data['menu'] = $this->fm->front_menu();
        $data['sosmed'] = $this->fm->front_sosmed();
        $data['kategori'] = $this->fm->front_kategori();
        $data['getblogkat'] = $this->blog->getblogkat($id);
        $data['getkat'] = $this->blog->getkat($id);
        $data['title_url'] = "Kategori Blog";
        $this->template->front_page('frontend/blog/kategori_blog',$data);
    }

    public function about()
    {
        $data['config'] = $this->fm->front_config();
        $data['menu'] = $this->fm->front_menu();
        $data['sosmed'] = $this->fm->front_sosmed();
        $data['kategori'] = $this->fm->front_kategori();
        $data['title_url'] = "About";
        $this->template->front_page('frontend/about/index',$data);
    }

    public function contact()
    {
        $data['config'] = $this->fm->front_config();
        $data['menu'] = $this->fm->front_menu();
        $data['sosmed'] = $this->fm->front_sosmed();
        $data['kategori'] = $this->fm->front_kategori();
        $data['title_url'] = "Contact";
        $this->template->front_page('frontend/contact/index',$data);
    }

    public function team()
    {
        $data['config'] = $this->fm->front_config();
        $data['menu'] = $this->fm->front_menu();
        $data['team'] = $this->fm->front_team();
        $data['sosmed'] = $this->fm->front_sosmed();
        $data['kategori'] = $this->fm->front_kategori();
        $data['title_url'] = "Team";
        $this->template->front_page('frontend/team/index',$data);
    }

    public function front_config(){
        $data['title'] = "Front Config";
        $data['front_config'] = $this->fm->front_config();
        $data['config'] = $this->st->site_config();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('frontend_config/config/edit',$data);

    }
    public function front_config_update(){
    $data['front_config'] = $this->fm->front_config();
        $id = $this->input->post('id');
        $web_title = $this->input->post('web_title');
        $jalan = $this->input->post('jalan');
        $kecamatan = $this->input->post('kecamatan');
        $kabupaten = $this->input->post('kabupaten');
        $provinsi = $this->input->post('provinsi');
        $email = $this->input->post('email');
        $map = $this->input->post('map');
        $telp = $this->input->post('telp');
        $about = $this->input->post('about');
        $about2 = $this->input->post('about2');
        $access_comment = $this->input->post('access_comment');


        //cek jika ada gambar yang akan di upload
            $upload_image = $_FILES['about_image']['name'];

            if ($upload_image) {
                $config['upload_path']          = './assets/img/frontend/about';
                $config['allowed_types']        = 'gif|jpg|png|docx|doc|xls|xlxs|pdf';
                $config['max_size']             = 2000;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('about_image')) {
                    $old_image = $data['front_config']['about_image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/frontend/about/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('about_image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $data  = array(
                'web_title' => $web_title,
                'jalan' => $jalan,
                'kecamatan' => $kecamatan,
                'kabupaten' => $kabupaten,
                'provinsi' => $provinsi,
                'map' => $map,
                'email' => $email,
                'telp' => $telp,
                'access_comment' => $access_comment,
                'about' => $about,
                'about2' => $about2);
            
            $where = array('id'=>$id);
            
            $this->fm->update_front($where,$data,'front_config');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Front Config Has Been Edit! </div>');
            redirect('frontend/front_config');
    }

    
    
}