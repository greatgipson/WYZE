<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Tariff_Type_Ekuhurleni extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->model('mdl_tariff_type_ekuhurleni');
	}

	public function index($page = 0)
	{
        $this->mdl_tariff_type_ekuhurleni->paginate(site_url('tariff_type_ekuhurleni/index'), $page);
        $this->layout->set('tariff_kva_non_tou_types', $this->mdl_tariff_type_ekuhurleni->tariff_kva_non_tou_types());
        $this->layout->set('tariff_kva_tou_types', $this->mdl_tariff_type_ekuhurleni->tariff_kva_tou_types());
        $this->layout->set('tou_types', $this->mdl_tariff_type_ekuhurleni->tou_types());
        $this->layout->set('season_types', $this->mdl_tariff_type_ekuhurleni->season_types());
		$this->layout->set('tariff_season', $this->mdl_tariff_type_ekuhurleni->tariff_season());
		$this->layout->set('tariff_billing_format', $this->mdl_tariff_type_ekuhurleni->tariff_billing_format());

        $tariff_type_ekuhurleni = $this->mdl_tariff_type_ekuhurleni->result();

		$this->layout->set('tariff_type_ekuhurleni', $tariff_type_ekuhurleni);
		$this->layout->buffer('content', 'tariff_type_ekuhurleni/index');
		$this->load->model('council/mdl_council');


		$council_names = $this->mdl_council->get()->result();
		$this->layout->set('council_names', $council_names);

		$this->layout->render();
	}

	public function form($id = NULL)
	{
		if ($this->input->post('btn_cancel'))
		{
			redirect('tariff_type_ekuhurleni');
		}

		if ($this->mdl_tariff_type_ekuhurleni->run_validation())
		{
			$this->mdl_tariff_type_ekuhurleni->save($id);
			redirect('tariff_type_ekuhurleni');
		}

		if ($id and !$this->input->post('btn_submit'))
		{
			if (!$this->mdl_tariff_type_ekuhurleni->prep_form($id))
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
				'tariff_kva_non_tou_types' => $this->mdl_tariff_type_ekuhurleni->tariff_kva_non_tou_types()
			)
		);
		
		$this->layout->set(
			array(
				'id' => $id,
				'tariff_season' => $this->mdl_tariff_type_ekuhurleni->tariff_season()
			)
		);
		
				$this->layout->set(
			array(
				'id' => $id,
				'tariff_billing_format' => $this->mdl_tariff_type_ekuhurleni->tariff_billing_format()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'tariff_kva_tou_types' => $this->mdl_tariff_type_ekuhurleni->tariff_kva_tou_types()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'tou_types' => $this->mdl_tariff_type_ekuhurleni->tou_types()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'season_types' => $this->mdl_tariff_type_ekuhurleni->season_types()
			)
		);

		$this->layout->buffer('content', 'tariff_type_ekuhurleni/form');
		$this->layout->render();
	}

	public function delete($id)
	{
		$this->mdl_tariff_type_ekuhurleni->delete($id);
		redirect('tariff_type_ekuhurleni');
	}
}

?>