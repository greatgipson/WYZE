<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_Tariff_Type_Tshwane extends Response_Model {

	public $table = 'fi_tariff';
	public $primary_key = 'fi_tariff.tariff_id';

	public function tariff_billing_format()
	{
		return array(
			1 => lang('tariff_billing_format_1'),
			2 => lang('tariff_billing_format_2'),
			3 => lang('tariff_billing_format_3'),
			4 => lang('tariff_billing_format_4'),
		);
    }

	 public function tariff_kva_non_tou_types()
		{
			return array(
				1 => lang('tariff_kva_non_tou_value_1'),
				2 => lang('tariff_kva_non_tou_value_2'),
				3 => lang('tariff_kva_non_tou_value_3'),
				4 => lang('tariff_kva_non_tou_value_4'),
				5 => lang('tariff_kva_non_tou_value_5'),
				6 => lang('tariff_kva_non_tou_value_6'),
				7 => lang('tariff_kva_non_tou_value_7'),
				8 => lang('tariff_kva_tou_value_1'),
				9 => lang('tariff_kva_tou_value_2'),
				10 => lang('tariff_kva_tou_value_3'),
				11 => lang('tariff_kva_tou_value_4'),
				12 => lang('tariff_kva_tou_value_5')
			);
    }

	 public function tariff_kva_tou_types()
		{
			return array(
				'1' => lang('tariff_kva_tou_value_1'),
				'2' => lang('tariff_kva_tou_value_2'),
				'3' => lang('tariff_kva_tou_value_3'),
				'4' => lang('tariff_kva_tou_value_4'),
				'5' => lang('tariff_kva_tou_value_5')
			);
    }

	 public function tou_types()
		{
			return array(
				1 => lang('tou_type_value_1'),
				2 => lang('tou_type_value_2')
			);
    }
	
		public function tariff_season()
	{
			return array(
				'1' => lang('month1'),
				'2' => lang('month2'),
				'3' => lang('month3'),
				'4' => lang('month4'),
				'5' => lang('month5'),
				'6' => lang('month6'),
				'7' => lang('month7'),
				'8' => lang('month8'),
				'9' => lang('month9'),
				'10' => lang('month10'),
				'11' => lang('month11'),
				'12' => lang('month12')			
			);
	}

	 public function season_types()
		{
			return array(
				1 => lang('season_type_value_1'),
				2 => lang('season_type_value_2')
			);
    }


    public function default_select()
    {
        $this->db->select('SQL_CALC_FOUND_ROWS fi_tariff.*,fi_council.*', FALSE);
        //$this->db->select('SQL_CALC_FOUND_ROWS *', FALSE);
        $this->db->where('fi_council.council_name', 'Tshwane');
    }

	public function default_order_by()
	{
		$this->db->order_by('fi_tariff.council_id');
	}


	 public function default_join()
	{
        $this->db->join('fi_council', 'fi_council.id = fi_tariff.council_id');
       // $this->db->join('fi_council', 'fi_council.council_name = Tshwane');
    }

	public function validation_rules()
	{
		return array(
			'council_id' => array(
				'field' => 'council_id',
				'label' => lang('council_id'),
				'rules' => 'required'
			),
			'tariff_name' => array(
				'field' => 'tariff_name',
				'label' => lang('tariff_name'),
				'rules' => 'required'
			),
			'tariff_kva_type_id' => array(
				'field' => 'tariff_kva_type_id',
				'label' => lang('tariff_kva_type'),
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
				'rules' => ''
			),
			'billing_type_id' => array(
				'field' => 'billing_type_id',
				'label' => lang('billing_type_id'),
				'rules' => 'required'
			),
			'low_season_start_m' => array(
				'field' => 'low_season_start_m',
				'label' => lang('low_season_start_m'),
				'rules' => 'required'
			),
			'low_season_end_m' => array(
				'field' => 'low_season_end_m',
				'label' => lang('low_season_end_m'),
				'rules' => 'required'
			),
			'value1' => array(
				'field' => 'value1',
				'label' => lang('value1'),
				'rules' => ''
			),
			'value2' => array(
				'field' => 'value2',
				'label' => lang('value2'),
				'rules' => ''
			),
			'value3' => array(
				'field' => 'value3',
				'label' => lang('value3'),
				'rules' => ''
			),
			'value4' => array(
				'field' => 'value4',
				'label' => lang('value4'),
				'rules' => ''
			),
			'value5' => array(
				'field' => 'value5',
				'label' => lang('value5'),
				'rules' => ''
			),
			'value6' => array(
				'field' => 'value6',
				'label' => lang('value6'),
				'rules' => ''
			),
			'value7' => array(
				'field' => 'value7',
				'label' => lang('value7'),
				'rules' => ''
			),
			'high_season_start_m' => array(
				'field' => 'high_season_start_m',
				'label' => lang('high_season_start_m'),
				'rules' => 'required'
			),
			'high_season_end_m' => array(
				'field' => 'high_season_end_m',
				'label' => lang('high_season_end_m'),
				'rules' => 'required'
			),	
			'hvalue1' => array(
				'field' => 'hvalue1',
				'label' => lang('hvalue1'),
				'rules' => ''
			),
			'hvalue2' => array(
				'field' => 'hvalue2',
				'label' => lang('hvalue2'),
				'rules' => ''
			),
			'hvalue3' => array(
				'field' => 'hvalue3',
				'label' => lang('hvalue3'),
				'rules' => ''
			),
			'hvalue4' => array(
				'field' => 'hvalue4',
				'label' => lang('hvalue4'),
				'rules' => ''
			),
			'hvalue5' => array(
				'field' => 'hvalue5',
				'label' => lang('hvalue5'),
				'rules' => ''
			),
			'hvalue6' => array(
				'field' => 'hvalue6',
				'label' => lang('hvalue6'),
				'rules' => ''
			),
			'hvalue7' => array(
				'field' => 'hvalue7',
				'label' => lang('hvalue7'),
				'rules' => ''
			)
		);
	}
}

?>