<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
{
    //Memaksa ke controler login jika user iseng menuju url admin
    public function __construct()
    {
        parent::__construct();
         $this->load->model('Front_model', 'fm');
         $this->load->model('Site_model','st');
        
    }

    ///slider config

    public function index(){
        $data['title'] = "Front Slider";
        $data['slider'] = $this->fm->front_slider();
        $data['config'] = $this->st->site_config();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('frontend_config/slider/edit',$data);

    }
    public function front_slider_update(){
        $data['front_slider'] = $this->fm->front_slider();
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $subtitle = $this->input->post('subtitle');
        $title2 = $this->input->post('title2');
        $subtitle2 = $this->input->post('subtitle2');
        $title3 = $this->input->post('title3');
        $subtitle3 = $this->input->post('subtitle3');

        //slider 1
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path']          = './assets/img/frontend/slider';
                $config['allowed_types']        = 'gif|jpg|png|docx|doc|xls|xlxs|pdf';
                $config['max_size']             = 5000;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['front_slider']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/frontend/slider/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            //slider 2
            $upload_image2 = $_FILES['image2']['name'];

            if ($upload_image2) {
                $config2['upload_path']          = './assets/img/frontend/slider';
                $config2['allowed_types']        = 'gif|jpg|png|docx|doc|xls|xlxs|pdf';
                $config2['max_size']             = 5000;
                $this->load->library('upload', $config2);

                if ($this->upload->do_upload('image2')) {
                    $old_image2 = $data['front_slider']['image2'];
                    if ($old_image2 != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/frontend/slider/' . $old_image2);
                    }
                    $new_image2 = $this->upload->data('file_name');
                    $this->db->set('image2', $new_image2);
                } else {
                    echo $this->upload->display_errors();
                }
            }


            //slider 3
            $upload_image3 = $_FILES['image3']['name'];

            if ($upload_image3) {
                $config3['upload_path']          = './assets/img/frontend/slider';
                $config3['allowed_types']        = 'gif|jpg|png|docx|doc|xls|xlxs|pdf';
                $config3['max_size']             = 5000;
                $this->load->library('upload', $config3);

                if ($this->upload->do_upload('image3')) {
                    $old_image3 = $data['front_slider']['image3'];
                    if ($old_image3 != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/frontend/slider/' . $old_image3);
                    }
                    $new_image3 = $this->upload->data('file_name');
                    $this->db->set('image3', $new_image3);
                } else {
                    echo $this->upload->display_errors();
                }
            }




            $data  = array(
                'title' => $title,
                'subtitle' => $subtitle,
                'title2' => $title2,
                'subtitle2' => $subtitle2,
                'title3' => $title3,
                'subtitle3' => $subtitle3
                );
            
            $where = array('id'=>$id);
            
            $this->fm->update_front($where,$data,'front_slider');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Front Slider Has Been Edit! </div>');
            redirect('frontend_config/slider');
    }
    
    
}