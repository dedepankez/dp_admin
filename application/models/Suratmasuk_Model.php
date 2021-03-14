<?php
class Suratmasuk_model extends CI_Model
{
    var $column_order = ['klasifikasi.kode','no_agenda', 'pengirim', 'tgl_surat']; // Field yang bisa orderable
    var $column_search = ['klasifikasi.kode','no_agenda', 'pengirim', 'no_surat', 'isi', 'keterangan']; // field yang diizin utk pencarian 
    var $order = ['no_agenda' => 'asc']; // default order 

    private function _get_datatables_query()
    {
        $this->db->select('surat_masuk.*,
            klasifikasi.kode as code, klasifikasi.nama as jekod



            ');
        $this->db->join('klasifikasi','surat_masuk.id_kode=klasifikasi.id');
        $this->db->from('surat_masuk'); // surat_masuk adalah table

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
        $this->db->from('surat_masuk');
        return $this->db->count_all_results();
    }

    public function getSuratMasuk($id = false)
    {
        if ($id == false) {
            $this->db->order_by('no_agenda', 'ASC');
            return $this->db->get('surat_masuk')->result_array();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('surat_masuk')->row_array();
        }
    }

    public function get_disposisi($index_data = NULL){
        $this->db->select('disposisi.*,
            surat_masuk.no_agenda as agenda



            ');
        $this->db->join('surat_masuk','disposisi.id_surat_masuk=surat_masuk.id');
        $this->db->from('disposisi');

        if ($index_data!= NULL) {
           $this->db->where('disposisi.id_surat_masuk',$index_data);
           $query= $this->db->get();
           return $query->result_array();
        }}

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

        $this->db->order_by('no_agenda', 'ASC');
        return $this->db->get('surat_masuk')->result_array();
    }

    public function getSmByFile()
    {
        $this->db->select('*');
        $where = "file is  NOT NULL";
        $this->db->where($where);
        return $this->db->get('surat_masuk')->result_array();
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
                redirect('surat_masuk');
            }
        }

        $data = [
            'id_kode' => $this->input->post('id_kode', true),
            'no_agenda' => $this->input->post('no_agenda', true),
            'pengirim' => $this->input->post('pengirim', true),
            'no_surat' => $this->input->post('no_surat', true),
            'isi' => $this->input->post('isi', true),
            'kurir' => $this->input->post('kurir', true),
            'alamat' => $this->input->post('alamat', true),
            'tgl_surat' => $this->input->post('tgl_surat', true),
            'tgl_diterima' => $this->input->post('tgl_diterima', true),
            'keterangan' => $this->input->post('keterangan', true),
            'file' => $file,
            'created_at' => date('Y-m-d')
        ];

        $this->db->insert('surat_masuk', $data);
        $this->session->set_flashdata('msg', 'ditambahkan.');
        redirect('surat_masuk');
    }

    public function ubah()
    {

        $id = $this->input->post('id');
        $id_kode = $this->input->post('id_kode');
        $no_agenda = $this->input->post('no_agenda', true);
        $pengirim = $this->input->post('pengirim', true);
        $no_surat = $this->input->post('no_surat', true);
        $isi = $this->input->post('isi', true);
        $kurir = $this->input->post('kurir', true);
        $alamat = $this->input->post('alamat', true);
        $tgl_surat = $this->input->post('tgl_surat', true);
        $tgl_diterima = $this->input->post('tgl_diterima', true);
        $keterangan = $this->input->post('keterangan', true);

        $data['surat'] = $this->db->get_where('surat_masuk', ['id' => $id])->row_array();

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
                redirect('surat_masuk/ubah/' . $id);
            }
        }
        $this->db->set('id_kode', $id_kode);
        $this->db->set('no_agenda', $no_agenda);
        $this->db->set('pengirim', $pengirim);
        $this->db->set('no_surat', $no_surat);
        $this->db->set('isi', $isi);
        $this->db->set('kurir', $kurir);
        $this->db->set('alamat', $alamat);
        $this->db->set('tgl_surat', $tgl_surat);
        $this->db->set('tgl_diterima', $tgl_diterima);
        $this->db->set('keterangan', $keterangan);
        $this->db->where('id', $id);
        $this->db->update('surat_masuk');

        $this->session->set_flashdata('msg', 'diubah.');
        redirect('surat_masuk');
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
    /////disposisi
    public function getalldisposisi(){
        
        $this->db->group_by('id_surat_masuk');
        $this->db->select("count(id) as jumlah");
        $this->db->from('disposisi'); // disposisi adalah table
       
        return $this->db->get()->result_array();
    }
    function tampil_data_klasifikasi(){
        return $this->db->get('klasifikasi');
    }
    public function getalldispos(){
        $this->db->select('disposisi.*,

            



            ');
        

        $this->db->from('disposisi'); // disposisi adalah table
        
        $this->db->join('surat_masuk','disposisi.id_surat_masuk=disposisi.id');
        
       
        return $this->db->get()->result_array();
    }
    public function join($id) {
    $this->db->select('disposisi.*,surat_masuk.no_surat as nomor,surat_masuk.pengirim as pengirim,surat_masuk.tgl_surat as tanggal,surat_masuk.tgl_diterima as diterima,surat_masuk.no_agenda as agenda

        '



);
    $this->db->from('disposisi');
    $this->db->join('surat_masuk','disposisi.id_surat_masuk=surat_masuk.id');
    $this->db->where('disposisi.id', $id);
    //  $this->db->join('keluarga','mahrom.id_keluarga=keluarga.id_keluarga');
    $query = $this->db->get();
    return $query->result_array();
    }

    public function page_getsurat($limit,$start,$keyword = null)
    {
    $this->db->select('surat_masuk.*');
    
    
        if ($keyword) {
          $this->db->like('no_agenda',$keyword);
           $this->db->or_like('no_surat',$keyword);
           $this->db->or_like('pengirim',$keyword);

        }
        
        return  $this->db->get('surat_masuk',$limit,$start)->result_array();
    }

    ///cetak periode

    function gettahun(){

        $query = $this->db->query("SELECT YEAR(created_at) AS tahun FROM surat_masuk GROUP BY YEAR(created_at) ORDER BY YEAR(created_at) ASC");

        return $query->result_array();

    }

    function filterbytanggal($tanggalawal,$tanggalakhir){

        $query = $this->db->query("SELECT * from surat_masuk where created_at BETWEEN '$tanggalawal' and '$tanggalakhir' ORDER BY created_at ASC ");

        return $query->result_array();
    }

    function filterbybulan($tahun1,$bulanawal,$bulanakhir){

        $query = $this->db->query("SELECT * from surat_masuk where YEAR(created_at) = '$tahun1' and MONTH(created_at) BETWEEN '$bulanawal' and '$bulanakhir' ORDER BY created_at ASC ");

        return $query->result_array();
    }

    function filterbytahun($tahun2){

        $query = $this->db->query("SELECT * from surat_masuk where YEAR(created_at) = '$tahun2'  ORDER BY created_at ASC ");

        return $query->result_array();
    }

}
