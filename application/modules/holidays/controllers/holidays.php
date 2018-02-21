<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Holidays extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->model('mdl_holidays');
	}

	public function index($page = 0)
	{
        $this->mdl_holidays->paginate(site_url('holidays/index'), $page);

        $this->layout->set('day_types', $this->mdl_holidays->day_types());

        $holidays = $this->mdl_holidays->result();

		$this->layout->set('holidays', $holidays);
		$this->layout->buffer('content', 'holidays/index');
		$this->load->model('council/mdl_council');

		$council_names = $this->mdl_council->get()->result();
		$this->layout->set('council_names', $council_names);

		$this->layout->render();
	}

	public function form($id = NULL)
	{
		if ($this->input->post('btn_cancel'))
		{
			redirect('holidays');
		}

		if ($this->mdl_holidays->run_validation())
		{
			$this->mdl_holidays->save($id);
			redirect('holidays');
		}

		if ($id and !$this->input->post('btn_submit'))
		{
			if (!$this->mdl_holidays->prep_form($id))
            {
                show_404();
            }
		}
		$this->load->model('council/mdl_council');
	 	$this->layout->set(
			array(
				'id' => $id,
				'council_names' => $this->mdl_council->get()->result()
			)
         );

		$this->layout->set(
			array(
				'id' => $id,
				'day_types' => $this->mdl_holidays->day_types()
			)
		);

		$this->layout->buffer('content', 'holidays/form');
		$this->layout->render();
	}

	public function delete($id)
	{
		$this->mdl_holidays->delete($id);
		redirect('holidays');
	}
}

?>