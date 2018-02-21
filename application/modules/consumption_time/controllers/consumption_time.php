<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Consumption_Time extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->model('mdl_consumption_time');
	}

	public function index($page = 0)
	{
        $this->mdl_consumption_time->paginate(site_url('consumption_time/index'), $page);

        $this->layout->set('tou_types', $this->mdl_consumption_time->tou_types());
        $this->layout->set('season_types', $this->mdl_consumption_time->season_types());
        $this->layout->set('consumption_types', $this->mdl_consumption_time->consumption_types());
        $this->layout->set('day_types', $this->mdl_consumption_time->day_types());

        $consumption_time = $this->mdl_consumption_time->result();

		$this->layout->set('consumption_time', $consumption_time);
		$this->layout->buffer('content', 'consumption_time/index');
		$this->load->model('council/mdl_council');

		$council_names = $this->mdl_council->get()->result();
		$this->layout->set('council_names', $council_names);

		$this->layout->render();
	}

	public function form($id = NULL)
	{
		if ($this->input->post('btn_cancel'))
		{
			redirect('consumption_time');
		}

		if ($this->mdl_consumption_time->run_validation())
		{
			$this->mdl_consumption_time->save($id);
			redirect('consumption_time');
		}

		if ($id and !$this->input->post('btn_submit'))
		{
			if (!$this->mdl_consumption_time->prep_form($id))
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
				'tou_types' => $this->mdl_consumption_time->tou_types()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'season_types' => $this->mdl_consumption_time->season_types()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'consumption_types' => $this->mdl_consumption_time->consumption_types()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'day_types' => $this->mdl_consumption_time->day_types()
			)
		);

		$this->layout->buffer('content', 'consumption_time/form');
		$this->layout->render();
	}

	public function delete($id)
	{
		$this->mdl_consumption_time->delete($id);
		redirect('consumption_time');
	}
}

?>