<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Team extends CI_Controller
{
    //Memaksa ke controler login jika user iseng menuju url admin
    public function __construct()
    {
        parent::__construct();
         $this->load->model('Front_model', 'fm');
         $this->load->model('front_config/Team_model', 'tm');
         $this->load->model('Site_model','st');
        
    }

    ///slider config

    public function index(){
        $data['title'] = "Front Team";
        $data['team'] = $this->fm->front_team();
        $data['config'] = $this->st->site_config();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('frontend_config/team/index',$data);

    }

    public function edit($id){
        $data['config'] = $this->st->site_config();
        $data['title'] = 'EDIT FRONT TEAM';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['team'] = $this->tm->edit_team($where,'front_team')->row_array();
            $this->template->render_page('frontend_config/team/edit', $data);
        
    }
    public function update(){
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $job = $this->input->post('job');
        $about = $this->input->post('about');

        //image team
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path']          = './assets/img/frontend/team';
                $config['allowed_types']        = 'gif|jpg|png|docx|doc|xls|xlxs|pdf';
                $config['max_size']             = 5000;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['front_team']['image'];
                    if ($old_image != NULL) {
                        unlink(FCPATH . 'assets/img/frontend/team/'. $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data  = array(
                'name' => $name,
                'job' => $job,
                'about' => $about
                );
            
            $where = array('id'=>$id);
            
            $this->tm->update_team($where,$data,'front_team');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Front Team Has Been Edit! </div>');
            redirect('frontend_config/team');
    }
    
    
}