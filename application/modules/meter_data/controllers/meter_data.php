<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Meter_Data extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->model('mdl_meter_data');
	}

	public function index($page = 0)
	{
        $this->mdl_meter_data->paginate(site_url('meter_data/index'), $page);

        $meter_data = $this->mdl_meter_data->result();
		
		$this->layout->set(
         array(
				'meter_data'            => $meter_data,
                'filter_display'     => TRUE,
                'filter_placeholder' => lang('filter_meter_data'),
                'filter_method'      => 'filter_meter_data'
            )
        );			

		$this->layout->set('meter_data', $meter_data);
		$this->layout->buffer('content', 'meter_data/index');
		$this->layout->render();
	}

	public function form($id = NULL)
	{
		if ($this->input->post('btn_cancel'))
		{
			redirect('meter_data');
		}

		if ($this->mdl_meter_data->run_validation())
		{
			$this->mdl_meter_data->save($id);
			redirect('meter_data');
		}

		if ($id and !$this->input->post('btn_submit'))
		{
			if (!$this->mdl_meter_data->prep_form($id))
            {
                show_404();
            }
		}

		$this->layout->buffer('content', 'meter_data/form');
		$this->layout->render();
	}

	public function delete($id)
	{
		$this->mdl_meter_data->delete($id);
		redirect('meter_data');
	}
}

?>