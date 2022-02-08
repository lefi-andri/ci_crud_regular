<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrganisasiController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Organisasi_model', 'models');
	}

	public function index()
	{
		$this->load->library('pagination');

		$url = $this->uri->uri_string();
		$this->session->set_userdata('urlback', $url);

		$this->data = [];
		$this->data['title'] = "Organisasi";
		$this->data['keyword'] = '';

      	$this->pagination();

		$config['base_url'] =	site_url('organisasi/page/');
        $config['total_rows'] = $this->models->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '';
        $config['first_url'] = site_url('organisasi');
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
		$render_data = $this->models->index_limit($config['per_page'], $start);

		if ($render_data) {

			$table = $this->models->buat_tabel($render_data, $start);

			$this->data['tabel_data'] = $table;

			$this->data['pagination'] = $this->pagination->create_links();

			return view('organisasi/index', $this->data);
		}
		else
		{
			$this->session->set_flashdata('message_error', 'Data not found.');
			redirect('organisasi');
		}

		
	}

	public function search()
	{
		$this->data = [];
		$this->data['title'] = 'Pencarian Data';

		if (!empty($this->uri->segment(3)))
		{
	     	$url = $this->uri->uri_string();   
			$this->session->set_userdata('urlback', $url);

		} else {
			$url = $this->uri->uri_string().'/'.$this->input->post('keyword');
			$this->session->set_userdata('urlback', $url);
		}

		$keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));

		$this->load->library('pagination');

		if ($this->uri->segment(2)=='search') {
            $config['base_url'] = site_url('organisasi/search/' . $keyword);
            
        } else {
            $config['base_url'] = site_url('organisasi/search/');
        }
		$this->data['keyword'] = $keyword;

        $config['total_rows'] = $this->models->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '';
        $config['first_url'] = site_url('organisasi/search/'.$keyword);
        $this->pagination->initialize($config);

        $this->pagination();

        $start = $this->uri->segment(4, 0);
		$render_data = $this->models->search_index_limit($config['per_page'], $start, $keyword);

		if ($render_data) {

			$table = $this->models->buat_tabel($render_data, $start);

			$this->data['tabel_data'] = $table;

			$this->data['pagination'] = $this->pagination->create_links();

			return view('organisasi/index', $this->data);
		}
		else
		{
			$this->session->set_flashdata('message_error', 'Data not found.');
			redirect('organisasi');
		}

	}

	public function pagination()
	{
		$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        return $this->pagination->initialize($config);
	}

	public function add()
	{
		$this->load->helper('security');

		$this->data['title'] = 'Tambah Data Organisasi';
		$this->data['form_action'] = 'organisasi/add';

		$this->data['nama_organisasi'] = [
			'name' 		=> 'nama_organisasi',
			'id'		=> 'nama_organisasi',
			'type'		=> 'text',
			'value'		=> $this->form_validation->set_value('nama_organisasi'),
			'class'		=> 'form-control',
			'required'	=> 'required',
		];

		$this->data['alamat'] = [
			'name' 		=> 'alamat',
			'id'		=> 'alamat',
			'type'		=> 'text',
			'value'		=> $this->form_validation->set_value('alamat'),
			'class'		=> 'form-control',
			'required'	=> 'required',
		];

		$this->form_validation->set_rules('nama_organisasi','Nama Organisasi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('alamat','Alamat', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE)
        {
            return view('organisasi/form_add', $this->data);
        }
        else
        {
			$info = array(
					'nama_organisasi' => $this->input->post('nama_organisasi'),
					'alamat' => $this->input->post('alamat')
				);

			if ($this->models->simpan($info) === TRUE) {

				$this->session->set_flashdata('message_success', 'Berhasil menambah data.');
				redirect($this->session->userdata('urlback'));
			}
			else
			{
				$this->data['pesan_error'] = "Terjadi Kesalahan ";
				return view('organisasi/form_add', $this->data);			
			}
        }
	}

	public function edit($id = NULL)
	{
		$this->load->helper('security');

		$this->data['title'] = 'Edit Data Organisasi';
		$this->data['form_action'] = 'organisasi/edit/'.$id;

		if (!empty($id)) {

			$this->form_validation->set_rules('nama_organisasi','Nama Organisasi', 'trim|required|xss_clean');
			$this->form_validation->set_rules('alamat','Alamat', 'trim|required|xss_clean');

			if ($this->form_validation->run() == FALSE)
	        {
	        	$data_render = $this->models->cari($id);

				if ($data_render) {
					foreach ($data_render as $key => $value) {
						$current[$key] = $value;
					}
					
					$this->session->set_userdata('id', $data_render->id);
					
					$this->data['nama_organisasi'] = [
						'name' 		=> 'nama_organisasi',
						'id'		=> 'nama_organisasi',
						'type'		=> 'text',
						'value'		=> $this->form_validation->set_value('nama_organisasi', $current['nama_organisasi']),
						'class'		=> 'form-control',
						'required'	=> 'required',
					];

					$this->data['alamat'] = [
						'name' 		=> 'alamat',
						'id'		=> 'alamat',
						'type'		=> 'text',
						'value'		=> $this->form_validation->set_value('alamat', $current['alamat']),
						'class'		=> 'form-control',
						'required'	=> 'required',
					];

					return view('organisasi/form_add', $this->data);
				
				} else {

					$this->session->set_flashdata('message_warning', 'Tidak ditemukan data yang di edit.');
					redirect($this->session->userdata('urlback'));
				}

	            
	        }
	        else
	        {
				$info = array(
						'nama_organisasi' => $this->input->post('nama_organisasi'),
						'alamat' => $this->input->post('alamat')
					);

				$id = $this->session->userdata('id');

				if ($this->models->update($info, $id) === TRUE) {

					$this->session->set_flashdata('message_success', 'Berhasil menambah data.');
					redirect($this->session->userdata('urlback'));
				}
				else
				{
					$this->session->set_flashdata('message_warning', 'Tidak ada inputan yang disimpan.');
					redirect($this->session->userdata('urlback'));			
				}
	        }

		} else {

			redirect($this->session->userdata('urlback'));
		}
	}

	public function delete($id = NULL)
	{
		if(!empty($id))
		{
			if($this->models->delete($id) == TRUE)
			{
				$this->session->set_flashdata('message_success', 'Proses hapus data berhasil.');
				redirect($this->session->userdata('urlback'));
			}
			else
			{
				$this->session->set_flashdata('message_error', 'Gagal menghapus data!');
				redirect($this->session->userdata('urlback'));
			}
		}
		else
		{
			redirect($this->session->userdata('urlback'));
		}
	}

}

/* End of file OrganisasiController.php */
/* Location: ./application/controllers/OrganisasiController.php */