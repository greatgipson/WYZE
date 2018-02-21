<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_Client_Meters extends Response_Model {

	public $table = 'fi_meters';
	public $primary_key = 'fi_meters.id';

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

	public function db_array()
	{
		$db_array = parent::db_array();

		if (!isset($db_array['is_active']))
		{
			$db_array['is_active'] = 0;
		}

		return $db_array;
	}

    public function default_select()
    {
        $this->db->select('SQL_CALC_FOUND_ROWS fi_meters.*,fi_clients.client_name', FALSE);
    }

	public function default_order_by()
	{
		$this->db->order_by('fi_meters.client_id');
	}

	 public function default_join()
	{
        $this->db->join('fi_clients', 'fi_clients.client_id = fi_meters.client_id');
    }

	public function validation_rules()
	{
		return array(
			'client_id' => array(
				'field' => 'client_id',
				'label' => lang('client_id'),
				'rules' => 'required'
			),
			'is_active' => array(
				'field' => 'is_active'
			),
			'meter_type_id' => array(
				'field' => 'meter_type_id',
				'label' => lang('meter_type_id'),
				'rules' => 'required'
			),
			'description' => array(
				'field' => 'description',
				'label' => lang('description'),
				'rules' => 'required'
			),
			'breaker_size' => array(
				'field' => 'breaker_size'
			),
			'connection_id' => array(
				'field' => 'connection_id'
			),
			'date_of_installation' => array(
				'field' => 'date_of_installation'
			),
			'meter_number' => array(
				'field' => 'meter_number'
			),
			'modem_number' => array(
				'field' => 'modem_number'
			),
			'sim_number' => array(
					'field' => 'sim_number'
			),
			'sim_cell_number' => array(
					'field' => 'sim_cell_number'
			),
			'ip_address' => array(
					'field' => 'ip_address'
			),
			'ct_ratio' => array(
					'field' => 'ct_ratio'
			),
			'vt_ratio' => array(
					'field' => 'vt_ratio'
			),
			'meter_kwh_total' => array(
					'field' => 'meter_kwh_total'
			),
			'meter_kvarh_total' => array(
					'field' => 'meter_kvarh_total'
			)
		);
	}
}

?>