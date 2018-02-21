<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_Holidays extends Response_Model {

	public $table = 'fi_holidays';
	public $primary_key = 'fi_holidays.id';

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
        $this->db->select('SQL_CALC_FOUND_ROWS fi_holidays.*,fi_council.council_name', FALSE);
        //$this->db->select('SQL_CALC_FOUND_ROWS *', FALSE);
        //$this->db->where('fi_council.council_name', 'City Power');
    }

	public function default_order_by()
	{
		$this->db->order_by('fi_holidays.council_id');
	}


	 public function default_join()
	{
        $this->db->join('fi_council', 'fi_council.id = fi_holidays.council_id');
    }

	public function validation_rules()
	{
		return array(
			'council_id' => array(
				'field' => 'council_id',
				'label' => lang('council_id'),
				'rules' => 'required'
			),
			'holiday_date' => array(
				'field' => 'holiday_date',
				'label' => lang('holiday_date'),
				'rules' => 'required'
			),
			'holiday_desc' => array(
				'field' => 'holiday_desc',
				'label' => lang('holiday_desc'),
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