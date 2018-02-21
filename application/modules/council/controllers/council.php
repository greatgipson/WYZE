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

class Council extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('mdl_council');
	}

	public function index($page = 0)
	{
        $this->mdl_council->paginate(site_url('council/index'), $page);
        $council = $this->mdl_council->result();
		$this->layout->set('council', $council);
		$this->layout->set('surcharges', $this->mdl_council->surcharges());

		$this->layout->buffer('content', 'council/index');
		$this->layout->render();
	}

	public function form($id = NULL)
	{
		if ($this->input->post('btn_cancel'))
		{
			redirect('council');
		}

		if ($this->mdl_council->run_validation())
		{
			$this->mdl_council->save($id);
			redirect('council');
		}

		if ($id and !$this->input->post('btn_submit'))
		{
			if (!$this->mdl_council->prep_form($id))
            {
                show_404();
            }
		}


		 $this->layout->set(
		            array(
		                'id' => $id,
		                'surcharges' => $this->mdl_council->surcharges()
		            )
        );

		$this->layout->buffer('content', 'council/form');
		$this->layout->render();
	}

	public function delete($id)
	{
		$this->mdl_council->delete($id);
		redirect('council');
	}

}

?>