<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organisasi_model extends CI_Model {

	public $db_tabel = 'organisasi';

	public function search_total_rows($keyword) {
        return $this->db->from($this->db_tabel)
        				->like('id', $keyword)
        				->or_like('nama_organisasi', $keyword)
        				->or_like('alamat', $keyword)
        				->count_all_results();
    }

    public function search_index_limit($limit, $start = 0, $keyword)
	{
		return $this->db->order_by('id', 'ASC')
						->like('nama_organisasi', $keyword)
        				->or_like('alamat', $keyword)
						->limit($limit, $start)
						->get($this->db_tabel)->result();
	}

	public function total_rows() {
        return $this->db->from($this->db_tabel)
        				->count_all_results();
    }

	public function index_limit($limit, $start = 0)
	{
		return $this->db->order_by('id', 'ASC')
						->limit($limit, $start)
						->get($this->db_tabel)->result();
	}

	public function buat_tabel($data, $start)
	{
		$this->load->library('table');

        $this->table->set_heading('NO', 'ORGANISASI', 'ALAMAT', '', '');

        $template = array(
		        'table_open'            => '<table class="table table-bordered table-hover">',
		        'table_close'           => '</table>'
		);

		$this->table->set_template($template);

        if (is_numeric($start)) {
        	$start = $start;
        } else {
       		$start = 0;
       	}

        foreach($data as $row) {

            $this->table->add_row(
                ++$start,
				$row->nama_organisasi,
				$row->alamat,
				anchor('organisasi/edit/'.$row->id, 'Edit', array('class' => 'btn btn-outline-secondary')),
				anchor('organisasi/delete/'.$row->id, 'Delete', array('class' => 'btn btn-outline-secondary', 'onclick' => "return confirm('Anda yakin ingin menghapus data ini?')"))
            );

        }

        $tabel = $this->table->generate();

        return $tabel;
	}

	public function simpan($info)
    {
        $this->db->insert($this->db_tabel, $info);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function cari($id)
    {
        return $this->db->where('id', $id)
                        ->get($this->db_tabel)->row();
    }

    public function update($info, $id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->db_tabel, $info);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->db_tabel);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

}

/* End of file Organisasi_model.php */
/* Location: ./application/models/Organisasi_model.php */