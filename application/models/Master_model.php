<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_model extends CI_Model
{
    public function getSubMenu()
    {

        $query = "SELECT `user_sub_menu`. *,`user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                 ";
        return  $this->db->query($query)->result_array();
    }
//////////////////////////////////////////////////////////////////

    // crud master
    function delete_menu($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    function edit_menu($where,$table){      
        return $this->db->get_where($table,$where);
    }
    function update_menu($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    
    function delete_meja($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    function edit_meja($where,$table){      
        return $this->db->get_where($table,$where);
    }
    function update_meja($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
///////////////////////////////////////////////////////////////////////////////
    public function ambil_meja($id) {
    $this->db->select('meja.*');
    $this->db->from('meja');
    
    $this->db->where('meja.id', $id);
    //  $this->db->join('keluarga','mahrom.id_keluarga=keluarga.id_keluarga');
    $query = $this->db->get();
    return $query->result();
    }
     
    public function get_total() {
        return $this->db->count_all('meja');
    }

    function tampil_data_meja(){
        return $this->db->get('meja');
    }
    // /////////////////////////////////////////////////////////////////////

// sub menu datatables
    var $column_order = ['no_meja']; // Field yang bisa orderable
    var $column_search = ['no_meja']; // field yang diizin utk pencarian 
    var $order = ['no_meja' => 'asc']; // default order 

    private function _get_datatables_query()
    {
        
        $this->db->select('meja.*');
        $this->db->from('meja'); // meja adalah table
        

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
        $this->db->from('meja');
        return $this->db->count_all_results();
    }

    public function getmeja($id = false)
    {
        if ($id == false) {
            $this->db->order_by('no_meja', 'ASC');
            return $this->db->get('meja')->result_array();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('meja')->row_array();
        }
    }

    public function insert()
    {
        // cek jika ada gambar yang akan diupload
        $upload_file = $_FILES['gambar']['name'];

        // jika ada file yang diupload
        if ($upload_file) {
            // konfigurasi
            $config['upload_path']          = './assets/img/upload';
            $config['allowed_types']        = 'pdf|jpg|png|docx|doc|xls';
            $config['max_size']             = 2000;

            // load library upload
            $this->load->library('upload', $config);

            // jika yang diupload sesuai dengan config
            if ($this->upload->do_upload('gambar')) {
                // ambil file_name nya
                $file = $this->upload->data('file_name');
                $file = str_replace('', '_', $file);
            } else {
                // jika tidak sesuai (error)
                $this->session->set_flashdata('err', '<div class="text-sm text-danger">' . $this->upload->display_errors() . '</div>');
                redirect('meja');
            }
        }

        $data = [
            'no_meja' => $this->input->post('no_meja', true),
            'status' => $this->input->post('status', true),
            'harga' => $this->input->post('harga', true),
            'dp' => $this->input->post('dp', true),
            'gambar' => $file,
        ];

        $this->db->insert('meja', $data);
        $this->session->set_flashdata('msg', 'ditambahkan.');
        redirect('meja');
    }

    public function ubah()
    {

        $id = $this->input->post('id');
        $no_meja = $this->input->post('no_meja', true);
        $status = $this->input->post('status', true);
        // $user_id = 2;

        $data['meja'] = $this->db->get_where('meja', ['id' => $id])->row_array();

        // cek jika ada gambar yang akan diupload
        $upload_file = $_FILES['file']['gambar'];

        // jika ada file yang diupload
        if ($upload_file) {
            // konfigurasi
            $config['upload_path']          = './assets/img/upload';
            $config['allowed_types']        = 'pdf|jpg|png|docx|doc|xls';
            $config['max_size']             = 2000;

            // load library upload
            $this->load->library('upload', $config);

            // jika yang diupload sesuai dengan config
            if ($this->upload->do_upload('gambar')) {
                // ambil file_name nya
                $file = $this->upload->data('file_name');
                $file = str_replace('', '_', $file);

                $this->db->set('gambar', $file);

                unlink(FCPATH . './assets/img/upload/' . $data['gambar']['file']);
            } else {
                // jika tidak sesuai (error)
                $this->session->set_flashdata('err', '<div class="text-sm text-danger">' . $this->upload->display_errors() . '</div>');
                redirect('meja/ubah/' . $id);
            }
        }

        $this->db->set('no_meja', $no_meja);
        $this->db->set('status', $status);
        
        // $this->db->set('user_id', $user_id);
        $this->db->where('id', $id);
        $this->db->update('meja');

        $this->session->set_flashdata('msg', 'diubah.');
        redirect('meja');
    }
    public function print_crud(){
        $this->db->order_by('tgl_surat', 'DESC');
        return $this->db->get('surat_masuk');
    }
    public function print_period($daterange)
    {
        $filterby = $this->input->post('filterby');
        if ($filterby == 'tgl_ditambah') {
            $this->db->where('created_at >=', $daterange[0]);
            $this->db->where('created_at <=', $daterange[1]);
        } else if ($filterby == 'tgl_surat') {
            $this->db->where('tgl_surat >=', $daterange[0]);
            $this->db->where('tgl_surat <=', $daterange[1]);
        // } else if ($filterby == 'tgl_diterima') {
        //     $this->db->where('tgl_diterima >=', $daterange[0]);
        //     $this->db->where('tgl_diterima <=', $daterange[1]);
        }

        $this->db->order_by('no_agenda', 'ASC');
        return $this->db->get('surat_masuk')->result_array();
    }

    public function count_auto($table,$where=''){
        if($where){
            $this->db->where($where);
        }
        return $this->db->get($table)->num_rows();
    } 

    public function get_where() {
    $this->db->select('meja.*');
    $this->db->from('meja');
    $this->db->join('user_menu','meja.menu_id=user_menu.id');
    $this->db->where('meja.id');
    //  $this->db->join('keluarga','mahrom.id_keluarga=keluarga.id_keluarga');
    $query = $this->db->get();
    return $query->result();
    }
}
