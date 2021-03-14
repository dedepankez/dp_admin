<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog_model extends CI_Model
{
    public function page_getblog($limit,$start,$keyword = null)
    {
        if ($keyword) {
          $this->db->like('title',$keyword);
        }
        
        return  $this->db->get('front_blog',$limit,$start)->result_array();
    }


    function tampil_data_blog(){
        return $this->db->get('front_blog');
    }
    function edit_blog($where,$table){  
        return $this->db->get_where($table,$where);

    }

	function update_blog($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
    function delete_blog($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    
    public function join_blog($id) {
    $this->db->select('front_blog.*,front_kategori.kategori as kat');
    $this->db->from('front_blog');
    $this->db->join('front_kategori','front_blog.id_kategori=front_kategori.id');
    $query = $this->db->get();
    return $query->row_array();
    }

    public function get_total_blog() {
    
        echo $this->db->count_all('front_blog');
        }
    public function count_auto($table,$where=''){
        if($where){
            $this->db->where($where);
        }
        return $this->db->get($table)->num_rows();
    } 

    public function page_getkategori($limit,$start,$keyword = null)
    {
    $this->db->select('front_kategori.*');
        if ($keyword) {
          $this->db->like('kategori',$keyword);
           
        }
        
        return  $this->db->get('front_kategori',$limit,$start)->result_array();
    }


    ///datatables blog
    var $column_order = ['front_kategori.kategori', 'title','created_by','created_at']; // Field yang bisa orderable
    var $column_search = ['front_kategori.kategori','title','created_by','created_at']; // field yang diizin utk pencarian 
    var $order = ['created_at' => 'desc']; // default order 

    private function _get_datatables_query()
    {
        $this->db->select('front_blog.*,
            front_kategori.kategori as kat


            ');
        $this->db->join('front_kategori','front_blog.id_kategori = front_kategori.id');
        $this->db->from('front_blog'); // front_blog adalah table

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('front_blog');
        return $this->db->count_all_results();
    }

    // end datatables blog

    public function getblogid($id = false)
    {
        if ($id == false) {
            $this->db->order_by('created_at', 'ASC');
            return $this->db->get('front_blog')->result_array();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('front_blog')->row_array();
        }
    }
    public function insert()
    {
        // cek jika ada gambar yang akan diupload
        $upload_file = $_FILES['image']['name'];

        // jika ada file yang diupload
        if ($upload_file) {
            // konfigurasi
            $config['upload_path']          = './assets/img/frontend/blog';
            $config['allowed_types']        = 'pdf|jpg|png|docx|doc|xls';
            $config['max_size']             = 10000;

            // load library upload
            $this->load->library('upload', $config);

            // jika yang diupload sesuai dengan config
            if ($this->upload->do_upload('image')) {
                // ambil file_name nya
                $file = $this->upload->data('file_name');
                $file = str_replace('', '_', $file);
            } else {
                // jika tidak sesuai (error)
                $this->session->set_flashdata('err', '<div class="text-sm text-danger">' . $this->upload->display_errors() . '</div>');
                redirect('frontend_config/blog/index');
            }
        }

        $data = [
            'id_kategori' => $this->input->post('id_kategori', true),
            'title' => $this->input->post('title', true),
            'content' => $this->input->post('content', true),
            'created_at' => $this->input->post('created_at', true),
            'image' => $file,
            'created_by' => $this->input->post('created_by', true)
            
        ];

        $this->db->insert('front_blog', $data);
        $this->session->set_flashdata('msg', 'ditambahkan.');
        redirect('frontend_config/blog');
    }

    public function getblogkat($id = false)
    {
        if ($id == false) {
            $this->db->order_by('id_kategori', 'ASC');
            return $this->db->get('front_blog')->result_array();
        } else {
            $this->db->where('id_kategori', $id);
            return $this->db->get('front_blog')->result_array();
        }
    }
    public function getkat($id = false)
    {
        if ($id == false) {
            $this->db->order_by('kategori', 'ASC');
            return $this->db->get('front_kategori')->result_array();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('front_kategori')->row_array();
        }
    }
    public function recent_post(){
        $this->db->limit(5);
        $this->db->order_by('id','desc');
        return $this->db->get('front_blog')->result_array();
    }
}
