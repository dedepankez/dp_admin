<?php
class Suratkeluar_model extends CI_Model
{
    var $column_order = ['created_at','no_surat', 'jenis_surat', 'pemohon']; // Field yang bisa orderable
    var $column_search = ['created_at','no_surat', 'jenis_surat', 'pemohon']; // field yang diizin utk pencarian 
    var $order = ['created_at' => 'desc']; // default order 

    private function _get_datatables_query()
    {
        $this->db->select('surat_keluar.*



            ');
        
        $this->db->from('surat_keluar'); // surat_keluar adalah table

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
        $this->db->from('surat_keluar');
        return $this->db->count_all_results();
    }

    public function getSuratKeluar($id = false)
    {
        if ($id == false) {
            $this->db->order_by('created_at', 'ASC');
            return $this->db->get('surat_keluar')->result_array();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('surat_keluar')->row_array();
        }
    }


    public function getSmByDate($daterange)
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

        $this->db->order_by('no_surat', 'ASC');
        return $this->db->get('surat_keluar')->result_array();
    }

    public function getSmByFile()
    {
        $this->db->select('*');
        $where = "file is  NOT NULL";
        $this->db->where($where);
        return $this->db->get('surat_keluar')->result_array();
    }

    public function insert()
    {
        // cek jika ada gambar yang akan diupload
        $upload_file = $_FILES['file']['name'];

        // jika ada file yang diupload
        if ($upload_file) {
            // konfigurasi
            $config['upload_path']          = './assets/img/upload';
            $config['allowed_types']        = 'pdf|jpg|png|docx|doc|xls';
            $config['max_size']             = 2000;

            // load library upload
            $this->load->library('upload', $config);

            // jika yang diupload sesuai dengan config
            if ($this->upload->do_upload('file')) {
                // ambil file_name nya
                $file = $this->upload->data('file_name');
                $file = str_replace('', '_', $file);
            } else {
                // jika tidak sesuai (error)
                $this->session->set_flashdata('err', '<div class="text-sm text-danger">' . $this->upload->display_errors() . '</div>');
                redirect('surat_keluar');
            }
        }

        $data = [
            'no_surat' => $this->input->post('no_surat', true),
            'jenis_surat' => $this->input->post('jenis_surat', true),
            'no_surat' => $this->input->post('no_surat', true),
            'pemohon' => $this->input->post('pemohon', true),
            'dusun' => $this->input->post('dusun', true),
            'rt' => $this->input->post('rt', true),
            'rw' => $this->input->post('rw', true),
            'pengelola' => $this->input->post('pengelola', true),
            'keterangan' => $this->input->post('keterangan', true),
            'file' => $file,
            'created_at' => date('Y-m-d')
        ];

        $this->db->insert('surat_keluar', $data);
        $this->session->set_flashdata('msg', 'ditambahkan.');
        redirect('surat_keluar');
    }

    public function ubah()
    {

        $id = $this->input->post('id');
        $jenis_surat = $this->input->post('jenis_surat');
        $pemohon = $this->input->post('pemohon', true);
        $no_surat = $this->input->post('no_surat', true);
        $dusun = $this->input->post('dusun', true);
        $rt = $this->input->post('rt', true);
        $rw = $this->input->post('rw', true);
        $pengelola = $this->input->post('pengelola', true);
        $keterangan = $this->input->post('keterangan', true);

        $data['surat'] = $this->db->get_where('surat_keluar', ['id' => $id])->row_array();

        // cek jika ada gambar yang akan diupload
        $upload_file = $_FILES['file']['name'];

        // jika ada file yang diupload
        if ($upload_file) {
            // konfigurasi
            $config['upload_path']          = './assets/img/upload';
            $config['allowed_types']        = 'pdf|jpg|png|docx|doc|xls';
            $config['max_size']             = 2000;

            // load library upload
            $this->load->library('upload', $config);

            // jika yang diupload sesuai dengan config
            if ($this->upload->do_upload('file')) {
                // ambil file_name nya
                $file = $this->upload->data('file_name');
                $file = str_replace('', '_', $file);

                $this->db->set('file', $file);

                unlink(FCPATH . './assets/img/upload/' . $data['surat']['file']);
            } else {
                // jika tidak sesuai (error)
                $this->session->set_flashdata('err', '<div class="text-sm text-danger">' . $this->upload->display_errors() . '</div>');
                redirect('surat_keluar/ubah/' . $id);
            }
        }
        $this->db->set('no_surat', $no_surat);
        $this->db->set('jenis_surat', $jenis_surat);
        $this->db->set('pemohon', $pemohon);
        $this->db->set('dusun', $dusun);
        $this->db->set('rt', $rt);
        $this->db->set('rw', $rw);
        $this->db->set('pengelola', $pengelola);
        $this->db->set('keterangan', $keterangan);
        $this->db->where('id', $id);
        $this->db->update('surat_keluar');

        $this->session->set_flashdata('msg', 'diubah.');
        redirect('surat_keluar');
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
   function update_user($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    /////cetak Periode
    function gettahun(){

        $query = $this->db->query("SELECT YEAR(created_at) AS tahun FROM surat_keluar GROUP BY YEAR(created_at) ORDER BY YEAR(created_at) ASC");

        return $query->result_array();

    }

    function filterbytanggal($tanggalawal,$tanggalakhir){

        $query = $this->db->query("SELECT * from surat_keluar where created_at BETWEEN '$tanggalawal' and '$tanggalakhir' ORDER BY created_at ASC ");

        return $query->result_array();
    }

    function filterbybulan($tahun1,$bulanawal,$bulanakhir){

        $query = $this->db->query("SELECT * from surat_keluar where YEAR(created_at) = '$tahun1' and MONTH(created_at) BETWEEN '$bulanawal' and '$bulanakhir' ORDER BY created_at ASC ");

        return $query->result_array();
    }

    function filterbytahun($tahun2){

        $query = $this->db->query("SELECT * from surat_keluar where YEAR(created_at) = '$tahun2'  ORDER BY created_at ASC ");

        return $query->result_array();
    }

    public function page_getsurat($limit,$start,$keyword = null)
    {
    $this->db->select('surat_keluar.*');
    
    
        if ($keyword) {
          $this->db->like('pemohon',$keyword);
           $this->db->or_like('no_surat',$keyword);
           $this->db->or_like('dusun',$keyword);

        }
        
        return  $this->db->get('surat_keluar',$limit,$start)->result_array();
    }

}
