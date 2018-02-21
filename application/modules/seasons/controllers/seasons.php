<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Seasons extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->model('mdl_seasons');
	}

	public function index($page = 0)
	{
        $this->mdl_seasons->paginate(site_url('seasons/index'), $page);
        $seasons = $this->mdl_seasons->result();

		$this->layout->set('seasons', $seasons);
		$this->layout->set('months', $this->mdl_seasons->months());
		$this->layout->set('season_types', $this->mdl_seasons->season_types());
		$this->layout->set('season_years', $this->mdl_seasons->season_years());


		$this->layout->buffer('content', 'seasons/index');

		//$this->layout->set('season_types', $this->mdl_seasons->season_types());
		//$this->layout->set('months', $this->mdl_seasons->months());

		$this->load->model('council/mdl_council');
		$council_names = $this->mdl_council->get()->result();
		$this->layout->set('council_names', $council_names);

		$this->layout->render();
	}

	public function form($id = NULL)
	{
		if ($this->input->post('btn_cancel'))
		{
			redirect('seasons');
		}

		if ($this->mdl_seasons->run_validation())
		{
			$this->mdl_seasons->save($id);
			redirect('seasons');
		}

		if ($id and !$this->input->post('btn_submit'))
		{
			if (!$this->mdl_seasons->prep_form($id))
            {
                show_404();
            }
		}

		$this->layout->set(
			array(
				'id' => $id,
				'season_types' => $this->mdl_seasons->season_types()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'months' => $this->mdl_seasons->months()
			)
		);

		$this->layout->set(
					array(
						'id' => $id,
						'season_years' => $this->mdl_seasons->season_years()
					)
		);

		//$months = $this->layout->set('months', $this->mdl_seasons->months());
		//$this->layout->set('months', $months);


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
					'surcharges' => $this->mdl_council->surcharges()
				)
		);

		$this->layout->buffer('content', 'seasons/form');
		$this->layout->render();
	}

	public function delete($id)
	{
		$this->mdl_seasons->delete($id);
		redirect('seasons');
	}

}

?>