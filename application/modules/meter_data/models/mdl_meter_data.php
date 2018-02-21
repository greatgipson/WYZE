<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_Meter_Data extends Response_Model {

	public $table = 'fi_meter_data';
	public $primary_key = 'fi_meter_data.id';
	
			/**
	 * Returns user_id of existing or new record
	 */
	public function meter_data_lookup($meter)
	{
		$meter_data = $this->mdl_users->where('description', $meter)->get();

		if ($meter_data->num_rows())
		{
			$meter_data_id = $meter_data->row()->user_id;
		}
		else
		{
			$db_array = array(
				'meter_data' => $meter_data
			);

            $meter_data_id = parent::save(NULL, $db_array);
		}

		return $meter_data_id;
	}

    public function default_select()
    {
        $this->db->select('SQL_CALC_FOUND_ROWS fi_meter_data.meternum,fi_meter_data.dates, ((fi_meter_data.activewh/1000)*2) as column1 ,(fi_meter_data.activeva/1000) as column2,(fi_meter_data.activevarh/1000) as column3', FALSE);
    }

	public function add_condition1()
	{
	      //  $this->filter_where('client_active', 1);
			$this->filter_where('fi_meter_data.dates >=', date('2015-05-29 00:30:00'));
			$this->filter_where('fi_meter_data.dates <=', date('2015-05-30 00:29:00'));
			$this->filter_where('fi_meter_data.meternum ', '211423686');
			return $this;
	}

	public function default_order_by()
	{
		$this->db->order_by('fi_meter_data.dates');
	}


	 public function default_join()
	{
        //$this->db->join('fi_council', 'fi_council.id = fi_tariff.council_id');
    }

	public function validation_rules()
	{
		return array(
			'dates' => array(
				'field' => 'dates',
				'label' => lang('dates'),
				'rules' => ''
			),
			'activewh' => array(
				'field' => 'activewh',
				'label' => lang('activewh'),
				'rules' => ''
			),
			'activevarh' => array(
				'field' => 'activevarh',
				'label' => lang('activevarh'),
				'rules' => ''
			),
			'activeva' => array(
				'field' => 'activeva',
				'label' => lang('activeva'),
				'rules' => ''
			),
			'stats' => array(
				'field' => 'stats',
				'label' => lang('stats'),
				'rules' => ''
			),
			'meternum' => array(
				'field' => 'meternum',
				'label' => lang('meternum'),
				'rules' => ''
			)
		);
	}
}

?>