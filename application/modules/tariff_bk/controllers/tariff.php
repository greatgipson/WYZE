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

class Tariff extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->model('mdl_tariff');
	}

	public function index($page = 0)
	{
        $this->mdl_tariff->paginate(site_url('tariff/index'), $page);
        $tariff = $this->mdl_tariff->result();

		$this->layout->set('tariff', $tariff);
		$this->layout->buffer('content', 'tariff/index');
		$this->load->model('council/mdl_council');

		$council_names = $this->mdl_council->get()->result();
		$this->layout->set('council_names', $council_names);

		$this->layout->render();
	}

	public function form($id = NULL)
	{
		if ($this->input->post('btn_cancel'))
		{
			redirect('tariff');
		}

		if ($this->mdl_tariff->run_validation())
		{
			$this->mdl_tariff->save($id);
			redirect('tariff');
		}

		if ($id and !$this->input->post('btn_submit'))
		{
			if (!$this->mdl_tariff->prep_form($id))
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

		$this->layout->buffer('content', 'tariff/form');
		$this->layout->render();
	}

	public function delete($id)
	{
		$this->mdl_tariff->delete($id);
		redirect('tariff');
	}

}

?>