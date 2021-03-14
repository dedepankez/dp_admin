<?php
class Crud_model extends CI_Model
{
    var $column_order = ['no_agenda', 'pengirim', null, 'tgl_surat', null]; // Field yang bisa orderable
    var $column_search = ['no_agenda', 'pengirim', 'no_surat', 'isi', 'keterangan']; // field yang diizin utk pencarian 
    var $order = ['no_agenda' => 'asc']; // default order 

    private function _get_datatables_query()
    {
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
                redirect('crud/example');
            }
        }

        $data = [
            'no_agenda' => $this->input->post('no_agenda', true),
            'pengirim' => $this->input->post('pengirim', true),
            'no_surat' => $this->input->post('no_surat', true),
            'isi' => $this->input->post('isi', true),
            'tgl_surat' => $this->input->post('tgl_surat', true),
            'tgl_diterima' => $this->input->post('tgl_diterima', true),
            'keterangan' => $this->input->post('keterangan', true),
            'file' => $file,
            'created_at' => date('Y-m-d'),
            'user_id' => 2,
            'created_at' => date('Y-m-d')
        ];

        $this->db->insert('surat_masuk', $data);
        $this->session->set_flashdata('msg', 'ditambahkan.');
        redirect('crud/example');
    }

    public function ubah()
    {

        $id = $this->input->post('id');
        $no_agenda = $this->input->post('no_agenda', true);
        $pengirim = $this->input->post('pengirim', true);
        $no_surat = $this->input->post('no_surat', true);
        $isi = $this->input->post('isi', true);
        $tgl_surat = $this->input->post('tgl_surat', true);
        $tgl_diterima = $this->input->post('tgl_diterima', true);
        $keterangan = $this->input->post('keterangan', true);
        $user_id = 2;

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
                redirect('crud/ubah/' . $id);
            }
        }

        $this->db->set('no_agenda', $no_agenda);
        $this->db->set('pengirim', $pengirim);
        $this->db->set('no_surat', $no_surat);
        $this->db->set('isi', $isi);
        $this->db->set('tgl_surat', $tgl_surat);
        $this->db->set('tgl_diterima', $tgl_diterima);
        $this->db->set('keterangan', $keterangan);
        $this->db->set('user_id', $user_id);
        $this->db->where('id', $id);
        $this->db->update('surat_masuk');

        $this->session->set_flashdata('msg', 'diubah.');
        redirect('crud/example');
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
    
}
