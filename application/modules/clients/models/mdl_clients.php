<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_Clients extends Response_Model {
	public $table = 'fi_clients';
	public $primary_key = 'fi_clients.client_id';
	public $date_created_field = 'client_date_created';
	public $date_modified_field = 'client_date_modified';

	public function meter_type()
	{
		return array(
			'1' => lang('meter_type_1'),
			'2' => lang('meter_type_2'),
			'3' => lang('meter_type_3'),
			'4' => lang('meter_type_4'),
			'5' => lang('meter_type_5')
		);
	}

	 public function connections()
	{
		return array(
			'1' => lang('connections_1'),
			'2' => lang('connections_2'),
			'3' => lang('connections_3'),
		);
	}

	public function default_select()
	{
        $this->db->select('SQL_CALC_FOUND_ROWS fi_client_custom.*, fi_clients.*,fi_tariff.tariff_name', FALSE);
	}

    public function default_join()
    {
        $this->db->join('fi_client_custom', 'fi_client_custom.client_id = fi_clients.client_id', 'left');
        $this->db->join('fi_tariff', 'fi_tariff.tariff_id = fi_clients.tariff_id', 'left');

       // $this->db->join('fi_meter_type', 'fi_meter_type.id = fi_clients.meter_type_id', 'left');
       // $this->db->join('fi_connections', 'fi_connections.id = fi_clients.connection_id', 'left');
    }

	public function default_order_by()
	{
		$this->db->order_by('fi_clients.client_name');
	}

	public function validation_rules()
	{
		return array(
			'client_name' => array(
				'field' => 'client_name',
				'label' => lang('client_name'),
				'rules' => 'required'
			),
			'client_billing_date' => array(
				'field' => 'client_billing_date',
				'label' => lang('client_billing_date'),
				'rules' => 'required'
			),
			'client_active' => array(
				'field' => 'client_active'
			),
			'client_address_1' => array(
				'field' => 'client_address_1'
			),
			'client_address_2' => array(
				'field' => 'client_address_2'
			),
			'client_city' => array(
				'field' => 'client_city'
			),
			'client_state' => array(
				'field' => 'client_state'
			),
			'client_zip' => array(
				'field' => 'client_zip'
			),
			'client_country' => array(
				'field' => 'client_country'
			),
			'client_phone' => array(
				'field' => 'client_phone'
			),
			'client_fax' => array(
				'field' => 'client_fax'
			),
			'client_mobile' => array(
				'field' => 'client_mobile'
			),
			'client_email' => array(
				'field' => 'client_email'
			),
			'client_web' => array(
				'field' => 'client_web'
			),
			'tariff_id' => array(
					'field' => 'tariff_id'
			),
			'alternative_tariff_id' => array(
					'field' => 'alternative_tariff_id'
			)








			/*---it---inizio*/
			//'client_it_codfisc' => array(
			//	'field' => 'client_it_codfisc'
			//),
			//'client_it_piva' => array(
			//	'field' => 'client_it_piva'
			//)
			/*---it---fine*/
		);
	}

	public function db_array()
	{
		$db_array = parent::db_array();

		if (!isset($db_array['client_active']))
		{
			$db_array['client_active'] = 0;
		}

		return $db_array;
	}

    public function delete($id)
    {
        parent::delete($id);

        $this->load->helper('orphan');
        delete_orphans();
    }

	/**
	 * Returns client_id of existing or new record
	 */
	public function client_lookup($client_name)
	{
		$client = $this->mdl_clients->where('client_name', $client_name)->get();

		if ($client->num_rows())
		{
			$client_id = $client->row()->client_id;
		}
		else
		{
			$db_array = array(
				'client_name' => $client_name
			);

            $client_id = parent::save(NULL, $db_array);
		}

		return $client_id;
	}

    public function with_total()
	{
        $this->filter_select("IFNULL((SELECT SUM(invoice_total) FROM fi_invoice_amounts WHERE invoice_id IN (SELECT invoice_id FROM fi_invoices WHERE fi_invoices.client_id = fi_clients.client_id)), 0) AS client_invoice_total", FALSE);
        return $this;
    }

    public function with_total_paid()
    {
        $this->filter_select("IFNULL((SELECT SUM(invoice_paid) FROM fi_invoice_amounts WHERE invoice_id IN (SELECT invoice_id FROM fi_invoices WHERE fi_invoices.client_id = fi_clients.client_id)), 0) AS client_invoice_paid", FALSE);
        return $this;
    }

    public function with_total_balance()
    {
        $this->filter_select("IFNULL((SELECT SUM(invoice_balance) FROM fi_invoice_amounts WHERE invoice_id IN (SELECT invoice_id FROM fi_invoices WHERE fi_invoices.client_id = fi_clients.client_id)), 0) AS client_invoice_balance", FALSE);
		return $this;
	}

	public function is_active()
	{
        $this->filter_where('client_active', 1);
		return $this;
	}

	public function is_inactive()
	{
        $this->filter_where('client_active', 0);
		return $this;
	}

}

?>