<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kasir_Model extends CI_Model
{
     
    public function getall(){
        $this->db->select('order_meja.*,

            tipe.nama as tp,
            meja.no_meja as no_meja, tipe.nama as tipe,
            meja.harga as harga, meja.dp as dp,user.name as jeneng,
            meja.gambar as gambar,meja.status as status_meja



            ');
        

        $this->db->from('order_meja'); // order_meja adalah table
        
        $this->db->join('tipe','order_meja.id_tipe=tipe.id');
        $this->db->join('meja','order_meja.id_meja=meja.id');
        $this->db->join('user','order_meja.user_id=user.id');
       
        return $this->db->get()->result_array();
    }
     
    

    // dp datatables
    var $column_order = ['name','no_meja','no_hp','alamat','id','nama','tanggal','bukti']; // Field yang bisa orderable
    var $column_search = ['no_hp','alamat','name','bukti','no_meja','nama','tanggal','bukti']; // field yang diizin utk pencarian 
    var $order = ['tanggal' => 'desc']; // default order 

    private function _get_datatables_query()
    {   


        $this->db->select('order_meja.*,tipe.nama as tp,

            meja.no_meja as no_meja, tipe.nama as tipe,
            meja.harga as harga, meja.dp as dp,user.name as jeneng,
            meja.gambar as gambar,meja.status as status_meja



            ');
        
        
        $this->db->from('order_meja'); // order_meja adalah table
        
        $this->db->join('tipe','order_meja.id_tipe=tipe.id');
        $this->db->join('meja','order_meja.id_meja=meja.id');
        $this->db->join('user','order_meja.user_id=user.id');
        $this->db->where('status_order>=1');
        


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
        $this->db->from('order_meja');
        return $this->db->count_all_results();
    }

    // end data tables dp

    public function getmenu($id = false)
    {
        if ($id == false) {
            $this->db->order_by('id', 'DESC');

            return $this->db->get('order_meja')->result_array();
        } else {
            
            $this->db->where('id', $id);

            return $this->db->get('order_meja')->row_array();
        }
    }

    public function konfirmasi_meja()
    {

        $id = $this->input->post('id');
        $status = $this->input->post('status');
        
        // $user_id = 2;

        $data['meja'] = $this->db->get_where('meja', ['id' => $id])->row_array();


        $this->db->set('status', $status);
        
    
        $this->db->where('id', $id);
        $this->db->update('meja');

        $this->session->set_flashdata('msg', 'diubah.');
        redirect('kasir');
    }
   
    public function check($index_data = NULL){
        $this->db->select('order_meja.*,
            meja.no_meja as no_meja, tipe.nama as tipe,
            meja.harga as harga, meja.dp as dp,user.name as jeneng



            ');
        $this->db->join('meja','order_meja.id_meja=meja.id');
        $this->db->join('tipe','order_meja.id_tipe=tipe.id');
         $this->db->join('user','order_meja.user_id=user.id');
        $this->db->from('order_meja');

        if ($index_data!= NULL) {
           $this->db->where('order_meja.user_id',$index_data);
           $query= $this->db->get();
           return $query->result();
        }
    }
    public function check_id($index_data = NULL){
        $this->db->select('order_meja.*,
            meja.no_meja as no_meja, tipe.nama as tipe,
            meja.harga as harga, meja.dp as dp,user.name as jeneng,
            meja.gambar as gambar



            ');
        $this->db->join('meja','order_meja.id_meja=meja.id');
        $this->db->join('tipe','order_meja.id_tipe=tipe.id');
        $this->db->join('user','order_meja.user_id=user.id');
        $this->db->from('order_meja');

        if ($index_data!= NULL) {
           $this->db->where('order_meja.user_id',$index_data);
           $query= $this->db->get();
           return $query->result_array();
        }}
        public function check_sudahbayar(){
        $this->db->select('order_meja.*,
            meja.no_meja as no_meja, tipe.nama as tipe,
            meja.harga as harga, meja.dp as dp,user.name as jeneng,
            meja.gambar as gambar,meja.status as status_meja



            ');

        $this->db->join('meja','order_meja.id_meja=meja.id');
        $this->db->join('tipe','order_meja.id_tipe=tipe.id');
        $this->db->join('user','order_meja.user_id=user.id');
        $this->db->from('order_meja');
        $this->db->where('status_order'=="1");
        $query= $this->db->get();
        return $query->result_array();
        
    }
        public function getbyid($id) {
        $this->db->select('order_meja.*,
            meja.harga as harga, meja.dp as dp,user.name as jeneng,
            meja.gambar as gambar,meja.status as status_meja,meja.no_meja as meja, tipe.nama as tipe 




            ');
        $this->db->from('order_meja');
        $this->db->where('order_meja.id', $id);
        $this->db->join('meja','order_meja.id_meja=meja.id');
        $this->db->join('tipe','order_meja.id_tipe=tipe.id');
        $this->db->join('user','order_meja.user_id=user.id');
        $query = $this->db->get();
        return $query->result_array();
        }
        public function getid_order($id = false)
    {
        if ($id == false) {
            $this->db->order_by('id', 'ASC');
            return $this->db->get('meja')->result_array();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('meja')->row_array();
        }
    }
    public function insert()
    {
        // cek jika ada gambar yang akan diupload
        $upload_file = $_FILES['bukti']['name'];

        // jika ada file yang diupload
        if ($upload_file) {
            // konfigurasi
            $config['upload_path']          = './assets/img/bukti_pembayaran';
            $config['allowed_types']        = 'pdf|jpg|png|docx|doc|xls';
            $config['max_size']             = 2000;

            // load library upload
            $this->load->library('upload', $config);

            // jika yang diupload sesuai dengan config
            if ($this->upload->do_upload('bukti')) {
                // ambil file_name nya
                $file = $this->upload->data('file_name');
                $file = str_replace('', '_', $file);
            } else {
                // jika tidak sesuai (error)
                $this->session->set_flashdata('err', '<div class="text-sm text-danger">' . $this->upload->display_errors() . '</div>');
                redirect('kasir/cek_ordermeja');
            }
        }

        $data = [
            'id_kategori' => $this->input->post('id_kategori', true),
            'nama' => $this->input->post('nama', true),
            'harga' => $this->input->post('harga', true),
            'gambar' => $file,
        ];

        $this->db->insert('order_meja', $data);
        $this->session->set_flashdata('msg', 'ditambahkan.');
        redirect('kasir/cek_ordermeja');
    }

    public function ubah()
    {

        $id = $this->input->post('id');
        $id_kategori = $this->input->post('id_kategori');
        $nama = $this->input->post('nama', true);
        $harga = $this->input->post('harga', true);
        // $user_id = 2;

        $data['order_meja'] = $this->db->get_where('order_meja', ['id' => $id])->row_array();

        // cek jika ada gambar yang akan diupload
        $upload_file = $_FILES['file']['bukti'];

        // jika ada file yang diupload
        if ($upload_file) {
            // konfigurasi
            $config['upload_path']          = './assets/img/bukti_pembayaran';
            $config['allowed_types']        = 'pdf|jpg|png|docx|doc|xls';
            $config['max_size']             = 2000;

            // load library upload
            $this->load->library('upload', $config);

            // jika yang diupload sesuai dengan config
            if ($this->upload->do_upload('bukti')) {
                // ambil file_name nya
                $file = $this->upload->data('file_name');
                $file = str_replace('', '_', $file);

                $this->db->set('bukti', $file);

                unlink(FCPATH . './assets/img/bukti_pembayaran/' . $data['bukti']['file']);
            } else {
                // jika tidak sesuai (error)
                $this->session->set_flashdata('err', '<div class="text-sm text-danger">' . $this->upload->display_errors() . '</div>');
                redirect('kasir/cek_ordermeja/' . $id);
            }
        }

        $this->db->set('id_kategori', $id_kategori);
        $this->db->set('nama', $nama);
        $this->db->set('harga', $harga);
        
        // $this->db->set('user_id', $user_id);
        $this->db->where('id', $id);
        $this->db->update('order_meja');

        $this->session->set_flashdata('msg', 'diubah.');
        redirect('kasir/cek_ordermeja');
    }
    

    public function count_auto($table,$where=''){
        if($where){
            $this->db->where($where);
        }
        return $this->db->get($table)->num_rows();
    } 
    public function getstatusorder($id = false)
    {

        if ($id == false) {
            $this->db->order_by('status_order', 'ASC');
            return $this->db->get('order_meja')->result_array();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('order_meja')->row_array();
        }
    }

    public function getstatuskonfirm($id = false)
    {

        if ($id == false) {
            $this->db->order_by('status_order', 'ASC');
            return $this->db->get('order_meja')->result_array();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('order_meja')->result_array();
        }
    }
    public function join_meja($id) {
    $this->db->select('order_meja.*,meja.no_meja as no_meja,
        meja.harga as harga,meja.gambar as gambar



        ');
    $this->db->from('order_meja');
    $this->db->join('meja','order_meja.id_meja=meja.id');
    $this->db->where('order_meja.id', $id);
    //  $this->db->join('keluarga','mahrom.id_keluarga=keluarga.id_keluarga');
    $query = $this->db->get();
    return $query->result_array();
    // lunas datatables dipisah biar gak ruwet
    }
    // count transaksi_terakhir
    public function transaksi_terakhir(){
    $this->db->select('*');
    $this->db->from('transaksi_kasir');
    $this->db->order_by('id','DESC');
    $this->db->limit(3);
    $query = $this->db->get();
    return $query->result_array();
    }
    public function transaksi_order(){
    $this->db->select('order_meja.*,
            meja.harga as harga, meja.dp as dp,user.name as jeneng,
            meja.gambar as gambar,meja.status as status_meja,meja.no_meja as meja, tipe.nama as tipe 




            ');
        $this->db->from('order_meja');
        $this->db->join('meja','order_meja.id_meja=meja.id');
        $this->db->join('tipe','order_meja.id_tipe=tipe.id');
        $this->db->join('user','order_meja.user_id=user.id');
    $this->db->order_by('id','DESC');
    $this->db->limit(3);
    $query = $this->db->get();
    return $query->result_array();
    }



    // hitung total pendapatan
    
    public function get_sum1()
    {
        $sql ="SELECT sum(bayar+bayar_lunas) as total FROM order_meja";
        $result = $this->db->query($sql);
        return $result->row()->total;
    }
    // pendapatan order meja end

    // pendapatan kasir manual
    public function get_sum2()
    {
        $sql ="SELECT sum(total) as total FROM transaksi_kasir";
        $result = $this->db->query($sql);
        return $result->row()->total;
    }

    public function print(){
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('order_meja');
    }
    
    public function getSmByDate($daterange)
    {
        $filterby = $this->input->post('filterby');
        if ($filterby == 'tgl_ditambah') {
            $this->db->where('created_at >=', $daterange[0]);
            $this->db->where('created_at <=', $daterange[1]);
        } else if ($filterby == 'tgl_surat') {
            $this->db->where('tanggal >=', $daterange[0]);
            $this->db->where('tanggal <=', $daterange[1]);
            
        // } else if ($filterby == 'tgl_diterima') {
        //     $this->db->where('tgl_diterima >=', $daterange[0]);
        //     $this->db->where('tgl_diterima <=', $daterange[1]);
        }

        $this->db->order_by('tanggal', 'ASC');
        return $this->db->get('order_meja')->result_array();
    }
    public function print_period($daterange)
    {
        $filterby = $this->input->post('filterby');
        if ($filterby == 'tgl_ditambah') {
            $this->db->where('created_at >=', $daterange[0]);
            $this->db->where('created_at <=', $daterange[1]);
        } else if ($filterby == 'tgl_surat') {
            $this->db->where('tanggal >=', $daterange[0]);
            $this->db->where('tanggal <=', $daterange[1]);
        // } else if ($filterby == 'tgl_diterima') {
        //     $this->db->where('tgl_diterima >=', $daterange[0]);
        //     $this->db->where('tgl_diterima <=', $daterange[1]);
        }

        $this->db->order_by('tanggal', 'ASC');
        return $this->db->get('order_meja')->result_array();
    }




    // report_m-kasir
    public function getSmByDatemkasir($daterange)
    {
        $filterby = $this->input->post('filterby');
        if ($filterby == 'tgl_ditambah') {
            $this->db->where('created_at >=', $daterange[0]);
            $this->db->where('created_at <=', $daterange[1]);
        } else if ($filterby == 'tgl_surat') {
            $this->db->where('tanggal >=', $daterange[0]);
            $this->db->where('tanggal <=', $daterange[1]);
        // } else if ($filterby == 'tgl_diterima') {
        //     $this->db->where('tgl_diterima >=', $daterange[0]);
        //     $this->db->where('tgl_diterima <=', $daterange[1]);
        }

        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('transaksi_kasir')->result_array();
    }
    public function print_period_mkasir($daterange)
    {
        $filterby = $this->input->post('filterby');
        if ($filterby == 'tgl_ditambah') {
            $this->db->where('created_at >=', $daterange[0]);
            $this->db->where('created_at <=', $daterange[1]);
        } else if ($filterby == 'tgl_surat') {
            $this->db->where('tanggal >=', $daterange[0]);
            $this->db->where('tanggal <=', $daterange[1]);
        // } else if ($filterby == 'tgl_diterima') {
        //     $this->db->where('tgl_diterima >=', $daterange[0]);
        //     $this->db->where('tgl_diterima <=', $daterange[1]);
        }

        $this->db->order_by('created_at', 'ASC');
        return $this->db->get('transaksi_kasir')->result_array();
    }

    public function getallpenjualan(){
        
        $this->db->group_by('id_product');
        $this->db->select('name','price');
        $this->db->select("sum(qty) as jumlah");
        $this->db->from('transaksi_kasir_log'); // transaksi_kasir_log adalah table
       
        return $this->db->get()->result_array();
    }

    public function getallorder(){
        
        $this->db->group_by('id_meja');
        $this->db->select('meja.no_meja as kontol');
        $this->db->select("count(user_id) as user_id");
        $this->db->join('meja','order_meja.id_meja=meja.id');
        $this->db->from('order_meja'); // order_meja adalah table
       
        return $this->db->get()->result_array();
    }

}



