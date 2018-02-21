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

class Tariff_Type extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->model('mdl_tariff_type');
	}

	public function index($page = 0)
	{
        $this->mdl_tariff_type->paginate(site_url('tariff_type/index'), $page);
        $this->layout->set('tariff_kva_non_tou_types', $this->mdl_tariff_type->tariff_kva_non_tou_types());
        $this->layout->set('tariff_kva_tou_types', $this->mdl_tariff_type->tariff_kva_tou_types());
        $this->layout->set('tou_types', $this->mdl_tariff_type->tou_types());
        $this->layout->set('season_types', $this->mdl_tariff_type->season_types());


        $tariff_type = $this->mdl_tariff_type->result();

		$this->layout->set('tariff_type', $tariff_type);
		$this->layout->buffer('content', 'tariff_type/index');
		$this->load->model('council/mdl_council');


		$council_names = $this->mdl_council->get()->result();
		$this->layout->set('council_names', $council_names);

		$this->layout->render();
	}

	public function form($id = NULL)
	{
		if ($this->input->post('btn_cancel'))
		{
			redirect('tariff_type');
		}

		if ($this->mdl_tariff_type->run_validation())
		{
			$this->mdl_tariff_type->save($id);
			redirect('tariff_type');
		}

		if ($id and !$this->input->post('btn_submit'))
		{
			if (!$this->mdl_tariff_type->prep_form($id))
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
				'tariff_kva_non_tou_types' => $this->mdl_tariff_type->tariff_kva_non_tou_types()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'tariff_kva_tou_types' => $this->mdl_tariff_type->tariff_kva_tou_types()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'tou_types' => $this->mdl_tariff_type->tou_types()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'season_types' => $this->mdl_tariff_type->season_types()
			)
		);

		$this->layout->buffer('content', 'tariff_type/form');
		$this->layout->render();
	}

	public function delete($id)
	{
		$this->mdl_tariff_type->delete($id);
		redirect('tariff_type');
	}
}

?>