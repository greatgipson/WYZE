<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * FusionInvoice
 *
 * A free and open source web based invoicing system
 *
 * @package		FusionInvoice
 * @author		Jesse Terry
 * @copyright	Copyright (c) 2012 - 2013 FusionInvoice, LLC
 * @license		http://www.fusioninvoice.com/license.txt
 * @link		http://www.fusioninvoice.com
 *
 */

class Tariff_Type_City_Power extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->model('mdl_tariff_type_city_power');
	}

	public function index($page = 0)
	{
        $this->mdl_tariff_type_city_power->paginate(site_url('tariff_type_city_power/index'), $page);
        $this->layout->set('tariff_kva_non_tou_types', $this->mdl_tariff_type_city_power->tariff_kva_non_tou_types());
        $this->layout->set('tariff_kva_tou_types', $this->mdl_tariff_type_city_power->tariff_kva_tou_types());
        $this->layout->set('tou_types', $this->mdl_tariff_type_city_power->tou_types());
        $this->layout->set('season_types', $this->mdl_tariff_type_city_power->season_types());
		$this->layout->set('tariff_season', $this->mdl_tariff_type_city_power->tariff_season());
		$this->layout->set('tariff_billing_format', $this->mdl_tariff_type_city_power->tariff_billing_format());

        $tariff_type_city_power = $this->mdl_tariff_type_city_power->result();

		$this->layout->set('tariff_type_city_power', $tariff_type_city_power);
		$this->layout->buffer('content', 'tariff_type_city_power/index');
		$this->load->model('council/mdl_council');


		$council_names = $this->mdl_council->get()->result();
		$this->layout->set('council_names', $council_names);

		$this->layout->render();
	}

	public function form($id = NULL)
	{
		if ($this->input->post('btn_cancel'))
		{
			redirect('tariff_type_city_power');
		}

		if ($this->mdl_tariff_type_city_power->run_validation())
		{
			$this->mdl_tariff_type_city_power->save($id);
			redirect('tariff_type_city_power');
		}

		if ($id and !$this->input->post('btn_submit'))
		{
			if (!$this->mdl_tariff_type_city_power->prep_form($id))
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
				'tariff_kva_non_tou_types' => $this->mdl_tariff_type_city_power->tariff_kva_non_tou_types()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'tariff_kva_tou_types' => $this->mdl_tariff_type_city_power->tariff_kva_tou_types()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'tou_types' => $this->mdl_tariff_type_city_power->tou_types()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'season_types' => $this->mdl_tariff_type_city_power->season_types()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'tariff_billing_format' => $this->mdl_tariff_type_city_power->tariff_billing_format()
			)
		);
		
		$this->layout->set(
			array(
				'id' => $id,
				'tariff_season' => $this->mdl_tariff_type_city_power->tariff_season()
			)
		);
		
		$this->layout->buffer('content', 'tariff_type_city_power/form');
		$this->layout->render();
	}

	public function delete($id)
	{
		$this->mdl_tariff_type_city_power->delete($id);
		redirect('tariff_type_city_power');
	}
}

?>