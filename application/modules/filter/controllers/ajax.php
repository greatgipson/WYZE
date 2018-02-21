<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Ajax extends Admin_Controller {

	public $ajax_controller = TRUE;
	
	public function filter_users()
	{
		$this->load->model('users/mdl_users');

		$query = $this->input->post('filter_query');

		$keywords	 = explode(' ', $query);
		$params		 = array();

		//echo implode ("---------------------------------> ",$keywords);
		foreach ($keywords as $keyword)
		{
			if ($keyword)
			{
                $keyword = strtolower($keyword);
				$this->mdl_users->like("CONCAT_WS('^',LOWER(user_name),LOWER(user_company), LOWER(user_email))", $keyword);
			}
		}

		$data = array(
			'user_types' => $this->mdl_users->user_types(),
			'users' => $this->mdl_users->get()->result()
		);

		$this->layout->load_view('users/partial_user_table', $data);
	}
	
	public function filter_client_meters()
	{
		$this->load->model('client_meters/mdl_client_meters');

		$query = $this->input->post('filter_query');

		$keywords	 = explode(' ', $query);
		$params		 = array();

		//echo implode ("---------------------------------> ",$keywords);
		foreach ($keywords as $keyword)
		{
			if ($keyword)
			{
                $keyword = strtolower($keyword);
				$this->mdl_client_meters->like("CONCAT_WS('^',LOWER(description),LOWER(client_name),meter_number)", $keyword);
			}
		}

		$data = array(
			'client_meters' => $this->mdl_client_meters->get()->result(),
			'meter_type' 	=> $this->mdl_client_meters->meter_type(),
			'connections' 	=> $this->mdl_client_meters->connections()
		);

		$this->layout->load_view('client_meters/partial_client_meters_table', $data);
	}

	public function filter_invoices()
	{
		$this->load->model('invoices/mdl_invoices');

		$query = $this->input->post('filter_query');

		$keywords	 = explode(' ', $query);
		$params		 = array();

		foreach ($keywords as $keyword)
		{
			if ($keyword)
			{
                $keyword = strtolower($keyword);
				$this->mdl_invoices->like("CONCAT_WS('^',LOWER(invoice_number),invoice_date_created,invoice_date_due,LOWER(client_name),invoice_total,invoice_balance)", $keyword);
			}
		}

		$data = array(
			'invoices' => $this->mdl_invoices->get()->result(),
			'invoice_statuses' => $this->mdl_invoices->statuses()
		);

		$this->layout->load_view('invoices/partial_invoice_table', $data);
	}
    
	public function filter_quotes()
	{
		$this->load->model('quotes/mdl_quotes');

		$query = $this->input->post('filter_query');

		$keywords	 = explode(' ', $query);
		$params		 = array();

		foreach ($keywords as $keyword)
		{
			if ($keyword)
			{
                $keyword = strtolower($keyword);
				$this->mdl_quotes->like("CONCAT_WS('^',LOWER(quote_number),quote_date_created,quote_date_expires,LOWER(client_name),quote_total)", $keyword);
			}
		}

		$data = array(
			'quotes' => $this->mdl_quotes->get()->result(),
			'quote_statuses' => $this->mdl_quotes->statuses()
		);

		$this->layout->load_view('quotes/partial_quote_table', $data);
	}
	
	public function filter_clients()
	{
		$this->load->model('clients/mdl_clients');

		$query = $this->input->post('filter_query');

		$keywords	 = explode(' ', $query);
		$params		 = array();

		foreach ($keywords as $keyword)
		{
			if ($keyword)
			{
                $keyword = strtolower($keyword);
				$this->mdl_clients->like("CONCAT_WS('^',LOWER(client_name),LOWER(client_email),client_phone,client_active)", $keyword);
			}
		}

		$data = array(
			'records' => $this->mdl_clients->with_total_balance()->get()->result()
		);

		$this->layout->load_view('clients/partial_client_table', $data);
	}
	
	public function filter_payments()
	{
		$this->load->model('payments/mdl_payments');

		$query = $this->input->post('filter_query');

		$keywords	 = explode(' ', $query);
		$params		 = array();

		foreach ($keywords as $keyword)
		{
			if ($keyword)
			{
                $keyword = strtolower($keyword);
				$this->mdl_payments->like("CONCAT_WS('^',payment_date,LOWER(invoice_number),LOWER(client_name),payment_amount,LOWER(payment_method_name),LOWER(payment_note))", $keyword);
			}
		}

		$data = array(
			'payments' => $this->mdl_payments->get()->result()
		);

		$this->layout->load_view('payments/partial_payment_table', $data);
	}

}

?>