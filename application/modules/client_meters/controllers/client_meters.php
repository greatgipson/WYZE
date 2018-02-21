<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client_Meters extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->model('mdl_client_meters');
	}

	public function index($page = 0)
	{
        $this->mdl_client_meters->paginate(site_url('client_meters/index'), $page);
        $client_meters = $this->mdl_client_meters->result();
        $this->layout->set(
            array(
                'client_meters'      => $client_meters,
                'filter_display'     => TRUE,
                'filter_placeholder' => lang('filter_client_meters'),
                'filter_method'      => 'filter_client_meters'
            )
        );	

		$this->layout->set('meter_type', $this->mdl_client_meters->meter_type());
		$this->layout->set('connections', $this->mdl_client_meters->connections());

		$this->load->model('clients/mdl_clients');
		$client_names = $this->mdl_clients->get()->result();
		$this->layout->set('client_names', $client_names);
		
		$this->layout->set('client_meters', $client_meters);
		$this->layout->buffer('content', 'client_meters/index');
		$this->layout->render();
	}

	public function form($id = NULL)
	{
		if ($this->input->post('btn_cancel'))
		{
			redirect('client_meters');
		}

		if ($this->mdl_client_meters->run_validation())
		{
			$this->mdl_client_meters->save($id);
			redirect('client_meters');
		}

		if ($id and !$this->input->post('btn_submit'))
		{
			if (!$this->mdl_client_meters->prep_form($id))
            {
                show_404();
            }
		}

		$this->layout->set(
			array(
				'id' => $id,
				'meter_type' => $this->mdl_client_meters->meter_type()
			)
		);

		$this->layout->set(
			array(
				'id' => $id,
				'connections' => $this->mdl_client_meters->connections()
			)
		);

		$this->load->model('clients/mdl_clients');
	 	$this->layout->set(
			array(
				'id' => $id,
				'client_names' => $this->mdl_clients->get()->result()
			)
         );

		$this->layout->buffer('content', 'client_meters/form');
		$this->layout->render();
	}

	public function delete($id)
	{
		$this->mdl_client_meters->delete($id);
		redirect('client_meters');
	}

}

?>