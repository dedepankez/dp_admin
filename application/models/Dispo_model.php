<?php
class Dispo_model extends CI_Model
{
    var $column_order = ['surat_masuk.no_agenda','tujuan','isi','batas_waktu','catatan','created_at']; // Field yang bisa orderable
    var $column_search = ['tujuan','sifat','surat_masuk.no_surat','surat_masuk.pengirim']; // field yang diizin utk pencarian 
    var $order = ['id' => 'desc']; // default order 

    private function _get_datatables_query()
    {
        $this->db->select('disposisi.*,
            surat_masuk.no_agenda as agenda,surat_masuk.no_surat as no,
            surat_masuk.pengirim as kurir




            '

    );
        $this->db->from('disposisi'); // surat_masuk adalah table
        $this->db->join('surat_masuk','disposisi.id_surat_masuk=surat_masuk.id');
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
        $this->db->from('disposisi');
        return $this->db->count_all_results();
    }

    public function page_getklasifikasi($limit,$start,$keyword = null)
    {
    $this->db->select('klasifikasi.*');
    
        if ($keyword) {
          $this->db->like('nama',$keyword);
           $this->db->or_like('kode',$keyword);
        }
        
        return  $this->db->get('klasifikasi',$limit,$start)->result_array();
    }
    function edit_user($where,$table){      
        return $this->db->get_where($table,$where);
    }
    function edit_sub_menu($where,$table){  
        return $this->db->get_where($table,$where);

    }

    function update_user($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    function tampil_data_kode(){
        return $this->db->get('klasifikasi');
    }

    public function join_dispo() {
    $this->db->select('disposisi.*,surat_masuk.no_surat as no_surat,surat_masuk.no_agenda as agenda



        ');
    $this->db->from('disposisi');
    $this->db->join('surat_masuk','disposisi.id_surat_masuk=surat_masuk.id');
   
    $query = $this->db->get();
    return $query->result_array();
    }

    
}