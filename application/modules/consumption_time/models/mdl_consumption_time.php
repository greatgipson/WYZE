<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_Consumption_Time extends Response_Model {

	public $table = 'fi_consumption_time';
	public $primary_key = 'fi_consumption_time.id';


	public function tou_types()
	{
		return array(
			1 => 'TOU',
			2 => 'NON-TOU'
		);
    }

	public function season_types()
	{
		return array(
			1 => 'Summer',
			2 => 'Winter',
			3 => 'NA'
		);
    }

	public function consumption_types()
	{
		return array(
			1 => 'Standard',
			2 => 'OffPeak',
			3 => 'Peak'
		);
    }

	public function day_types()
	{
		return array(
			1 => 'Weekday',
			2 => 'Saturday',
			3 => 'Sunday'
		);
    }


    public function default_select()
    {
        $this->db->select('SQL_CALC_FOUND_ROWS fi_consumption_time.*,fi_council.*', FALSE);
        //$this->db->select('SQL_CALC_FOUND_ROWS *', FALSE);
        //$this->db->where('fi_council.council_name', 'City Power');
    }

	public function default_order_by()
	{
		$this->db->order_by('fi_consumption_time.council_id');
	}


	 public function default_join()
	{
        $this->db->join('fi_council', 'fi_council.id = fi_consumption_time.council_id');
    }

	public function validation_rules()
	{
		return array(
			'council_id' => array(
				'field' => 'council_id',
				'label' => lang('council_id'),
				'rules' => 'required'
			),
			'tou_type_id' => array(
				'field' => 'tou_type_id',
				'label' => lang('tou_type_id'),
				'rules' => 'required'
			),
			'season_type_id' => array(
				'field' => 'season_type_id',
				'label' => lang('season_type_id'),
				'rules' => 'required'
			),
			'consumption_type_id' => array(
				'field' => 'consumption_type_id',
				'label' => lang('consumption_type_id'),
				'rules' => 'required'
			),
			'start_time' => array(
				'field' => 'start_time',
				'label' => lang('start_time'),
				'rules' => 'required'
			),
			'end_time' => array(
				'field' => 'end_time',
				'label' => lang('end_time'),
				'rules' => 'required'
			),
			'day_type_id' => array(
				'field' => 'day_type_id',
				'label' => lang('day_type_id'),
				'rules' => 'required'
			)
		);
	}
}

?>